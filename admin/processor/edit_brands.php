<?php

$uid = $_GET['uid'];
$UniqueId = $uid;

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
    $brand_id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Fetch the old image URL from the database for the specific category
    $get_old_image_sql = "SELECT img_url FROM tbl_brands WHERE id = '$brand_id'";
    $old_image_result = $conn->query($get_old_image_sql);

    if ($old_image_result && $old_image_result->num_rows > 0) {
        $old_image_data = $old_image_result->fetch_assoc();
        $old_image_url = $old_image_data['img_url'];

        // Handle profile image upload
        $target_dir = "../../assets/img/brand/";
        $file_name = basename($_FILES["category_pic"]["name"]);
        $file_name2 = str_replace(' ', '-', $file_name); // Replace spaces with underscores
        $target_file = $target_dir . $file_name2;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if a new image has been uploaded
        if (!empty($_FILES["brand_pic"]["tmp_name"]) && file_exists($_FILES["brand_pic"]["tmp_name"])) {
            // Check if the uploaded file is an image
            if (getimagesize($_FILES["brand_pic"]["tmp_name"]) !== false) {
                // Delete the old image if it exists
                if (!empty($old_image_url) && file_exists($old_image_url)) {
                    if (unlink($old_image_url)) {
                        echo "Old image deleted successfully.<br>";
                    } else {
                        echo "Error deleting old image.<br>";
                    }
                }

                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES["brand_pic"]["tmp_name"], $target_file)) {
                    $profile_image_path = "../../ims/assets/img/brand/" . $file_name2;
                } else {
                    $_SESSION['info'] = "Sorry, there was an error uploading your image.";
                    $successMessage = $_SESSION['info'] ?? null;
                    unset($_SESSION['info']);
?>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>

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
                                        window.location.href = '../editbrand.php?uid=<?php echo $UniqueId; ?>&id=<?php echo $brand['id'] ?>';
                                    }
                                });
                            <?php endif; ?>
                        });
                    </script>
                <?php
                }
            } else {
                $_SESSION['info'] = "Please upload a valid image.";
                $successMessage = $_SESSION['info'] ?? null;
                unset($_SESSION['info']);
                ?>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>

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
                                    window.location.href = '../editbrand.php?uid=<?php echo $UniqueId; ?>&id=<?php echo $brand['id'] ?>';
                                }
                            });
                        <?php endif; ?>
                    });
                </script>
            <?php
            }
        } else {
            $profile_image_path = $old_image_url;
        }

        // Update the database
        $update_sql = "UPDATE tbl_brands SET name='$name', description='$description', img_url='$profile_image_path' WHERE id='$brand_id'";

        $submit = $conn->query($update_sql);

        if ($submit) {
            $_SESSION['info'] = "Brand updated successfully.";

            $successMessage = $_SESSION['info'] ?? null;
            unset($_SESSION['info']);
            ?>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>

            <script>
                $(document).ready(function() {
                    <?php if ($successMessage) : ?>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '<?php echo $successMessage; ?>',
                            confirmButtonColor: '#FE9F43',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../brandlist.php?uid=<?php echo $UniqueId; ?>';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
        <?php
            exit();
        } else {
            $_SESSION['info'] = "Failed to update brand.";
            $successMessage = $_SESSION['info'] ?? null;
            unset($_SESSION['info']);
        ?>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>

            <script>
                $(document).ready(function() {
                    <?php if ($successMessage) : ?>
                        Swal.fire({
                            icon: 'failed',
                            title: 'Failed',
                            text: '<?php echo $successMessage; ?>',
                            confirmButtonColor: '#FE9F43',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../editbrand.php?uid=<?php echo $UniqueId; ?>&id=<?php echo $brand['id'] ?>';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
<?php
        }
    }
}
// Rest of your HTML code here...
?>