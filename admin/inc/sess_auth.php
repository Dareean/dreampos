<?php
require_once('initialize.php');

// Define your base URL here or use the full URL directly in the redirect() function.
// For example: $base_url = 'https://example.com/';
$base_url = '';

function redirect($url = '')
{
    global $base_url;
    if (!empty($url)) {
        header('Location: ' . $base_url . $url);
        exit;
    }
}



function createCategory($name, $code, $description, $category_pic)
{
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Check if the required fields are provided
        if (isset($_POST['name']) && isset($_POST['code']) && isset($_POST['description'])) {

            $name = $_POST['name'];
            $code = $_POST['code'];
            $description = $_POST['description'];

            // Handle profile image upload or set default image path
            if (isset($_FILES["category_pic"]) && $_FILES["category_pic"]["error"] === UPLOAD_ERR_OK) {
                $target_dir = "../assets/img/product/";
                $target_file = $target_dir . basename($_FILES["category_pic"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if the uploaded file is an image
                if (getimagesize($_FILES["category_pic"]["tmp_name"]) !== false) {
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES["category_pic"]["tmp_name"], $target_file)) {
                        echo "Image uploaded successfully. ";
                    } else {
                        echo "Sorry, there was an error uploading your image. ";
                    }
                } else {
                    echo "Please upload a valid image file. ";
                }

                $profile_image_path = $target_file;
            } else {
                // Use default profile image path if no image is uploaded
                $profile_image_path = "../assets/img/product/product01.jpg";
            }

            // Check for duplicate code in the database
            $check_code_query = "SELECT * FROM tbl_categories WHERE code='$code'";
            $result_code = $conn->query($check_code_query);

            // If there is a user with the same password, notify the user
            if ($result_code->num_rows > 0) {
                echo "A category with the same code already exists.";
            } else {
                // Insert user data into the database as a new user with the same password
                $sql = "INSERT INTO tbl_categories (name, code, description, img_url) VALUES ( '$name', '$code', '$description', '$profile_image_path')";
                if ($conn->query($sql) === TRUE) {
                    //echo "Registration successful!";
                    echo '<script>alert("SUCCESS,  categories successfuly created!"); window.location.href = "./categorylist.php";</script>';
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "Please provide all required fields.";
        }
    }
}

function redirectBasedOnRole($userrole)
{
    switch ($userrole) {
        case 0:
            header("Location: admin/index.php");
            break;
        case 1:
            header("Location: users/index.php");
            break;
        default:
            // Handle other roles or redirect to a default page
            header("Location: error-404.html");
            break;
    }
    exit; // Make sure to stop the script after the redirection
}


// Always call session_start() to initialize the session.


if (!isset($_SESSION['userdata']) && strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) {
    redirect('signin.php');
}

$module = array('', 'admin', 'faculty', 'student');

// Check if the login_type exists and if it is an integer before using it as an array index.
if (
    isset($_SESSION['userdata']['login_type']) &&
    is_int($_SESSION['userdata']['login_type']) &&
    $_SESSION['userdata']['login_type'] > 0 && // Make sure login_type is not zero
    $_SESSION['userdata']['login_type'] < count($module)
) {
    // Redirect to appropriate module based on login type when trying to access "index.php".
    if (strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) {
        echo "<script>alert('Access Denied!');location.replace('" . $base_url . $module[$_SESSION['userdata']['login_type']] . "');</script>";
        exit;
    }
}
