

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
$id = $_GET['uid'];
$NewId = $id;

$Uniquequery = "SELECT * FROM tbl_users WHERE id = $NewId";
$Uniqueresult = $conn->query($Uniquequery);
if ($Uniqueresult && $Uniqueresult->num_rows > 0) {
    $Uniquerow = $Uniqueresult->fetch_assoc();
}
$role = $Uniquerow['role'];

// Determine the role text based on the role value
if ($role == 0) {
    echo $roleText = "Admin";
} else {
    echo $roleText = "Users";
}
echo '<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left active">
        <a href="index.php?uid=' . $NewId . '" class="logo logo-normal">
            <img src="../assets/img/logo.png" alt="">
        </a>
        <a href="index.php?uid=' . $NewId . '" class="logo logo-white">
            <img src="../assets/img/logo-white.png" alt="">
        </a>
        <a href="index.php?uid=' . $NewId . '" class="logo-small">
            <img src="../assets/img/logo-small.png" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>
    <!-- /Logo -->

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <!-- Header Menu -->
    <ul class="nav user-menu">

        <!-- Search -->
        <li class="nav-item nav-searchinputs">
            <div class="top-nav-search">

                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="Search">
                        <div class="search-addon">
                            <span><i data-feather="search" class="feather-14"></i></span>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!-- /Search -->

        <li class="nav-item nav-item-box">
            <a href="javascript:void(0);" id="btnFullscreen">
                <i data-feather="maximize"></i>
            </a>
        </li>
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-info">
                    <span class="user-letter">
                        <img src="'.$Uniquerow['img_url'].'" alt="" class="img-fluid">
                    </span>
                    <span class="user-detail">
                        <span class="user-name">'.$Uniquerow['name'].'</span>
                        <span class="user-role">'.$roleText.'</span>
                    </span>
                </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="'.$Uniquerow['img_url'].'" alt="">
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>'.$Uniquerow['name'].'</h6>
                            <h5>'.$roleText.'</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="profile.php?uid=' . $NewId . '"> <i class="me-2" data-feather="user"></i> My Profile</a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="../signin.php"><img src="../assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
                </div>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.php">My Profile</a>
            <a class="dropdown-item" href="../signin.php">Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
</div>';
?>
