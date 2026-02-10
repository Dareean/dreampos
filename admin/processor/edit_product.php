<?php

// Establish database connection (replace DB_HOST, DB_USER, DB_PASSWORD, and DB_NAME with your database credentials)
$conn = new mysqli('localhost', 'root', '', 'ims');
$uid = $_GET['uid'];
$UniqueId = $uid;
if (!isset($_POST['submit'])) {
    if (isset($_POST['nama']) && isset($_POST['sku']) && isset($_POST['id_category']) && isset($_POST['id_sub_category']) && isset($_POST['id_brands']) && isset($_POST['price']) && isset($_POST['unit']) && isset($_POST['qty']) && isset($_POST['min_qty']) && isset($_POST['tax']) && isset($_POST['discount'])) {
        $proid = $_POST['id'];
        $name = $_POST['nama'];
        $sku = $_POST['sku'];
        $id_category = $_POST['id_category'];
        $id_sub_category = $_POST['id_sub_category'];
        $id_brands = $_POST['id_brands'];
        $description = $_POST['keterangan'];
        $price = $_POST['price'];
        $unit = $_POST['unit'];
        $qty = $_POST['qty'];
        $min_qty = $_POST['min_qty'];
        $discount = $_POST['discount'];
        $tax = $_POST['tax'];
        $id_user = 1;

        // Handle profile image upload or set default image path
        if (isset($_FILES["category_pic"]) && $_FILES["category_pic"]["error"] === UPLOAD_ERR_OK) {
            $target_dir = "../../assets/img/product/";
            $target_file = $target_dir . basename($_FILES["category_pic"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the uploaded file is an image
            if (getimagesize($_FILES["category_pic"]["tmp_name"]) !== false) {
                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES["category_pic"]["tmp_name"], $target_file)) {

                    // Set the target path with the uploaded image's name
                    $profile_image_path = "../../ims/assets/img/product/" . $_FILES["category_pic"]["name"];
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
                                        window.location.href = '../editproduct.php?uid=<?php echo $UniqueId; ?>&id=<?php echo $row['id'] ?> ';
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
                                    window.location.href = '../editproduct.php?uid=<?php echo $UniqueId; ?>&id=<?php echo $row['id'] ?> ';
                                }
                            });
                        <?php endif; ?>
                    });
                </script>
                <?php
            }
        } else {
            // Retrieve the existing image path from the database
            $existing_image_query = "SELECT img_url FROM tbl_products WHERE id='$proid'";
            $existing_image_result = $conn->query($existing_image_query);

            if ($existing_image_result->num_rows === 1) {
                $existing_image_row = $existing_image_result->fetch_assoc();
                $profile_image_path = $existing_image_row['img_url'];
            } else {
                // Use default profile image path if no image is uploaded and no existing image found
                $profile_image_path = "../../assets/img/product/product01.jpg";
            }
        }

        // Retrieve the category's code and name
        $get_category_query = "SELECT code as c_code FROM tbl_categories WHERE id='$id_category'";
        $category_result = $conn->query($get_category_query);
        $get_sub_category_query = "SELECT code as sc_code FROM tbl_sub_categories WHERE id='$id_sub_category'";
        $subcategory_result = $conn->query($get_sub_category_query);
        $get_brands_query = "SELECT name as brand_name FROM tbl_brands WHERE id='$id_brands'";
        $brands_result = $conn->query($get_brands_query);

        if ($category_result->num_rows === 1 || $subcategory_result->num_rows === 1 || $brands_result->num_rows === 1) {
            $category_row = $category_result->fetch_assoc();
            $category_code = $category_row['c_code'];

            $subcategory_row = $subcategory_result->fetch_assoc();
            $subcategory_code = $subcategory_row['sc_code'];

            $brands_row = $brands_result->fetch_assoc();
            $brands_code = $brands_row['brand_name'];

            // Check for duplicate code in the subcategories table
            $check_code_query = "SELECT * FROM tbl_products WHERE id='$proid'";
            $result_code = $conn->query($check_code_query);

            if ($result_code) {
                $update_sql = "UPDATE tbl_products SET name='$name', sku='$sku', id_category='$id_category', id_sub_category='$id_sub_category', id_brand='$id_brands', price='$price', unit='$unit', qty='$qty', min_qty='$min_qty', discount_type='$discount', id_tax='$tax', description='$description', img_url='$profile_image_path' WHERE id=$proid ";
                $submit = $conn->query($update_sql);

                if ($submit) {
                    $_SESSION['info'] = "Product updated successfully.";

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
                                        window.location.href = '../productlist.php?uid=<?php echo $UniqueId; ?>';
                                    }
                                });
                            <?php endif; ?>
                        });
                    </script>
                <?php
                    exit();
                } else {
                    $_SESSION['info'] = "Failed to update product.";
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
                                        window.location.href = '../productlist.php?uid=<?php echo $UniqueId; ?>';
                                    }
                                });
                            <?php endif; ?>
                        });
                    </script>
                <?php
                }
            } else {
                $_SESSION['info'] = "A subcategory with the same code already exist.";
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
                                    window.location.href = '../editproduct?uid=<?php echo $UniqueId; ?>&id=<?php echo $category['id'] ?>';
                                }
                            });
                        <?php endif; ?>
                    });
                </script>
            <?php
            }
        } else {
            $_SESSION['info'] = "Category not found.";
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
                                window.location.href = '../editproduct?uid=<?php echo $UniqueId; ?>&id=<?php echo $category['id'] ?>';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
        <?php
        }
    } else {
        $_SESSION['info'] = "Please provide all required fields";
        $successMessage = $_SESSION['info'] ?? null;
        unset($_SESSION['info']);
        ?>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
        <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>

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
                            window.location.href = '../editproduct?uid=<?php echo $UniqueId; ?>&id=<?php echo $category['id'] ?>';
                        }
                    });
                <?php endif; ?>
            });
        </script>
<?php
    }
}

$conn->close();
?>