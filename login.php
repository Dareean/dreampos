<!-- login.php -->

<?php
require_once('inc/sess_auth.php');
require_once('initialize.php');

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Retrieve the login form data
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Step 3: Establish Database Connection
    $servername = "localhost"; // Replace with your actual servername (usually localhost)
    $db_username = "root"; // Replace with your database username
    $db_password = ""; // Replace with your database password
    $database = "ims"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Step 4: Retrieve User Data from Database and validate login credentials
    $sql = "SELECT * FROM `tbl_users` WHERE email='$email' AND pasword='$password' "; // Replace "users" with the actual table name

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User login successful
        $data = mysqli_fetch_assoc($result);
        $role = $data['role'];
        $id = $data['id'];
        $status = $data['status'];
        $_SESSION['userdata'] = "nama";

        redirectBasedOnRole($role, $status, $id);
    } else {
        // Login failed
        //echo "Registration successful!";
        $_SESSION['info'] = "You are inserting the wrong password, try again.";
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
                        icon: "warning",
                        type: 'warning',
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
        //tombol balik ke login
    }


    // Close the database connection
    $conn->close();
}
?>