<?php
// Database connection information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ims";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Validate and sanitize the ID (important to prevent SQL injection)
    $id = mysqli_real_escape_string($conn, $id);

    // Perform deletion query
    $sql = "DELETE FROM tbl_sub_categories WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful, redirect back to the previous page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
