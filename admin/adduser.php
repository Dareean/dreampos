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
						<h4>User Management</h4>
						<h6>Add/Update User</h6>
					</div>
				</div>
				<!-- /add -->
				<div class="card">
					<div class="card-body">
						<form id="userForm" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>User Name</label>
										<input type="text" name="username" required>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Full Name</label>
										<input type="text" name="name" required>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Status</label>
										<select class="form-select" name="status" id="status">
											<?php
											$selectedStatus = $users['status']; // Selected status from database

											// Define status options
											$statusOptions = array(
												1 => "Active",
												2 => "Nonactive"
											);

											foreach ($statusOptions as $statusId => $statusName) {
												$selected = ($statusId == $selectedStatus) ? "selected" : "";
												echo "<option value='$statusId' $selected>$statusName</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Phone</label>
										<input type="text" name="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
									</div>
								</div>
								<div class="col-lg-12 col-sm-6 col-12">
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" required>
									</div>
								</div>
								<div class="col-lg-12 col-sm-6 col-12">
									<div class="form-group">
										<label>Password</label>
										<div class="pass-group">
											<input type="password" class=" pass-input" name="password" required>
											<span class="fas toggle-password fa-eye-slash"></span>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label> User Image</label>
										<div class="image-upload">
											<input type="file" name="user_pic" accept="image/*" id="image-input">
											<div class="image-uploads d-flex flex-column align-items-center justify-content-center">
												<img src="../assets/img/icons/upload.svg" alt="img" id="image-preview" class="centered-image" height="50" width="60">
												<h4 id="upload-text">Drag and drop a file to upload</h4>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<input name="submit" value="Submit" type="submit" class="btn btn-submit me-2"></input>
									<a href="userlist.php?uid=<?php echo $NewId ?>" class="btn btn-cancel">Cancel</a>
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
	$editUserUrl = "./processor/add_user.php?uid=" . $NewId;
	?>
	<script>
		$(document).ready(function() {
			$("#userForm").submit(function(event) {
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
									window.location.href = './userlist.php?uid=<?php echo $NewId; ?>';
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

</body>

</html>