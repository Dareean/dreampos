<?php
session_start(); // Start a session if not already started

// Establish database connection (replace with your actual database credentials)
$conn = new mysqli('localhost', 'root', '', 'ims');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uid = $_GET['uid'];
$UniqueId = $uid;
$subcateid = $_POST['id'];
if (!isset($_POST['submit'])) {
    $id_category = $_POST['id_category'];
    $name = $_POST['nama'];
    $description = $_POST['keterangan'];
    

    // Retrieve the category's code and name
    $get_category_query = "SELECT code, name FROM tbl_categories WHERE id='$id_category'";
    $category_result = $conn->query($get_category_query);

    if ($category_result->num_rows === 1) {
        $update_sql  = "UPDATE tbl_sub_categories SET id_category='$id_category', name='$name', description='$description' WHERE id='$subcateid'";
        $submit = $conn->query($update_sql);

        if ($submit) {
            $_SESSION['info'] = "Sub Category updated successfully.";
        } else {
            $_SESSION['info'] = "Failed to update Sub Category.";
        }
    } else {
        $_SESSION['info'] = "Category not found.";
    }
    header("Location: ../subcategorylist.php?uid=$UniqueId");
    exit();
}

// Close the database connection
$conn->close();
?>
