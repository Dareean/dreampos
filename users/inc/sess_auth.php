<?php 
require_once('initialize.php');

// Define your base URL here or use the full URL directly in the redirect() function.
// For example: $base_url = 'https://example.com/';
$base_url = '';

function redirect($url = ''){
    global $base_url;
    if (!empty($url)) {
        header('Location: ' . $base_url . $url);
        exit;
    }
}
function redirectBasedOnRole($userrole) {
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
        echo "<script>alert('Access Denied!');location.replace('". $base_url . $module[$_SESSION['userdata']['login_type']] ."');</script>";
        exit;
    }
}
