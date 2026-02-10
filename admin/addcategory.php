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
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-12">
								<form id="category-form" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label>Category Name</label>
										<input type="text" class="form-control" name="nama" required>
									</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-12">
								<div class="form-group">
									<label>Category Code</label>
									<div class="input-group">
										<div class="input-group-text">C-</div>
										<input type="text" class="form-control" name="kode" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
									</div>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="form-group">
									<label>Description</label>
									<textarea type="text" name="keterangan" class="form-control" required></textarea>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label>Product Image</label>
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
						<div class="col-lg-12">
							<input name="submit" value="Submit" type="submit" class="btn btn-submit"></input>
							<a href="categorylist.php?uid=<?php echo $NewId ?>" class="btn btn-cancel">Cancel</a>
						</div>
						</form>
					</div>
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
				uploadText.style.display = 'none';
			} else {
				imagePreview.style.display = 'none';
				uploadText.style.display = 'block';
			}
		});
	</script>
	<?php
	$editUserUrl = "./processor/procces_category.php?uid=" . $NewId;
	?>
	<script>
		$(document).ready(function() {
			$("#category-form").submit(function(event) {
				event.preventDefault();

				// Collect form data
				var formData = new FormData(this);

				Swal.fire({
					title: "Success",
					icon: "success",
					text: "Adding Complete",
					showConfirmButton: true,
					confirmButtonColor: "#FE9F43",
					confirmButtonText: "Ok",
				}).then((result) => {
					var editUserUrl = <?php echo json_encode($editUserUrl); ?>;
					if (result.isConfirmed) {
						$.ajax({
							url: editUserUrl,
							type: "POST",
							data: formData,
							dataType: "json",
							processData: false,
							contentType: false,
							error: function(response) {
								if (response.status !== "success") {
									window.location.href = './categorylist.php?uid=<?php echo $NewId; ?>';
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