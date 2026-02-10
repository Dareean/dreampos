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
function calculateHash($input)
{
    return md5($input);
}
function redirectBasedOnRole($userrole, $status, $id)
{
    if ($status == 1) {
        if ($userrole == 0) {
            header("Location: admin/index.php?uid=$id");
        } elseif ($userrole == 1) {
            header("Location: users/index.php?uid=$id");
        } else {
            header("Location: error-404.html?1");
        }
        exit; // Make sure to stop the script after redirection
    } elseif ($status == 2) {
        $_SESSION['info'] = "Your Account has been nonactived.";
        $successMessage = $_SESSION['info'] ?? null;
        unset($_SESSION['info']);
?>
        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include SweetAlert library -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                <?php if ($successMessage) : ?>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: '<?php echo $successMessage; ?>',
                        confirmButtonColor: '#FE9F43',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'signin.php';
                        }
                    });
                <?php endif; ?>
            });
        </script>
<?php
        exit; // Make sure to stop the script after redirection
    } else {
        echo '<script>';
        echo 'console.log("Redirecting to default due to unknown status...");';
        echo 'console.log(' . $status . ');';
        echo '</script>';
        header("Location: error-404.html?2"); // Redirect to another error page
        exit; // Make sure to stop the script after redirection
    }
}




// Always call session_start() to initialize the session.
session_start();

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
