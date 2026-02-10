<?php
// Assuming you have your database credentials
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

// Assuming you have a product ID passed as a parameter, replace 'your_product_id' with the actual parameter name
$product_id = $_GET['id'];

// Query the database to retrieve product details based on the product ID (using prepared statement)
$sql = "SELECT p.*, c.name AS category_name, sc.name AS sub_category_name, b.name AS brand, t.rate AS tax_rate, t.status AS tax_status, p.discount_type AS discount_type, p.img_url AS image_url
        FROM tbl_products p
        INNER JOIN tbl_sub_categories sc ON p.id_sub_category = sc.id
        INNER JOIN tbl_categories c ON p.id_category = c.id
        INNER JOIN tbl_brands b ON p.id_brand = b.id
        INNER JOIN tbl_taxes t ON p.id_tax = t.id
        WHERE p.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results into an array
$productData = $result->fetch_assoc();

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();
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

		<div class="page-wrapper">
			<div class="content">
				<div class="page-header">
					<div class="page-title">
						<h4>Product Details</h4>
						<h6>Full details of a product</h6>
					</div>
				</div>
				<!-- /add -->
				<div class="row">
					<div class="col-lg-8 col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="bar-code-view">
									<img src="../assets/img/barcode1.png" alt="barcode">
									<a class="printimg">
										<img src="../assets/img/icons/printer.svg" alt="print">
									</a>
								</div>
								<div class="productdetails">
									<ul class="product-bar">
										<?php
										if (!empty($productData)) {
											echo "<li>";
											echo "<h4>Product</h4>";
											echo "<h6>" . $productData["name"] . "</h6>";
											// Add similar lines for other attributes
											echo "</li>";
											echo "<li>";
											echo "<h4>Category</h4>";
											echo "<h6>" . $productData["category_name"] . "</h6>";
											// Add similar lines for other attributes
											echo "</li>";
											echo "<li>";
											echo "<h4>Sub Category</h4>";
											echo "<h6>" . $productData["sub_category_name"] . "</h6>";
											// Add similar lines for other attributes
											echo "</li>";
											echo "<li>";
											echo "<h4>Brand</h4>";
											echo "<h6>" . $productData["brand"] . "</h6>";
											// Add similar lines for other attributes
											echo "</li>";
											echo "<li>";
											echo "<h4>Unit</h4>";
											echo "<h6>" . $productData["unit"] . "</h6>";
											// Add similar lines for other attributes
											echo "</li>";
											echo "<li>";
											echo "<h4>SKU</h4>";
											echo "<h6>" . $productData["sku"] . "</h6>";
											// Add similar lines for other attributes
											echo "</li>";
											echo "<li>";
											echo "<h4>Minimum Qty</h4>";
											echo "<h6>" . $productData["min_qty"] . "</h6>";
											// Add similar lines for other attributes
											echo "</li>";
											echo "<li>";
											echo "<h4>Quantity</h4>";
											echo "<h6>" . $productData["qty"] . "</h6>";
											// Add similar lines for other attributes
											echo "</li>";
											if ($productData['status'] == 1) {
												echo "<li>
														<h4>Product Status</h4>
														<h6>Product Active</h6>		
														</li>";
											} else {
												echo "<li>
														<h4>Product Status</h4>
														<h6>Product Non Active</h6>
														</li>";
											}
											echo "<li>";
											echo "<h4>Tax</h4>";
											echo "<h6>" . $productData["tax_rate"] . "%</h6>";
											// Add similar lines for other attributes
											echo "</li>";
											if ($productData['tax_status'] == 1) {
												echo "<li>
														<h4>Tax Status</h4>
														<h6>Tax Active</h6>		
														</li>";
											} else {
												echo "<li>
														<h4>Tax Status</h4>
														<h6>Tax Non Active</h6>
														</li>";
											}
											if ($productData['discount_type'] == 1) {
												echo "<li>
														<h4>Discount Type</h4>
														<h6>Percentage</h6>		
														</li>";
											} else {
												echo "<li>
														<h4>Discount Type</h4>
														<h6>Non Percentage</h6>
														</li>";
											}
											echo "<li>";
											echo "<h4>Description</h4>";
											echo "<h6>" . $productData["description"] . "</h6>";
											// Add similar lines for other attributes
											echo "</li>";
										} else {
											echo "No product found.";
										}
										?>
									</ul><br><br>
									<div class="col-lg-12">
										<a href="productlist.php?uid=<?php echo $NewId ?>" class="btn btn-cancel">Back</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="slider-product-details">
									<div class="owl-carousel owl-theme product-slide">
										<?php
										if ($result->num_rows > 0) {
											// Reset the result set back to the beginning
											mysqli_data_seek($result, 0);
											while ($productData = $result->fetch_assoc()) {
												echo "<div class='slider-product'>";
												echo "<img src='" . $productData['image_url'] . "' alt='img'>";
												echo "<h4>" . $productData["name"] . "</h4>";
												echo "</div>";
											}
										} else {
											echo "No images available for this product.";
										}
										?>
									</div>
								</div>
							</div>
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

	<!-- Bootstrap Core JS -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>

	<!-- Owl JS -->
	<script src="../assets/plugins/owlcarousel/owl.carousel.min.js"></script>

	<!-- Select2 JS -->
	<script src="../assets/plugins/select2/js/select2.min.js"></script>

	<!-- Custom JS -->
	<script src="../assets/js/script.js"></script>

	<!-- Initialize Owl Carousel -->
	<script>
		$(document).ready(function() {
			$('.owl-carousel').owlCarousel({
				loop: true,
				margin: 10,
				responsiveClass: true,
				responsive: {
					0: {
						items: 1,
						nav: true
					},
					600: {
						items: 3,
						nav: false
					},
					1000: {
						items: 4,
						nav: true,
						loop: false
					}
				}
			});
		});
	</script>

</body>

</html>