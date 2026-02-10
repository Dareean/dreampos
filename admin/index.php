<?php
// Assuming you have a database connection established
// Replace 'your_host', 'your_username', 'your_password', and 'your_database' with actual values
$connection = mysqli_connect('localhost', 'root', '', 'ims');

if (!$connection) {
	die("Database connection failed: " . mysqli_connect_error());
}

// Fetch data from your database tables
$query1 = "SELECT COUNT(*) AS user_count FROM tbl_users";
$query2 = "SELECT COUNT(*) AS product_count FROM tbl_products";
$query3 = "SELECT COUNT(*) AS category_count FROM tbl_categories";
$query4 = "SELECT COUNT(*) AS brand_count FROM tbl_brands";
$query5 = "SELECT COUNT(*) AS subcategory_count FROM tbl_sub_categories";

$result1 = mysqli_query($connection, $query1);
$result2 = mysqli_query($connection, $query2);
$result3 = mysqli_query($connection, $query3);
$result4 = mysqli_query($connection, $query4);
$result5 = mysqli_query($connection, $query5);

// Process the query results
$userCount = mysqli_fetch_assoc($result1)['user_count'];
$productCount = mysqli_fetch_assoc($result2)['product_count'];
$categoryCount = mysqli_fetch_assoc($result3)['category_count'];
$brandCount = mysqli_fetch_assoc($result4)['brand_count'];
$subcategoryCount = mysqli_fetch_assoc($result5)['subcategory_count'];

