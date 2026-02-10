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

error_reporting(E_ALL);
ini_set('display_errors', 1);
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['export_excel']) && isset($_POST['selected_ids'])) {
    $selectedIds = explode(',', $_POST['selected_ids']); // Convert the comma-separated IDs to an array

    // Create a new Spreadsheet object and set headers
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $headers = array("No", "Sub Category Name", "Category Name", "Category ID", "Sub Category ID", "Description", "Created BY");
    $sheet->fromArray($headers, null, 'A1');

    // Fetch data based on selected IDs
    $sql = "SELECT sc.*, c.name AS category_name, c.code AS category_code, u.id AS id_user
            FROM tbl_sub_categories sc
            INNER JOIN tbl_categories c ON sc.id_category = c.id
            INNER JOIN tbl_users u ON sc.id_user = u.id
            WHERE sc.id IN (" . implode(',', $selectedIds) . ")";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $ro = 2; // Start from the second row (after headers)
        while ($row = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $ro, $ro - 1); // Row number
            $sheet->setCellValue('B' . $ro, $row['name']);
            $sheet->setCellValue('C' . $ro, $row['category_name']);
            $sheet->setCellValue('D' . $ro, $row['category_code']);
            $sheet->setCellValue('E' . $ro, $row['code']);
            $sheet->setCellValue('F' . $ro, $row['description']);
            
            // Add logic for 'Created By' column
            if ($row['id_user'] == 1) {
                $sheet->setCellValue('G' . $ro, "Admin");
            } elseif ($row['id_user'] == 2) {
                $sheet->setCellValue('G' . $ro, "Seller");
            } else {
                $sheet->setCellValue('G' . $ro, "Unknown");
            }

            $ro++;
        }

        // Create Excel file
        $writer = new Xlsx($spreadsheet);
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data_Sub_Category.xls");
        $writer->save('php://output');
        exit;
    } else {
        echo "No rows retrieved from the database.";
    }
}
