<!DOCTYPE html>
<html lang="en">
<?php
$servername = "localhost"; // Replace with your actual servername (usually localhost)
$db_username = "root"; // Replace with your database username
$db_password = ""; // Replace with your database password
$database = "ims"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>

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
						<h4>Product Category list</h4>
						<h6>View/Search product Category</h6>
					</div>
					<div class="page-btn">
						<a href="subaddcategory.php?uid=<?php echo $NewId ?>" class="btn btn-added">
							<img src="../assets/img/icons/plus.svg" class="me-1" alt="img">Add Sub Category
						</a>
					</div>
				</div>


				<!-- /product list -->
				<div class="card">
					<div class="card-body">
						<div class="table-top">
							<div class="search-set">
								<!-- <div class="search-path">
										<a class="btn btn-filter" id="filter_search">
											<img src="../assets/img/icons/filter.svg" alt="img">
											<span><img src="../assets/img/icons/closes.svg" alt="img"></span>
										</a>
									</div> -->
								<div class="search-input">
									<a class="btn btn-searchset"><img src="../assets/img/icons/search-white.svg" alt="img"></a>
								</div>
							</div>
							<div class="wordset">
								<ul>
									<li>
										<a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf" id="pdf"><img src="../assets/img/icons/pdf.svg" alt="img"></a>
									</li>
									<li>
										<a data-bs-toggle="tooltip" data-bs-placement="top" title="excel" id="export-excel"><img src="../assets/img/icons/excel.svg" alt="img"></a>
									</li>
									<li>
										<a data-bs-toggle="tooltip" data-bs-placement="top" title="print" id="print"><img src="../assets/img/icons/printer.svg" alt="img"></a>
									</li>
								</ul>
							</div>
						</div>
						<!-- /Filter -->
						<!-- <div class="card" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										
										<div class="col-lg-1 col-sm-6 col-12 ms-auto">
											<div class="form-group">
												<a class="btn btn-filters ms-auto"><img src="../assets/img/icons/search-whites.svg" alt="img"></a>
											</div>
										</div>
									</div>
								</div>
							</div> -->
						<!-- /Filter -->
						<form id="exportExcelForm" method="post" action="processor/exportsubcategory.php">
							<input type="hidden" name="export_excel" value="1">
							<div class="table-responsive" id="print_out">
								<table class="table  datanew">
									<thead>
										<tr>
											<th>
												<label class="checkboxs">
													<input type="checkbox" id="select-all">
													<span class="checkmarks"></span>
												</label>
											</th>
											<th>No</th>
											<th>Sub Category Name</th>
											<th>Category Name</th>
											<th>Category ID</th>
											<th>Sub Category ID</th>
											<th>Description</th>
											<th>Created By</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT sc.*, c.name AS category_name, c.code AS category_code
												FROM tbl_sub_categories sc
												INNER JOIN tbl_categories c ON sc.id_category = c.id";

										// Execute the query
										$result = $conn->query($sql);
										$ro = '1';
										if (!$result) {
											die("Error executing the query: " . $conn->error);
										}

										// Check if there are any categories in the database
										if ($result->num_rows > 0) {
											// Output data of each category in a table
											while ($row = $result->fetch_assoc()) {
												echo '<tr data-id="' . $row['id'] . '">';
												echo '<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>';
												echo '<td><a>' . $ro . '</a></td>';
												echo '<td><a>' . $row['name'] . '</a></td>';
												echo '<td><a>' . $row['category_name'] . '</a></td>';
												echo '<td>' . $row['category_code'] . '</td>';
												echo '<td>' . $row['code'] . '</td>';
												echo '<td style="white-space: pre-line;">' . $row['description'] . '</td>';
												if ($row['id_user'] == 1) {
													echo "<td>Admin</td>";
												} elseif ($row['id_user'] == 2) {
													echo "<td>Seller</td>";
												} else {
													echo "<td>Unknown</td>";
												}
												echo "<td>
													<a class='me-3' href='editsubcategory.php?id=" . $row['id'] . "&uid=" . $NewId . "'>
														<img src='../assets/img/icons/edit.svg' alt='img'>
													</a>
													<a class='me-3 ajax-delete-btn' data-id='" . $row['id'] . "'>
														<img src='../assets/img/icons/delete.svg' alt='img'>
													</a>
												</td>";
												echo '</tr>';
												$ro++;
											}
										}
										?>
									</tbody>
								</table>
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

	<!-- Ajax -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.2.1/html2canvas.min.js"></script>
	<!-- Add this line in the <head> section of your HTML -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
	<script>
		$(function() {
			$('#print').click(function() {
				var selectedRows = [];

				// Iterate through the checkboxes in the table and check if they are selected
				$('.datanew tbody input[type="checkbox"]:checked').each(function() {
					var row = $(this).closest('tr');
					selectedRows.push(row[0].outerHTML);
				});

				if (selectedRows.length === 0) {
					alert("Please select at least one row to print.");
					return;
				}

				var _el = $('<div>');
				var _head = $('head').clone();
				_head.find('title').text("Product List - Print View");

				// Create a new table and add the selected rows along with the table header
				var p = $('<table class="table datanew">' +
					$('.datanew thead').prop('outerHTML') +
					'<tbody>' + selectedRows.join('') + '</tbody></table>');

				// Hide the checkbox column and action column in the cloned table
				p.find('th:first-child, td:first-child').remove();
				p.find('th:last-child, td:last-child').remove();

				// Remove the "Id Sub Category" and "Id Category" columns when printing
				p.find('th:nth-child(7), td:nth-child(7)').remove();
				p.find('th:nth-child(4), td:nth-child(4)').remove();

				_el.append(_head);
				_el.append('<div class="d-flex justify-content-center">' +
					'<div class="col-1 text-right">' +
					'<img src="http://localhost/ims/assets/img/logo.png" width="65px" height="65px" />' +
					'</div>' +
					'<div class="col-10">' +
					'<h4 class="text-center"></h4>' +
					'<h4 class="text-center">Product List</h4>' +
					'</div>' +
					'<div class="col-1 text-right">' +
					'</div>' +
					'</div><hr style="border: solid 1.5px;" />');
				_el.append(p[0].outerHTML);
				var nw = window.open("", "", "width=1200,height=900,left=250,location=no,titlebar=yes");
				nw.document.write(_el.html());
				nw.document.close();
				setTimeout(() => {
					nw.print();
					setTimeout(() => {
						nw.close();
						end_loader();
					}, 200);
				}, 500);
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$('#export-excel').click(function(e) {
				e.preventDefault(); // Prevent the default link behavior

				var selectedIds = [];

				// Iterate through the checkboxes in the table and check if they are selected
				$('.datanew tbody input[type="checkbox"]:checked').each(function() {
					var row = $(this).closest('tr');
					var id = row.data('id'); // Assuming you have a data-id attribute on each row
					selectedIds.push(id);
				});

				if (selectedIds.length === 0) {
					alert("Please select at least one row to export.");
					return;
				}

				// Create a form to submit the selected IDs for Excel export
				var form = $('<form action="processor/exportsubcategory.php" method="post" style="display: none;">');
				form.append('<input type="hidden" name="export_excel" value="1">');
				form.append('<input type="hidden" name="selected_ids" value="' + selectedIds.join(',') + '">');
				$('body').append(form);
				form.submit();
			});
		});
	</script>

	<script>
		$(function() {
			$('#pdf').click(function() {
				var selectedRows = [];

				// Iterate through the checkboxes in the table and check if they are selected
				$('.datanew tbody input[type="checkbox"]:checked').each(function() {
					var row = $(this).closest('tr');
					selectedRows.push(row[0].outerHTML);
				});

				if (selectedRows.length === 0) {
					alert("Please select at least one row to save as PDF.");
					return;
				}

				var _el = $('<div>');
				var _head = $('head').clone();
				_head.find('title').text("Subcategory List - PDF View");

				// Create a new table and add the selected rows along with the table header
				var p = $('<table class="table datanew">' +
					$('.datanew thead').prop('outerHTML') +
					'<tbody>' + selectedRows.join('') + '</tbody></table>');

				// Hide the checkbox column and action column in the cloned table
				p.find('th:first-child, td:first-child').remove();
				p.find('th:last-child, td:last-child').remove();

				_el.append(_head);
				_el.append('<div class="d-flex justify-content-center">' +
					'<div class="col-1 text-right">' +
					'<img src="http://localhost/ims/assets/img/logo.png" width="65px" height="65px" />' +
					'</div>' +
					'<div class="col-10">' +
					'<h4 class="text-center"></h4>' +
					'<h4 class="text-center">Subcategory List</h4>' +
					'</div>' +
					'<div class="col-1 text-right">' +
					'</div>' +
					'</div><hr style="border: solid 1.5px;" />');
				_el.append(p[0].outerHTML);

				// Set the width of the container to auto adjust to the content width
				_el.css('width', 'auto');

				// Calculate the font size based on A4 width
				var MG = 10;
				var a4WidthInPixels = 210; // A4 width in mm
				var contentWidthInPixels = a4WidthInPixels - MG * 2; // Subtract margins
				var FS = contentWidthInPixels / p[0].scrollWidth * 16; // 16 is a starting point, adjust as needed


				var pdfOptions = {
					font: FS + 'px',
					width: '100%',
					height: '100%',
					margin: MG,
					filename: 'Subcategorylist.pdf',
					image: {
						type: 'jpeg',
						quality: 0.98
					},
					html2canvas: {
						scale: 2
					},
					jsPDF: {
						unit: 'mm',
						format: 'a4',
						orientation: 'landscape'
					}
				};

				p.css('font-size', FS + 'px'); // Apply the calculated font size

				html2pdf().from(_el.html()).set(pdfOptions).save();
			});
		});
	</script>

	<script>
		$(".ajax-delete-btn").on("click", function() {
			var id = $(this).data('id'); // Get the user ID from the data-id attribute

			// Show a confirmation dialog
			Swal.fire({
				title: "Are you sure you want to delete this Sub Categories?",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#FE9F43",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!",
			}).then((result) => {
				if (result.isConfirmed) {
					// Send an AJAX request
					$.ajax({
						url: "./processor/deletesubcategories.php", // Replace with the correct URL
						type: "POST",
						data: {
							id: id
						},
						dataType: "json",
						error: function(response) {
							if (response.status !== "success") {
								Swal.fire({
									title: "Success",
									icon: "success",
									text: "Deletion Complete",
									showConfirmButton: true, // Show the "Confirm" button explicitly
									confirmButtonColor: "#FE9F43",
									confirmButtonText: "Ok",
								}).then(() => {
									// Reload the page after successful deletion
									location.reload();
								});
							} else {
								Swal.fire('Error', 'Something went wrong with the delete operation!', 'error');
							}
						}
					});
				}
			});
		});
	</script>
</body>

</html>