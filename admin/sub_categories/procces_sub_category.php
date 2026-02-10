<?php

// Establish database connection (replace DB_HOST, DB_USER, DB_PASSWORD, and DB_NAME with your database credentials)
$conn = new mysqli('localhost', 'root', '', 'ims');
$uid = $_GET['uid'];
$UniqueId = $uid;
if (!isset($_POST['submit'])) {
    if (isset($_POST['nama']) && isset($_POST['kode']) && isset($_POST['keterangan']) && isset($_POST['id_category'])) {
        $id_category = $_POST['id_category'];
        $name = $_POST['nama'];
        $code = 'SC-' . $_POST['kode'];
        $description = $_POST['keterangan'];
        $id_user = 1;

        // Retrieve the category's code and name
        $get_category_query = "SELECT code, name FROM tbl_categories WHERE id='$id_category'";
        $category_result = $conn->query($get_category_query);

        if ($category_result->num_rows === 1) {
            $category_row = $category_result->fetch_assoc();
            $category_code = $category_row['code'];
            $category_name = $category_row['name'];

            // Check for duplicate code in the subcategories table
            $check_code_query = "SELECT * FROM tbl_sub_categories WHERE code='$code'";
            $result_code = $conn->query($check_code_query);

            if ($result_code->num_rows === 0) {
                $sql = "INSERT INTO tbl_sub_categories (id_user, id_category, name, code, description) VALUES ('$id_user', '$id_category', '$name', '$code', '$description')";
                $submit = $conn->query($sql);

                if ($submit) {
                    $_SESSION['info'] = "Sub Category added successfully.";

                    // Set $successMessage from session and unset it
                    $successMessage = $_SESSION['info'] ?? null;
                    unset($_SESSION['info']);
?>
                    <!-- Include jQuery library -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <!-- Include SweetAlert library -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>
                    <script>
                        $(document).ready(function() {
                            // Check if there's a success message and display an alert
                            <?php if ($successMessage) : ?>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: '<?php echo $successMessage; ?>',
                                    confirmButtonColor: '#FE9F43',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect to userlist.php
                                        window.location.href = '../subcategorylist.php?uid=<?php echo $UniqueId; ?>';
                                    }
                                });
                            <?php endif; ?>
                        });
                    </script>
                <?php
                    exit();
                } else {
                    $_SESSION['info'] = "Failed to add Sub Category.";
                    // Set $successMessage from session and unset it
                    $successMessage = $_SESSION['info'] ?? null;
                    unset($_SESSION['info']);
                ?>
                    <!-- Include jQuery library -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <!-- Include SweetAlert library -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>
                    <script>
                        $(document).ready(function() {
                            // Check if there's a success message and display an alert
                            <?php if ($successMessage) : ?>
                                Swal.fire({
                                    icon: 'failed',
                                    title: 'Failed',
                                    text: '<?php echo $successMessage; ?>',
                                    confirmButtonColor: '#FE9F43',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect to userlist.php
                                        window.location.href = '../subaddcategory.php?uid=<?php echo $UniqueId; ?>';
                                    }
                                });
                            <?php endif; ?>
                        });
                    </script>
                <?php
                }
            } else {
                $_SESSION['info'] = "A sub category with the same code already exist!.";
                // Set $successMessage from session and unset it
                $successMessage = $_SESSION['info'] ?? null;
                unset($_SESSION['info']);
                ?>
                <!-- Include jQuery library -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <!-- Include SweetAlert library -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>
                <script>
                    $(document).ready(function() {
                        // Check if there's a success message and display an alert
                        <?php if ($successMessage) : ?>
                            Swal.fire({
                                icon: 'warning',
                                title: 'warning',
                                text: '<?php echo $successMessage; ?>',
                                confirmButtonColor: '#FE9F43',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to userlist.php
                                    window.location.href = '../subaddcategory.php?uid=<?php echo $UniqueId; ?>';
                                }
                            });
                        <?php endif; ?>
                    });
                </script>
            <?php
            }
        } else {
            $_SESSION['info'] = "Category not found.";
            // Set $successMessage from session and unset it
            $successMessage = $_SESSION['info'] ?? null;
            unset($_SESSION['info']);
            ?>
            <!-- Include jQuery library -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <!-- Include SweetAlert library -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>
            <script>
                $(document).ready(function() {
                    // Check if there's a success message and display an alert
                    <?php if ($successMessage) : ?>
                        Swal.fire({
                            icon: 'warning',
                            title: 'warning',
                            text: '<?php echo $successMessage; ?>',
                            confirmButtonColor: '#FE9F43',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to userlist.php
                                window.location.href = '../subaddcategory.php?uid=<?php echo $UniqueId; ?>';
                            }
                        });
                    <?php endif; ?>
                });
            </script>
        <?php
        }
    } else {
        $_SESSION['info'] = "Please provide all required fields.";
        // Set $successMessage from session and unset it
        $successMessage = $_SESSION['info'] ?? null;
        unset($_SESSION['info']);
        ?>
        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include SweetAlert library -->
        <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
        <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
        <script>
            $(document).ready(function() {
                // Check if there's a success message and display an alert
                <?php if ($successMessage) : ?>
                    Swal.fire({
                        icon: 'warning',
                        title: 'warning',
                        text: '<?php echo $successMessage; ?>',
                        confirmButtonColor: '#FE9F43',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to userlist.php
                            window.location.href = '../subaddcategory.php?uid=<?php echo $UniqueId; ?>';
                        }
                    });
                <?php endif; ?>
            });
        </script>
<?php
    }
}

$conn->close();
?>