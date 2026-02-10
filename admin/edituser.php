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
						<h6>Edit/Update User</h6>
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
						$query = "SELECT * FROM tbl_users WHERE id = $id";
						$result = $conn->query($query);

						if ($result && $result->num_rows > 0) {
							$users = $result->fetch_assoc();
						?>
							<form id="userForm" method="POST" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="form-group">
											<label>Full Name</label>
											<input type="text" name="name" value="<?php echo $users['name']; ?>">
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="form-group">
											<label>Username</label>
											<input type="text" name="username" value="<?php echo $users['username']; ?>">
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="form-group">
											<label>Phone</label>
											<input type="text" name="phone" value="<?php echo $users['phone']; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="form-group">
											<label>Status</label>
											<select class="form-select" type="IdCode" name="status">
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
									<div class="col-lg-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Role</label>
											<select class="form-select" type="IdCode" name="role">
												<?php
												$selectedRole = $users['role']; // Selected status from database

												// Define status options
												$roleOptions = array(
													0 => "Admin",
													1 => "User"
												);

												foreach ($roleOptions as $roleId => $roleName) {
													$selected = ($roleId == $selectedRole) ? "selected" : "";
													echo "<option value='$roleId' $selected>$roleName</option>";
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Email</label>
											<input type="text" name="email" value="<?php echo $users['email']; ?>">
										</div>
									</div>

									<div class="col-lg-12 col-sm-6 col-12">
										<div class="form-group">
											<label> User Image</label>
											<div class="image-upload">
												<input type="file" name="user_pic" accept="image/*" id="image-input">
												<div class="image-uploads d-flex flex-column align-items-center justify-content-center">
													<img src="<?php echo $users['img_url']; ?>" src="assets/img/icons/upload.svg" alt="img" id="image-preview" class="centered-image" height="50" width="60">
													<h4 id="upload-text">Drag and drop a file to upload</h4>
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" name="user_id" value="<?php echo $users['id']; ?>">
									<div class="col-lg-12 col-sm-6 col-12">
										<button class="btn btn-submit me-2 btn-submited" name="submit" type="submit">Update</button>
										<a class="btn btn-cancel" href="userlist.php?uid=<?php echo $NewId; ?>">Cancel</a>
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
	<script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
	<script src="../assets/plugins/sweetalert/sweetalert.js"></script>

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
	$editUserUrl = "./processor/edit_user.php?uid=" . $NewId;
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
									window.location.href = './userlist.php?uid=<?php echo $NewId; ?>';
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