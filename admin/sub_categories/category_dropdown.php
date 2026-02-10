<?php
$selectedCategoryId = $_POST['category'];

$servername = "localhost"; // Replace with your actual servername
$db_username = "root"; // Replace with your database username
$db_password = ""; // Replace with your database password
$database = "ims"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM tbl_sub_categories WHERE category_id = $selectedCategoryId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option>" . $row["name"] . "</option>";
    }
}

$conn->close();
