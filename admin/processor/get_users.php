<?php
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
 

$sql = "SELECT id, role FROM tbl_users";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'".isSelected($selectedIdFromDatabase1, $row['id']).">" . $row["code"] . " - " . $row["name"] . "</option>";
    }
}

$conn->close();
