<?php
session_start();
$id = $_GET['uid'];
$NewId = $id;

if (!isset($_POST['submit'])) {
    $servername = "localhost"; // Replace with your actual servername
    $db_username = "root"; // Replace with your database username
    $db_password = ""; // Replace with your database password
    $database = "ims"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $user_id      = $_POST['user_id'];
    $name         = $_POST['name'];
    $username     = $_POST['username'];
    $email        = $_POST['email'];
    $phone        = $_POST['phone'];
    $status       = $_POST['status'];
    $role         = $_POST['role'];


    // Hash the password using MD5


    // Fetch the old image URL from the database for the specific category
    $get_old_image_sql = "SELECT img_url FROM tbl_users WHERE id='$user_id'";
    $old_image_result  = $conn->query($get_old_image_sql);

    if ($old_image_result && $old_image_result->num_rows > 0) {
        $old_image_data = $old_image_result->fetch_assoc();
        $old_image_url = $old_image_data['img_url'];

        // Handle profile image upload
        $target_dir = "../../assets/img/profiles/";
        $target_file = $target_dir . basename($_FILES["user_pic"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if a new image has been uploaded
        if (!empty($_FILES["user_pic"]["tmp_name"]) && file_exists($_FILES["user_pic"]["tmp_name"])) {
            // Check if the uploaded file is an image
            if (getimagesize($_FILES["user_pic"]["tmp_name"]) !== false) {
                // Delete the old image if it exists
                if (!empty($old_image_url) && file_exists($old_image_url)) {
                    if (unlink($old_image_url)) {
                        // Old image deleted successfully
                    } else {
                        $_SESSION['info'] = "Error deleting old image.";
                        // Set $successMessage from session and unset it
                        $successMessage = $_SESSION['info'] ?? null;
                        unset($_SESSION['info']);
?>
                        <!-- Include jQuery library -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <!-- Include SweetAlert library -->
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                            window.location.href = '../profile.php?uid=<?php echo $NewId; ?>&id=<?php echo $users['id'] ?> ';
                                        }
                                    });
                                <?php endif; ?>
                            });
                        </script>
                    <?php
                    }
                }

                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES["user_pic"]["tmp_name"], $target_file)) {
                    $profile_image_path = "../../ims/assets/img/profiles/" . $_FILES["user_pic"]["name"];
                } else {
                    $_SESSION['info'] = "Sorry, there was an error uploading your image";
                    // Set $successMessage from session and unset it
                    $successMessage = $_SESSION['info'] ?? null;
                    unset($_SESSION['info']);
                    ?>
                    <!-- Include jQuery library -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <!-- Include SweetAlert library -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                        window.location.href = '../profile.php?uid=<?php echo $NewId; ?>&id=<?php echo $users['id'] ?> ';
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
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                    window.location.href = '../profile.php?uid=<?php echo $NewId; ?>&id=<?php echo $users['id'] ?>';
                                }
                            });
                        <?php endif; ?>
                    });
                </script>
            <?php
            }
        } else {
            // No new image uploaded, keep the existing image URL
            $profile_image_path = $old_image_url;
        }

        // Update the database
        $update_sql = "UPDATE tbl_users SET name='$name', username='$username', email='$email', phone='$phone', status='$status', img_url='$profile_image_path', role='$role' WHERE id='$user_id'";

        $submit = $conn->query($update_sql);

        if ($submit) {
            exit();
        } else {
            $_SESSION['info'] = "Failed to update user.";
            // Set $successMessage from session and unset it
            $successMessage = $_SESSION['info'] ?? null;
            unset($_SESSION['info']);
            ?>
            <!-- Include jQuery library -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <!-- Include SweetAlert library -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                window.location.href = '../profiles.php?uid=<?php echo $NewId; ?>&id=<?php echo $users['id'] ?>';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
<?php
        }

        $thirtyMinutesAgo = time() - (30 * 60);

        // Update the user statuses
        $sql = "UPDATE tbl_users SET status = 0 WHERE last_login_time <= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $thirtyMinutesAgo);
        $stmt->execute();
        $stmt->close();
    }
}

// Rest of your HTML code here...
?>