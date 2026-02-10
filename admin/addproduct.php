<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('inc/header.php'); ?>
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

	$query = "SELECT * FROM tbl_products WHERE id ";
	$result = $conn->query($query);

	if ($result && $result->num_rows > 0) {
		$product = $result->fetch_assoc();
	}
	?>
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
						<h4>Product</h4>
						<h6>Create new product</h6>
					</div>
				</div>

				<!-- /add -->
				<div class="card">
					<div class="card-body">
						<form id="productForm"  method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-4 col-sm-6 col-12">
									<div class="form-group">
										<label for="product-name">Product Name</label>
										<input type="text" class="form-control" name="nama" required>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-12">
									<div class="form-group">
										<label for="sku">SKU</label>
										<div class="input-group">
											<span class="input-group-text">-X-XL-XXL-HTMPTH</span>
											<input type="text" class="form-control" name="sku" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-12">
									<div class="form-group">
										<label for="price">Price</label>
										<input type="text" class="form-control" name="price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label for="unit">Unit</label>
										<input type="text" class="form-control" name="unit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label for="qty">Qty</label>
										<input type="text" class="form-control" name="qty" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label for="min-qty">Min Qty</label>
										<input type="text" class="form-control" name="min_qty" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label for="discount">Discount</label>
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
					</div>
					<div class="row">
						<div class="col-lg-3 col-sm-6 col-12">
							<div class="form-group">
								<label for="category">Category</label>
								<select class="form-select" name="id_category" id="category">
									<?php include './processor/get_categories.php'; ?>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6 col-12">
							<div class="form-group">
								<label for="sub-category">Sub Category</label>
								<select class="form-select" name="id_sub_category" id="sub-category">
									<?php include './processor/get_sub_categories.php'; ?>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6 col-12">
							<div class="form-group">
								<label for="brands">Brands</label>
								<select class="form-select" name="id_brands" id="brands">
									<?php include './processor/get_brands.php'; ?>
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6 col-12">
							<div class="form-group">
								<label for="tax">Taxes</label>
								<select class="form-select" name="tax" id="tax">
									<?php include './processor/get_tax.php'; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-sm-6 col-12">
						<div class="form-group">
							<label for="description">Description</label>
							<textarea class="form-control" name="keterangan" required value="<?php echo $product['description'] ?>"></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label for="product-image">Product Image</label>
							<div class="image-upload text-center">
								<input type="file" name="category_pic" accept="image/*" id="image-input">
								<div class="image-uploads d-flex flex-column align-items-center justify-content-center">
									<img src="assets/img/icons/upload.svg" alt="img" id="image-preview" class="centered-image" height="50" width="60">
									<h4 id="upload-text">Drag and drop a file to upload</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<input name="submit" value="Submit" type="submit" class="btn btn-submit">
						<a href="productlist.php?uid=<?php echo $NewId ?>" class="btn btn-cancel">Cancel</a>
					</div>
				</div>
				</form>
			</div>
		</div>
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
	</script>
	<?php
	$editUserUrl = "./processor/procces_product.php?uid=" . $NewId;
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
					text: "Adding Complete",
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
									Swal.fire('Error', 'Something went wrong with the Adding operation!', 'error');
								}
							}
						});
					}
				});
			});
		});
	</script>
	<script>
		document.getElementById('presentage').onkeypress =
			function(e) {
				var ev = e || window.event;
				if (ev.charCode < 48 || ev.charCode > 57) {
					return false;
				} else if (this.value * 10 + ev.charCode - 48 > this.max) {
					return false;
				} else {
					return true;
				}
			}
	</script>
</body>

</html>