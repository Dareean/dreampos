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
    if (isset($_POST['name']) && isset($_POST['description'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Handle profile image upload or set default image path
        if (isset($_FILES["brand_pic"]) && $_FILES["brand_pic"]["error"] === UPLOAD_ERR_OK) {
            $target_dir = "../../../ims/assets/img/brand/";
            $original_file_name = $_FILES["brand_pic"]["name"];

            // Replace spaces in the file name with underscores
            $sanitized_file_name = str_replace(" ", "_", $original_file_name);

            $target_file = $target_dir . basename($sanitized_file_name);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the uploaded file is an image
            if (getimagesize($_FILES["brand_pic"]["tmp_name"]) !== false) {
                // Move the uploaded file to the target directorysweetalert
                if (move_uploaded_file($_FILES["brand_pic"]["tmp_name"], $target_file)) {

                    // Set the target path with the uploaded image's name
                    $profile_image_path = $target_file;
                } else {
                    $_SESSION['info'] = "Sorry, there was an error uploading your image.";
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
                                        window.location.href = '../addbrand.php?uid=<?php echo $UniqueId; ?>';
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
                                    window.location.href = '../addbrand.php?uid=<?php echo $UniqueId; ?>';
                                }
                            });
                        <?php endif; ?>
                    });
                </script>
            <?php
            }
        } else {
            // Use default profile image path if no image is uploaded
            $profile_image_path = "../../ims/assets/img/brand/adidas.png";
        }

        $validUserId = 1; // Replace with the actual valid user ID

        $sql = "INSERT INTO tbl_brands (name, description, img_url, id_user) VALUES ('$name', '$description', '$profile_image_path', '$validUserId')";
        $submit = $conn->query($sql);

        if ($submit) {
            $_SESSION['info'] = "Brand added successfully.";

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
                            icon: 'success',
                            title: 'Success',
                            text: '<?php echo $successMessage; ?>',
                            confirmButtonColor: '#FE9F43',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to userlist.php
                                window.location.href = '../brandlist.php?uid=<?php echo $UniqueId; ?>';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
        <?php
            exit();
        } else {
            $_SESSION['info'] = "Failed to add brand.";
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
                                window.location.href = '../addbrand.php?uid=<?php echo $UniqueId; ?>';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
        <?php
        }
    } else {
        $_SESSION['info'] = "Please fill all required fields.";
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
                            window.location.href = '../addbrand.php?uid=<?php echo $UniqueId; ?>';
                        }
                    });
                <?php endif; ?>
            });
        </script>
<?php
    }
}
?>