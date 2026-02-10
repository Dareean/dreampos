<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$database = "ims";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

require '../../vendor/autoload.php'; // Include the PhpSpreadsheet autoloader


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


if (isset($_POST['export_excel']) && isset($_POST['selected_ids'])) {
    $selectedIds = explode(',', $_POST['selected_ids']); // Convert the comma-separated IDs to an array

    // Sanitize the IDs to prevent SQL injection
    $sanitizedIds = array_map(function ($id) use ($conn) {
        return mysqli_real_escape_string($conn, $id);
    }, $selectedIds);

    // Filter out empty values
    $sanitizedIds = array_filter($sanitizedIds);

    if (!empty($sanitizedIds)) {
        // Create a new Spreadsheet object and set headers
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $headers = array("No", "Category Name", "Category Code", "Description", "Created By");
        $sheet->fromArray($headers, null, 'A1');

        // Fetch data based on sanitized selected IDs
        $sql = "SELECT * FROM tbl_categories WHERE id IN (" . implode(',', $sanitizedIds) . ")";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $ro = 2; // Start from the second row (after headers)
            while ($row = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $ro, $ro - 1); // Row number
            $sheet->setCellValue('B' . $ro, $row['name']);
            $sheet->setCellValue('C' . $ro, $row['code']);
            $sheet->setCellValue('D' . $ro, $row['description']);
            
            // Add logic for 'Created By' column
            if ($row['id_user'] == 1) {
                $sheet->setCellValue('E' . $ro, "Admin");
            } elseif ($row['id_user'] == 2) {
                $sheet->setCellValue('E' . $ro, "Seller");
            } else {
                $sheet->setCellValue('E' . $ro, "Unknown");
            }

            $ro++;
            }
        }

        // Create Excel file
        $writer = new Xls($spreadsheet);
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data_Category.xls");
        $writer->save('php://output');
        exit;
    } else {
        echo "No rows retrieved from the database.";
    }
}
