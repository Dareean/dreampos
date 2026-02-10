<?php
// Establish database connection (replace DB_HOST, DB_USER, DB_PASSWORD, and DB_NAME with your database credentials)
$conn = new mysqli('localhost', 'root', '', 'ims');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['uid'];
$UniqueId = $id;
// Check if the form is submitted
if (!isset($_POST['submit'])) {
    // Check if the required fields are provided
    if (isset($_POST['nama']) && isset($_POST['kode']) && isset($_POST['keterangan'])) {

        // Get form data
        $name = $_POST['nama'];
        $code = 'C-' . $_POST['kode'];
        $description = $_POST['keterangan'];
        $id_user = 1;

        // Handle profile image upload or set default image path
        if (isset($_FILES["category_pic"]) && $_FILES["category_pic"]["error"] === UPLOAD_ERR_OK) {
            $target_dir = "../../assets/img/product/";
            $file_name = basename($_FILES["category_pic"]["name"]);
            $file_name2 = str_replace(' ', '-', $file_name); // Replace spaces with underscores
            $target_file = $target_dir . $file_name2;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the uploaded file is an image
            if (getimagesize($_FILES["category_pic"]["tmp_name"]) !== false) {
                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES["category_pic"]["tmp_name"], $target_file)) {

                    // Set the target path with the uploaded image's name
                    $target_path = "../../ims/assets/img/product/" . $file_name2;
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
                                        window.location.href = '../addcategory.php?uid=<?php echo $UniqueId; ?>';
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
                                    window.location.href = '../addcategory.php?uid=<?php echo $UniqueId; ?>';
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
            $profile_image_path = "../../ims/assets/img/product/adidas.png";
        }

        // Check for duplicate code in the database
        $check_code_query = "SELECT * FROM tbl_categories WHERE code='$code'";
        $result_code = $conn->query($check_code_query);

        // If there is no category with the same code, insert data
        if ($result_code->num_rows === 0) {
            $sql = "INSERT INTO tbl_categories (id_user, name, code, description, img_url) VALUES ('$id_user','$name', '$code', '$description', '$profile_image_path')";
            $submit = $conn->query($sql);

            if ($submit) {
                $_SESSION['info'] = "Category added successfully.";

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
                                    window.location.href = '../categorylist.php?uid=<?php echo $UniqueId; ?>';
                                }
                            });
                        <?php endif; ?>
                    });
                </script>
            <?php
                exit();
            } else {
                $_SESSION['info'] = "Failed to add category.";
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
                                    window.location.href = '../addcategory.php?uid=<?php echo $UniqueId; ?>';
                                }
                            });
                        <?php endif; ?>
                    });
                </script>
            <?php
            }
        } else {
            $_SESSION['info'] = "A category with the same code already exist!";
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
                                window.location.href = '../addcategory.php?uid=<?php echo $UniqueId; ?>';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
        <?php
        }
    } else {
        $_SESSION['info'] = "Please provide all required fields";
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
                            window.location.href = '../addcategory.php?uid=<?php echo $UniqueId; ?>';
                        }
                    });
                <?php endif; ?>
            });
        </script>
<?php
    }
}
?>