// Close the database connection
mysqli_close($connection);
?>
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

		<div class="page-wrapper ">
			<div class="content">
				<div class="row">
					<div class="col-sm-3 col-md-6 col-12">
						<a href="userlist.php?uid=<?php echo $NewId ?>" class="text-decoration-none">
							<div class="d-flex align-items-center">
								<div class="dash-count das1">
									<div class="dash-counts">
										<h4><?php echo $userCount; ?></h4>
										<h5 class="card-title">Users</h5>
									</div>
									<div class="dash-imgs">
										<i data-feather="user"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-3 col-md-6 col-12">
						<a href="productlist.php?uid=<?php echo $NewId ?>" class="text-decoration-none">
							<div class="d-flex align-items-center">
								<div class="dash-count das2">
									<div class="dash-counts">
										<h4><?php echo $productCount; ?></h4>
										<h5 class="card-title">Products</h5>
									</div>
									<div class="dash-imgs">
										<i data-feather="package"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-3 col-md-6 col-12">
						<a href="categorylist.php?uid=<?php echo $NewId ?>" class="text-decoration-none">
							<div class="d-flex align-items-center">
								<div class="dash-count das3">
									<div class="dash-counts">
										<h4><?php echo $categoryCount; ?></h4>
										<h5 class="card-title">Categories</h5>
									</div>
									<div class="dash-imgs">
										<i data-feather="archive"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-3 col-md-6 col-12">
						<a href="brandlist.php?uid=<?php echo $NewId ?>" class="text-decoration-none">
							<div class="d-flex align-items-center">
								<div class="dash-count das4">
									<div class="dash-counts">
										<h4><?php echo $brandCount; ?></h4>
										<h5 class="card-title">Brands</h5>
									</div>
									<div class="dash-imgs">
										<i data-feather="shopping-bag"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-3 col-md-12 col-12">
						<a href="subcategorylist.php?uid=<?php echo $NewId ?>" class="text-decoration-none">
							<div class="d-flex align-items-center">
								<div class="dash-count das5">
									<div class="dash-counts">
										<h4><?php echo $subcategoryCount; ?></h4>
										<h5 class="card-title">Sub Categories</h5>
									</div>
									<div class="dash-imgs">
										<i data-feather="list"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<!-- Button trigger modal -->

				<div class="row d-flex  h-100">
					<div class="col-lg-5 col-m-12 col-12 d-flex">
						<div class="card flex-fill w-100">
							<div class="card-header pb-0 d-flex justify-content-between align-items-center">
								<h5 class="card-title mb-0">Inventory Graph</h5>
							</div>
							<div class="card my-auto">
								<div class="card-body chart-set">
									<div class="h-250 chart-container w-100" id="flotArea2">

									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-7 col-sm-12 col-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header pb-0 d-flex justify-content-between align-items-center">
								<h4 class="card-title mb-0">Brand List</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive dataview">
									<table class="table datatable ">
										<thead>
											<tr>
												<th>Sno</th>
												<th>Brands Name</th>
												<th>Description</th>
											</tr>
										</thead>
										<tbody>
											<?php
											// Replace with your database connection details
											$servername = "localhost";
											$username = "root";
											$password = "";
											$dbname = "ims";

											// Create connection
											$conn = new mysqli($servername, $username, $password, $dbname);

											// Check connection
											if ($conn->connect_error) {
												die("Connection failed: " . $conn->connect_error);
											}

											$sql = "SELECT * FROM tbl_brands LIMIT 3";
											$result = $conn->query($sql);
											$ro = 1;
											if (mysqli_num_rows($result) > 0) {
												$sno = 1;
												while ($row = mysqli_fetch_assoc($result)) {
													echo '<tr>';
													echo '<td>' . $sno . '</td>';
													echo '<td class="productimgname">';
													echo '<a href="brandlist.php?id=' . $row['id'] . '&uid=' . $NewId . '" class="product-img">';
													echo '<img src="' . $row['img_url'] . '">';
													echo '</a>';
													echo '<a href="brandlist.php?id=' . $row['id'] . '&uid=' . $NewId . '">' . $row['name'] . '</a>';
													echo '</td>';
													echo '<td style="white-space: pre-line;">';

													$description = $row['description'];
													$maxDescriptionLength = 15; // Adjust the maximum length of the description

													// Truncate the description if it's too long
													if (strlen($description) > $maxDescriptionLength) {
														echo substr($description, 0, $maxDescriptionLength) . '...';
													} else {
														echo $description;
													}

													echo '<br><a href="brandlist.php?id=' . $row['id'] . '&uid=' . $NewId . '">Read More</a>';
													echo '</td>';
													echo '</tr>';
													$sno++;
												}
											} else {
												echo '<tr><td colspan="3">No products found.</td></tr>';
											}
											$conn->close();
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="card mb-0">
						<div class="card-body">
							<h4 class="card-title">Recently Added Products</h4>
							<div class="table-responsive dataview">
								<table class="table datatable ">
									<thead>
										<tr>
											<th>SNo</th>
											<th>Product Code</th>
											<th>Product Name</th>
											<th>Category Name</th>
											<th>Sub Category Name</th>
											<th>Brand Name</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										<?php
										// Replace with your database connection details
										$servername = "localhost";
										$username = "root";
										$password = "";
										$dbname = "ims";

										// Create connection
										$conn = new mysqli($servername, $username, $password, $dbname);

										$sql1 = "SELECT p.*, c.code AS category_code, sc.code AS sub_category_code, b.name AS brand
                                            FROM tbl_products p
                                            INNER JOIN tbl_sub_categories sc ON p.id_sub_category = sc.id
                                            INNER JOIN tbl_categories c ON p.id_category = c.id
                                            INNER JOIN tbl_brands b ON p.id_brand = b.id
											ORDER BY id DESC LIMIT 4";
										$result1 = $conn->query($sql1);
										$ro = '1';
										if ($result1->num_rows > 0) {
											while ($row1 = $result1->fetch_assoc()) {
												echo '<tr>';
												echo '<td>' . $ro . '</td>';
												echo '<td>' . $row1['sku'] . '</td>';
												echo '<td class="productimgname">';
												echo '<a href="productlist.php?' . $id . '" class="product-img">';
												echo '<img src="' . $row1['img_url'] . '">';
												echo '</a>';
												echo '<a href="productlist.php?' . $id . '">' . $row1['name'] . '</a>';
												echo '</td>';
												echo '<td>' . $row1['category_code'] . '</td>';
												echo '<td>' . $row1['sub_category_code'] . '</td>';
												echo '<td>' . $row1['brand'] . '</td>';
												echo '<td>' . $row1['price'] . '</td>';
												echo '</tr>';
												$ro++;
											}
										} else {
											echo '<tr><td colspan="3">No products found.</td></tr>';
										}
										$conn->close();
										?>
									</tbody>
								</table>
							</div>
						</div>
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

		<!-- Chart JS -->
		<script src="../assets/plugins/flot/jquery.flot.js"></script>
		<script src="../assets/plugins/flot/jquery.flot.fillbetween.js"></script>
		<script src="../assets/plugins/flot/jquery.flot.pie.js"></script>
		<script>
			// Replace these values with your actual data or retrieve them as needed
			const userCount = <?php echo $userCount; ?>;
			const productCount = <?php echo $productCount; ?>;
			const categoryCount = <?php echo $categoryCount; ?>;
			const brandCount = <?php echo $brandCount; ?>;
			const subcategoryCount = <?php echo $subcategoryCount; ?>;

			const newCust = [{
					label: "User",
					data: [
						[1, userCount]
					],
					color: '#c736be66'
				}, // Red color for User
				{
					label: "Product",
					data: [
						[2, productCount]
					],
					color: '#0046c933'
				}, // Green color for Product
				{
					label: "Category",
					data: [
						[3, categoryCount]
					],
					color: '#28C76F'
				}, // Blue color for Category
				{
					label: "Brand",
					data: [
						[4, brandCount]
					],
					color: '#00CFE84A'
				}, // Pink color for Brand
				{
					label: "Sub Category",
					data: [
						[5, subcategoryCount]
					],
					color: '#EA5400B3'
				}, // Cyan color for Sub Category
			];

			$.plot($('#flotArea2'), newCust, {
				series: {
					bars: {
						show: true,
						barWidth: 0.6,
						align: 'center',
						horizontal: false // Vertical bars
					}
				},
				legend: {
					show: false // Hide legend
				},
				grid: {
					hoverable: true,
					clickable: true,
					borderColor: '#ddd',
					borderWidth: 0,
					labelMargin: 5
				},
				yaxis: {
					min: 0,
					max: 50,
					color: 'rgba(67, 87, 133, .09)',
					font: {
						size: 10,
						color: '#8e9cad'
					}
				},
				xaxis: {
					tickDecimals: 0, // Ensure integer ticks on the x-axis
					color: 'rgba(67, 87, 133, .09)',
					font: {
						size: 10,
						color: '#8e9cad'
					},
					ticks: newCust.map(item => [item.data[0][0], item.label]), // Specify the labels for the x-axis
					tickLength: 0 // Hide tick lines
				},
				title: {
					text: "Chart Title",
					fontSize: "12px",
					textAlign: "center",
					padding: "6px"
				}
			});
		</script>

		<!-- Custom JS -->
		<script src="../assets/js/script.js"></script>

</body>

</html>