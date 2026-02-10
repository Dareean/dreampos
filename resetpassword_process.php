<?php
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
$token = $_GET['token'];
if (isset($_POST['reset_password'])) {
    $token = $_GET['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password and confirm password
    if ($password === $confirm_password) {
        // Hash the password using MD5
        $hashed_password = md5($password);

        // Update the user's password and clear the token
        $updateQuery = "UPDATE tbl_users SET pasword = '$hashed_password', token_ganti_password = NULL WHERE token_ganti_password = '$token'";
        if ($conn->query($updateQuery)) {
            $_SESSION['info'] = "Password Reset Successfully";
            // Set $successMessage from session and unset it
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
                    // Check if there's a success message and display an alert
                    <?php if ($successMessage) : ?>
                        Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: '<?php echo $successMessage; ?>',
                            confirmButtonColor: '#FE9F43',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to userlist.php
                                window.location.href = 'signin.php';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
        <?php
        } else {
            $_SESSION['info'] = "Failed to reset password";
            // Set $successMessage from session and unset it
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
                    // Check if there's a success message and display an alert
                    <?php if ($successMessage) : ?>
                        Swal.fire({
                            icon: 'warning',
                            title: 'warning',
                            text: '<?php echo $successMessage; ?>',
                            confirmButtonColor: '#FE9F43',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to userlist.php
                                window.location.href = 'signin.php';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
        <?php
        }
    } else {
        $_SESSION['info'] = "Password doesnt match";
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
                        title: 'warning',
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
    $_SESSION['info'] = "Invalid request";
    // Set $successMessage from session and unset it
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
            // Check if there's a success message and display an alert
            <?php if ($successMessage) : ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'warning',
                    text: '<?php echo $successMessage; ?>',
                    confirmButtonColor: '#FE9F43',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to userlist.php
                        window.location.href = 'resetpassword.php?token=<?php echo $token; ?>';
                    }
                });
            <?php endif; ?>
        });
    </script>
<?php
}
?>