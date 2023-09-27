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

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $query = "SELECT * FROM tbl_users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Update user's token in the database
        $updateQuery = "UPDATE tbl_users SET token_ganti_password = '$token' WHERE email = '$email'";
        $conn->query($updateQuery);

        // Send email with reset link
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dareeanderen@gmail.com';
        $mail->Password = 'btfw xffk fstx hsga';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your_email@example.com', 'Dream Pos'); // Sender's email and name
        $mail->addAddress($_POST['email']); // Recipient's email from user input

        $mail->isHTML(true); // Set email content to be HTML
        $mail->Subject = 'Password Reset'; // Email subject

        // The email body with the reset link
        $mail->Body = 'I heard that you forgot your password? Hey! dont worry, it happens all the times! <br>Just Click the following link to reset your password: <a href="localhost/ims/resetpassword.php?token=' . $token . '">Reset Password</a>';

        // Check if the email was sent successfully
        if (!$mail->send()) {
            $_SESSION['info'] = "Mailer Error: " . $mail->ErrorInfo;
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
                                window.location.href = 'forgertpassword.php';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
        <?php

        } else {
            $_SESSION['info'] = "Email has been sent with instructions to reset your password.";
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
                            icon: "success",
                            type: 'success',
                            title: 'Success',
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
        }
    }
}
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
    <title>Login - Pos admin template</title>

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
                    <div class="login-userset ">
                        <div class="login-logo">
                            <img src="assets/img/logo.png" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Forgot password?</h3>
                            <h4>Don’t warry! it happens. Please enter the address <br>
                                associated with your account.</h4>
                        </div>
                        <form action="" method="POST">
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="text" placeholder="Enter your email address" name="email" vlaue="<? echo $email ?>">
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <input type="submit" class="btn btn-login" name="submit" value="Lupa Password"></input>
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