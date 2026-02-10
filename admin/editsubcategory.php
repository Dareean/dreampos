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
						<h4>Product Add Category</h4>
						<h6>Create new product Category</h6>
					</div>
				</div>

				<!-- /add -->
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
						$query = "SELECT * FROM tbl_sub_categories WHERE id = $id";
						$result = $conn->query($query);

						if ($result && $result->num_rows > 0) {
							$category = $result->fetch_assoc();
						?>
							<form id="catform" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Category ID</label>
											<select value="<?php echo $category['id_category']; ?>" class="form-select" type="IdCode" name="id_category" id="category">
												<?php include './processor/get_categories.php'; ?>
											</select>
										</div>
									</div>

									<div class="col-lg-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Sub Category Name</label>
											<input value="<?php echo $category['name']; ?>" type="name" class="form-control" name="nama" required>
										</div>
									</div>


									<div class="col-lg-12 col-sm-6 col-12">
										<div class="form-group">
											<label>Description</label>
											<textarea name="keterangan" class="form-control" required><?php echo $category['description']; ?></textarea>
										</div>
									</div>
									<input type="hidden" name="id" value="<?php echo $category['id']; ?>">
									<div class="col-lg-12 col-sm-6 col-12">
										<input name="submit" value="Submit" type="submit" class="btn btn-submit"></input>
										<a href="subcategorylist.php?uid=<?php echo $NewId ?>" class="btn btn-cancel">Cancel</a>
									</div>
								</div>
							</form>
						<?php } ?>
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
	<?php
	$editUserUrl = "./sub_categories/edit_sub_category.php?uid=" . $NewId;
	?>
	<script>
		$(document).ready(function() {
			$("#catform").submit(function(event) {
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
									window.location.href = './subcategorylist.php?uid=<?php echo $NewId; ?>';
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