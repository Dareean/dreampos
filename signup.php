<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - Pos admin template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="account-page">


    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="assets/img/logo.png" alt="img">
                        </div>
                        <a href="index.php" class="login-logo logo-white">
                            <img src="assets/img/logo-white.png" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Create an Account</h3>
                            <h4>Continue where you left off</h4>
                        </div>
                        <form id="login-frm" method="post" enctype="multipart/form-data">
                            <div class="form-login">
                                <label>Username</label>
                                <div class="form-addons">
                                    <input type="text" placeholder="Enter your username" name="username" required>
                                    <img src="assets/img/icons/users1.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Full Name</label>
                                <div class="form-addons">
                                    <input type="text" placeholder="Enter your full name" name="name" required>
                                    <img src="assets/img/icons/users1.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Telephone Number</label>
                                <div class="pass-group">
                                    <input type="tel" placeholder="Enter your Telephone Number" name="phone" required>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="text" placeholder="Enter your email address" name="email" required>
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" placeholder="Enter your password" name="pasword" required>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="product-image">Profile Image</label>
                                        <div class="image-upload text-center">
                                            <input type="file" name="user_pic" accept="image/*" id="image-input">
                                            <div class="image-uploads d-flex flex-column align-items-center justify-content-center">
                                                <img src="assets/img/icons/upload.svg" alt="img" id="image-preview" class="centered-image" height="50" width="60">
                                                <h4 id="upload-text">Drag and drop a file to upload</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-login">
                                <input class="btn btn-login" name="submit" value="Sign Up" type="submit">
                                <!-- <a class="btn btn-login">Sign Up</a> -->
                            </div>
                        </form>
                        <div class="signinform text-center">
                            <h4>Already a user? <a href="signin.php" class="hover-a">Sign In</a></h4>
                        </div>
                        <div class="form-setlogin">
                            <h4>Or sign up with</h4>
                        </div>
                        <div class="form-sociallink">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="assets/img/icons/google.png" class="me-2" alt="google">
                                        Sign Up using Google
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="assets/img/icons/facebook.png" class="me-2" alt="google">
                                        Sign Up using Facebook
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="login-img">
                    <img src="assets/img/login.jpg" alt="img">
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <!-- Feather Icon JS -->
    <script src="assets/js/feather.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>

    <!-- Sweetalert 2 -->
    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

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
    $editUserUrl = "register.php";
    ?>
    <script>
        $(document).ready(function() {
            $("#login-frm").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Collect form data
                var formData = new FormData(this);

                Swal.fire({
                    title: "Are you sure you want to Create this account?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FE9F43",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Create it!",
                    timer: 5000, // Adjust the duration in milliseconds (5 seconds in this example)
                    showConfirmButton: true, // Show the "Confirm" button
                    allowOutsideClick: false, // Prevent clicking outside to close
                }).then((result) => {
                    var editUserUrl = <?php echo json_encode($editUserUrl); ?>;
                    $.ajax({
                        url: editUserUrl, // Use the PHP-generated URL
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        error: function(response) {
                            if (result.isConfirmed) {
                                if (response.status !== "success") {
                                    Swal.fire('Success', 'Great, Welcome to Our Site', 'success')
                                        .then(() => {
                                            // Redirect to the desired page
                                            window.location.href = './signin.php';
                                        });
                                } else {
                                    Swal.fire('Error', 'Something went wrong with the Creating operation!', 'error');
                                }
                            } else {
                                // User didn't confirm, close the pop-up
                                Swal.close();
                            }
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>