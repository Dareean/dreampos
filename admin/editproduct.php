<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('inc/header.php'); ?>

</head>

<body>
    <?php include('inc/loader.php'); ?>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <?php include('inc/topnav.php'); ?>
        <?php include('inc/sidebar.php'); ?>


        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Product Edit</h4>
                        <h6>Update your product</h6>
                    </div>
                </div>
                <?php
                function isSelected($selectedIdFromDatabase3, $currentId)
                {
                    return ($selectedIdFromDatabase3 == $currentId) ? 'selected' : '';
                }

                $servername = "localhost"; // Replace with your actual servername
                $db_username = "root"; // Replace with your database username
                $db_password = ""; // Replace with your database password
                $database = "ims"; // Replace with your database name

                $conn = new mysqli($servername, $db_username, $db_password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $id = $_GET['id']; // Replace with the actual category ID
                $query = "SELECT * from tbl_products WHERE id = $id";

                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    $category = $result->fetch_assoc();
                    $selectedIdFromDatabase1 = $category['id_category'];
                    $selectedIdFromDatabase2 = $category['id_sub_category'];
                    $selectedIdFromDatabase3 = $category['id_brand'];
                    $selectedIdFromDatabase4 = $category['id_tax'];
                ?>
                    <div class="card">
                        <div class="card-body">
                            <form id="productForm" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="name" class="form-control" name="nama" value="<?php echo $category['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>SKU</label>
                                            <input type="code" class="form-control" name="sku" value="<?php echo $category['sku']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="code" class="form-control" name="price" value="<?php echo $category['price']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <input type="code" class="form-control" name="unit" value="<?php echo $category['unit']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="code" class="form-control" name="qty" value="<?php echo $category['qty']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Min Qty</label>
                                            <input type="code" class="form-control" name="min_qty" value="<?php echo $category['min_qty']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <select class="form-select" type="" name="discount">
                                                <?php
                                                $selectedRole = $product['discount']; // Selected status from database

                                                // Define status options
                                                $discountOptions = array(
                                                    1 => "Disadvantage",
                                                    2 => "Non Disadvantage"
                                                );

                                                foreach ($discountOptions as $roleId => $roleName) {
                                                    $selected = ($roleId == $selectedRole) ? "selected" : "";
                                                    echo "<option value='$roleId' $selected>$roleName</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-select" type="IdCode" name="id_category" id="category">
                                                <?php include './processor/get_categories2.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Sub Category</label>
                                            <select class="form-select" type="IdCode" name="id_sub_category" id="sub_category">
                                                <?php include './processor/get_sub_categories2.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Brands</label>
                                            <select class="form-select" type="IdCode" name="id_brands" id="brands">
                                                <?php include './processor/get_brands2.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Taxes</label>
                                            <select class="form-select" type="IdCode" name="tax">
                                                <?php include './processor/get_tax2.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="keterangan" class="form-control" required><?php echo $category['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <div class="image-upload text-center">
                                                <input type="file" name="category_pic" accept="image/*" id="image-input">
                                                <div class="image-uploads d-flex flex-column align-items-center justify-content-center">
                                                    <img src="<?php echo $category['img_url']; ?>" src="assets/img/icons/upload.svg" alt="img" id="image-preview" class="centered-image" height="50" width="60">
                                                    <h4 id="upload-text">Drag and drop a file to upload</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input name="submit" value="Submit" type="submit" class="btn btn-submit">
                                        <a href="productlist.php?uid=<?php echo $NewId ?>" class="btn btn-cancel">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        <?php } ?>
        <!-- /add -->
        </div>
    </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <!-- Feather Icon JS -->
    <script src="../assets/js/feather.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="../assets/js/jquery.slimscroll.min.js"></script>

    <!-- Datatable JS -->
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 JS -->
    <script src="../assets/plugins/select2/js/select2.min.js"></script>

    <!-- Sweetalert 2 -->
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <!-- Custom JS -->
    <script src="../assets/js/script.js"></script>
    <script>
        // JavaScript to handle image preview
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        const uploadText = document.getElementById('upload-text');

        imageInput.addEventListener('change', function() {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
                imagePreview.style.display = 'block';
                uploadText.style.display = 'none'; // Hide the upload text
            } else {
                imagePreview.style.display = 'none';
                uploadText.style.display = 'block'; // Show the upload text
            }
        });

        if ($updateSuccess) {
            $_SESSION['edit_success'] = true; // Set the session variable
            header("Location: userlist.php"); // Redirect to userlist.php
            exit();
        }
    </script>
    <?php
    $editUserUrl = "./processor/edit_product.php?uid=" . $NewId;
    ?>
    <script>
        $(document).ready(function() {
            $("#productForm").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Collect form data
                var formData = new FormData(this);

                Swal.fire({
                    title: "Success",
                    icon: "success",
                    text: "Update Complete",
                    showConfirmButton: true, // Show the "Confirm" button explicitly
                    confirmButtonColor: "#FE9F43",
                    confirmButtonText: "Ok",
                }).then((result) => {
                    var editUserUrl = <?php echo json_encode($editUserUrl); ?>;
                    if (result.isConfirmed) { // Check if the "Confirm" button was clicked
                        $.ajax({
                            url: editUserUrl, // Use the PHP-generated URL
                            type: "POST",
                            data: formData,
                            dataType: "json",
                            processData: false,
                            contentType: false,
                            error: function(response) {
                                if (response.status !== "success") {
                                    window.location.href = './productlist.php?uid=<?php echo $NewId; ?>';
                                } else {
                                    Swal.fire('Error', 'Something went wrong with the Update operation!', 'error');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>