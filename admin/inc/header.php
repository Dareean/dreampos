<?php
session_start();
require_once('classes/Connect.php');
// Check if the user is not logged in
if (!isset($_SESSION['userdata'])) {
	header('Location: http://localhost/ims/signin.php');
	exit;
}
require_once('sess_auth.php');
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>Dreams Pos admin template</title>

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">

<!-- animation CSS -->
<link rel="stylesheet" href="../assets/css/animate.css">

<!-- Select2 CSS -->
<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">

<!-- Datatable CSS -->
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">

<!-- Main CSS -->
<link rel="stylesheet" href="../assets/css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>