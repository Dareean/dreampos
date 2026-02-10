<?php
// Include PHPMailer library
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ims";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $query = "SELECT * FROM tbl_users WHERE token_ganti_password = '$token'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        // Token is valid, show the password reset form
        // This form will allow the user to reset their password
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
            <meta name="description" content="POS - Bootstrap Admin Template">
            <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
            <meta name="author" content="Dreamguys - Bootstrap Admin Template">
            <meta name="robots" content="noindex, nofollow">
            <title>Reset Password - Pos admin template</title>

            <!-- Favicon -->
            <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">

            <!-- Fontawesome CSS -->
            <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
            <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

            <!-- Main CSS -->
            <link rel="stylesheet" href="assets/css/style.css">

        </head>

        <body class="account-page">

            <!-- Main Wrapper -->
            <div class="main-wrapper">
                <div class="account-content">
                    <div class="login-wrapper">
                        <div class="login-content">
                            <div class="login-userset">
                                <div class="login-logo">
                                    <img src="assets/img/logo.png" alt="img">
                                </div>
                                <div class="login-userheading">
                                    <h3>Reset Password</h3>
                                </div>
                                <form action="resetpassword_process.php?token=<?php echo $token; ?>" method="POST">
                                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                                    <div class="form-login">
                                        <label>Password</label>
                                        <div class="pass-group">
                                            <input type="password" name="password" class="pass-input" placeholder="Enter your new password">
                                            <span class="fas toggle-password fa-eye-slash"></span>
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <label>Confirm Password</label>
                                        <div class="pass-group">
                                            <input type="password" name="confirm_password" class="pass-inputs" placeholder="Confirm your new password">
                                            <span class="fas toggle-passwords fa-eye-slash"></span>
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <input type="submit" class="btn btn-login" name="reset_password" value="Reset Password">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="login-img">
                            <img src="assets/img/login.jpg" alt="img">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Main Wrapper -->

            <!-- jQuery -->
            <script src="assets/js/jquery-3.6.0.min.js"></script>

            <!-- Feather Icon JS -->
            <script src="assets/js/feather.min.js"></script>

            <!-- Bootstrap Core JS -->
            <script src="assets/js/bootstrap.bundle.min.js"></script>

            <!-- Custom JS -->
            <script src="assets/js/script.js"></script>

            <!-- Sweetalert 2 -->
            <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
            <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

        </body>

        </html>

    <?php
    } else {
        $_SESSION['info'] = "Invalid or Token not found";
        $successMessage = $_SESSION['info'] ?? null;
        unset($_SESSION['info']);
    ?>
        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include SweetAlert library -->
        <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
        <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
        <script>
            $(document).ready(function() {
                <?php if ($successMessage) : ?>
                    Swal.fire({
                        icon: "warning",
                        type: 'warning',
                        title: 'Warning',
                        text: '<?php echo $successMessage; ?>',
                        confirmButtonColor: '#FE9F43',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'resetpassword.php?token=<?php echo $token; ?>';
                        }
                    });
                <?php endif; ?>
            });
        </script>
    <?php
    }
} else {
    $_SESSION['info'] = "Token not found in URL";
    $successMessage = $_SESSION['info'] ?? null;
    unset($_SESSION['info']);
    ?>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include SweetAlert library -->
    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php if ($successMessage) : ?>
                Swal.fire({
                    icon: "warning",
                    type: 'warning',
                    title: 'Warning',
                    text: '<?php echo $successMessage; ?>',
                    confirmButtonColor: '#FE9F43',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'resetpassword.php?token=<?php echo $token; ?>';
                    }
                });
            <?php endif; ?>
        });
    </script>
<?php
}
?>