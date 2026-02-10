<?php
require_once('inc/sess_auth.php');

// Establish database connection (replace DB_HOST, DB_USER, DB_PASSWORD, and DB_NAME with your database credentials)
$conn = new mysqli('localhost', 'root', '', 'ims');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (!isset($_POST['submit'])) {
    // Check if the required fields are provided
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['pasword']) && isset($_POST['name']) && isset($_POST['phone'])) {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['pasword'];
        $hashedInputPassword = calculateHash($password);
        $role = 1; // Set role to 2 (customer) by default
        $status = 1;

        // Handle profile image upload or set default image path
        if (isset($_FILES["user_pic"]) && $_FILES["user_pic"]["error"] === UPLOAD_ERR_OK) {
            $target_dir = "./assets/img/profiles/";
            $target_file = $target_dir . basename($_FILES["user_pic"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the uploaded file is an image
            if (getimagesize($_FILES["user_pic"]["tmp_name"]) !== false) {
                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES["user_pic"]["tmp_name"], $target_file)) {

                    // Set the target path with the uploaded image's name
                    $target_path = "../../ims/assets/img/profiles/" . $_FILES["user_pic"]["name"];
                } else {
                    $_SESSION['info'] = "Sorry, there was an error uploading your image";
                    // Set $successMessage from session and unset it
                    $successMessage = $_SESSION['info'] ?? null;
                    unset($_SESSION['info']);
?>
                    <!-- Include jQuery library -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <!-- Include SweetAlert library -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>
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
                                        window.location.href = '../adduser.php?uid=<?php echo $UniqueId; ?> ';
                                    }
                                });
                            <?php endif; ?>
                        });
                    </script>
                <?php
                }
            } else {
                $_SESSION['info'] = "Please upload a valid image";
                // Set $successMessage from session and unset it
                $successMessage = $_SESSION['info'] ?? null;
                unset($_SESSION['info']);
                ?>
                <!-- Include jQuery library -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <!-- Include SweetAlert library -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>
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
                                    window.location.href = '../adduser.php?uid=<?php echo $UniqueId; ?> ';
                                }
                            });
                        <?php endif; ?>
                    });
                </script>
            <?php
            }

            $profile_image_path = $target_path;
        } else {
            // Use default profile image path if no image is uploaded
            $profile_image_path = "../../assets/img/profiles/avatar-01.jpg";
        }

        // Check for duplicate username in the database
        $check_username_query = "SELECT * FROM tbl_users WHERE username='$username'";
        $result_username = $conn->query($check_username_query);

        // Check for duplicate password in the database
        $hashed_password = md5($password); // Using MD5 for simplicity (not recommended for production)
        $check_password_query = "SELECT * FROM tbl_users WHERE pasword='$hashed_password'";
        $result_password = $conn->query($check_password_query);

        // If there is a user with the same password, notify the user
        if ($result_password->num_rows > 0) {
            $_SESSION['info'] = "The same account have been added and cant be doubled.";
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
                            title: 'warning',
                            text: '<?php echo $successMessage; ?>',
                            confirmButtonColor: '#FE9F43',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'signup.php';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
            <?php
        } else {
            // Insert user data into the database as a new user with the same password
            $sql = "INSERT INTO tbl_users (username, name, email, pasword, phone, role, img_url,status) VALUES ('$username', '$name', '$email', '$hashed_password', '$phone', $role, '$profile_image_path', $status)";
            if ($conn->query($sql) === TRUE) {
                //echo "Registration successful!";
                $_SESSION['info'] = "Your Account has created, Login for more.";
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
                                icon: 'success',
                                title: 'success',
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
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Please provide all required fields.";
    }
}

$conn->close();
?>