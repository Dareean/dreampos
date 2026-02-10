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
                        <h4>Product Edit Category</h4>
                        <h6>Edit a product Category</h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <?php
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

                        $id = $_GET['id']; // Replace with the actual category ID
                        $query = "SELECT * FROM tbl_categories WHERE id = $id";
                        $result = $conn->query($query);

                        if ($result && $result->num_rows > 0) {
                            $category = $result->fetch_assoc();


                        ?>

                            <form id="categoryForm" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" name="nama" value="<?php echo $category['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea type="text" name="keterangan" class="form-control" required><?php echo $category['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <div class="image-upload">
                                                <input type="file" name="category_pic" accept="image/*" id="categoryPicInput">
                                                <div class="image-uploads">
                                                    <img id="categoryImagePreview" src="<?php echo $category['img_url']; ?>" height="40" width="50" alt="img">
                                                    <h4>Drag and drop a file to upload</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                                    <div class="col-lg-12">
                                        <button name="submit" type="submit" value="Submit" class="btn btn-submit me-2">Submit</button>
                                        <a href="categorylist.php?uid=<?php echo $NewId ?>" class="btn btn-cancel">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- JavaScript Dependencies (jQuery, Feather, Slimscroll, Datatable, Bootstrap, Select2, Sweetalert) -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script>
        // JavaScript code for image preview
        const categoryPicInput = document.getElementById("categoryPicInput");
        const categoryImagePreview = document.getElementById("categoryImagePreview");

        categoryPicInput.addEventListener("change", function() {
            const file = categoryPicInput.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    categoryImagePreview.src = event.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
    <?php
    $editUserUrl = "./processor/edit_category.php?uid=" . $NewId;
    ?>
    <script>
        $(document).ready(function() {
            $("#categoryForm").submit(function(event) {
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
                                    window.location.href = './categorylist.php?uid=<?php echo $NewId; ?>';
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