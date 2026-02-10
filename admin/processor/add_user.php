<?php
// Establish database connection (replace DB_HOST, DB_USER, DB_PASSWORD, and DB_NAME with your database credentials)
$conn = new mysqli('localhost', 'root', '', 'ims');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uid = $_GET['uid'];
$UniqueId = $uid;
// Check if the form is submitted
if (!isset($_POST['submit'])) {
    // Check if the required fields are provided
    if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])) {

        // Get form data
        $name            = $_POST['name'];
        $username        = $_POST['username'];
        $phone           = $_POST['phone'];
        $email           = $_POST['email'];
        $raw_password    = $_POST['password'];
        $status          = $_POST['status'];

        $password = md5($raw_password);

        // Handle profile image upload or set default image path
        if (isset($_FILES["user_pic"]) && $_FILES["user_pic"]["error"] === UPLOAD_ERR_OK) {
            $target_dir = "../../assets/img/profiles/";
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
            $profile_image_path = "../../ims/assets/img/profiles/avatar-01.jpg";
        }

        // Check for duplicate code in the database
        $check_code_query = "SELECT * FROM tbl_users WHERE email='$email'";
        $result_code = $conn->query($check_code_query);

        // If there is no category with the same code, insert data
        if ($result_code->num_rows === 0) {
            $sql = "INSERT INTO tbl_users (name, username, phone, email, pasword, img_url, status, role) VALUES ('$name', '$username', '$phone', '$email', '$password', '$profile_image_path', '$status', '1')";
            $submit = $conn->query($sql);

            if ($submit) {
                exit();
            } else {
                $_SESSION['info'] = "Failed to add user.";
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
                                icon: 'failed',
                                title: 'Failed',
                                text: '<?php echo $successMessage; ?>',
                                confirmButtonColor: '#FE9F43',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to userlist.php
                                    window.location.href = '../userlist.php?uid=<?php echo $UniqueId; ?>';
                                }
                            });
                        <?php endif; ?>
                    });
                </script>
            <?php
            }
        } else {
            $_SESSION['info'] = "This email already exist";
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
    }
}
?>