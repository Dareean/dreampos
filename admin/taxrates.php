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
						<h4>Tax Rates</h4>
						<h6>Manage Tax Rates</h6>
					</div>
					<div class="page-btn">
						<a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addpayment"><img src="../assets/img/icons/plus.svg" alt="img" class="me-1">Add New Tax Rates</a>
					</div>
				</div>
				<!-- /product list -->
				<div class="card">
					<div class="card-body">
						<div class="table-top">
							<div class="search-set">
								<div class="search-input">
									<a class="btn btn-searchset"><img src="../assets/img/icons/search-white.svg" alt="img"></a>
								</div>
							</div>
							<div class="wordset">
								<ul>
									<li>
										<a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="../assets/img/icons/pdf.svg" alt="img"></a>
									</li>
									<li>
										<a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="../assets/img/icons/excel.svg" alt="img"></a>
									</li>
									<li>
										<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="../assets/img/icons/printer.svg" alt="img"></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table  datanew">
								<thead>
									<tr>
										<th>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</th>
										<th>Tax name</th>
										<th>Tax (%)</th>
										<th>Status</th>
										<th class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>SGST 9% </td>
										<td>9.00</td>
										<td>
											<div class="status-toggle d-flex justify-content-between align-items-center">
												<input type="checkbox" id="user1" class="check" checked="">
												<label for="user1" class="checktoggle">checkbox</label>
											</div>
										</td>
										<td class="text-end">
											<a class="me-3" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editpayment">
												<img src="../assets/img/icons/edit.svg" alt="img">
											</a>
											<a class="me-3 confirm-text" href="javascript:void(0);">
												<img src="../assets/img/icons/delete.svg" alt="img">
											</a>
										</td>
									</tr>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>ISGT 9%</td>
										<td>9.00</td>
										<td>
											<div class="status-toggle d-flex justify-content-between align-items-center">
												<input type="checkbox" id="user2" class="check" checked="">
												<label for="user2" class="checktoggle">checkbox</label>
											</div>
										</td>
										<td class="text-end">
											<a class="me-3" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editpayment">
												<img src="../assets/img/icons/edit.svg" alt="img">
											</a>
											<a class="me-3 confirm-text" href="javascript:void(0);">
												<img src="../assets/img/icons/delete.svg" alt="img">
											</a>
										</td>
									</tr>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>IGST 4.5% </td>
										<td>4.50</td>
										<td>
											<div class="status-toggle d-flex justify-content-between align-items-center">
												<input type="checkbox" id="user3" class="check">
												<label for="user1" class="checktoggle">checkbox</label>
											</div>
										</td>
										<td class="text-end">
											<a class="me-3" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editpayment">
												<img src="../assets/img/icons/edit.svg" alt="img">
											</a>
											<a class="me-3 confirm-text" href="javascript:void(0);">
												<img src="../assets/img/icons/delete.svg" alt="img">
											</a>
										</td>
									</tr>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>SGST 4.5% </td>
										<td>4.50</td>
										<td>
											<div class="status-toggle d-flex justify-content-between align-items-center">
												<input type="checkbox" id="user10" class="check" checked>
												<label for="user10" class="checktoggle">checkbox</label>
											</div>
										</td>
										<td class="text-end">
											<a class="me-3" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editpayment">
												<img src="../assets/img/icons/edit.svg" alt="img">
											</a>
											<a class="me-3 confirm-text" href="javascript:void(0);">
												<img src="../assets/img/icons/delete.svg" alt="img">
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /product list -->
			</div>
		</div>
	</div>

	<!-- add Modal -->
	<div class="modal fade" id="addpayment" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add TAX </h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label>Tax Name<span class="manitory">*</span></label>
								<input type="text">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Tax Rate(%)<span class="manitory">*</span></label>
								<input type="text">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group mb-0">
								<label>Status</label>
								<select class="select">
									<option>Choose Status</option>
									<option> Active</option>
									<option> InActive</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-submit">Confirm</button>
					<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>

	<!-- edit Modal -->
	<div class="modal fade" id="editpayment" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Tax</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label>Tax Name<span class="manitory">*</span></label>
								<input type="text" value="SGST 4.5%	">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Tax Rate(%)<span class="manitory">*</span></label>
								<input type="text" value="4.50">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group mb-0">
								<label>Status</label>
								<select class="select">
									<option> Active</option>
									<option> InActive</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-submit">Update</button>
					<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
				</div>
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

</body>

</html>