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
						<h4>Profile</h4>
						<h6>User Profile</h6>
					</div>
				</div>
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

				$uid = $_GET['uid'];
				$query = "SELECT * FROM tbl_users WHERE id = $uid";
				$result = $conn->query($query);

				if ($result && $result->num_rows > 0) {
					$users = $result->fetch_assoc();
				}
				?>

				<!-- /product list -->
				<div class="card">
					<div class="card-body">
						<form id="profileForm" enctype="multipart/form-data" id="userForm" method="POST" class="row g-3" action="./processor/edit_user2.php?uid=<?php echo $NewId ?>">
							<div class="profile-set">
								<div class="profile-head">

								</div>
								<div class="profile-top">
									<div class="profile-content">
										<div class="profile-contentimg">
											<img id="userImagePreview" src="<?php echo $users['img_url']; ?>" alt="img" id="<?php echo $users['name']; ?>'s Photo">
											<div class="profileupload">
												<input type="file" id="image-input" name="user_pic" accept="image/*">
												<a href="javascript:void(0);"><img src="../assets/img/icons/edit-set.svg" alt="img"></a>
											</div>
										</div>
										<div class="profile-contentname">
											<h2><?php echo $users['name']; ?></h2>
											<h4>Last Login : <?php echo $users['last_login_time']; ?></h4>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="username" value="<?php echo $users['username']; ?>">
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Full Name</label>
										<input type="text" name="name" value="<?php echo $users['name']; ?>">
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" value="<?php echo $users['email']; ?>">
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Phone</label>
										<input type="text" name="phone" value="<?php echo $users['phone']; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Status</label>
										<select class="form-select" name="status" id="status" value="<?php echo $users['status']; ?>">
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
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Password</label>
										<div class="pass-group">
											<input type="password" name="pasword" value="<?php echo $users['pasword']; ?>" class=" pass-input">
											<span class="fas toggle-password fa-eye-slash"></span>
										</div>
									</div>
								</div>
								<input type="hidden" name="user_id" value="<?php echo $users['id']; ?>">
								<div class="col-12">
									<button type="submit" name="submit" class="btn btn-submit me-2" value="submit">Submit</button>
									<a href="./index.php?uid=<?php echo $NewId ?>" class="btn btn-cancel">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- /product list -->
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
		window.addEventListener('load', function() {
			const brandPicInput = document.getElementById("image-input");
			const brandImagePreview = document.getElementById("userImagePreview");

			brandPicInput.addEventListener("change", function() {
				const file = brandPicInput.files[0];
				if (file) {
					const reader = new FileReader();

					reader.onload = function(event) {
						brandImagePreview.src = event.target.result;
					};

					reader.readAsDataURL(file);
				}
			});
		});
	</script>

	<?php
	$editUserUrl = "./processor/edit_user2.php?uid=" . $NewId;
	?>
	<script>
		$(document).ready(function() {
			$("#profileForm").submit(function(event) {
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
									window.location.href = './profile.php?uid=<?php echo $NewId; ?>';
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