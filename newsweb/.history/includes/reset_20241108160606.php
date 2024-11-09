<?php
session_start();
include('includes/config.php'); // Kết nối cơ sở dữ liệu
error_reporting(0);

// Kiểm tra quyền admin hoặc người dùng đã đăng nhập
if(strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit();
}

// Kiểm tra nếu người dùng nhấn nút Reset
if(isset($_POST['reset'])) {
    // Lệnh SQL xóa tất cả dữ liệu trong các bảng quan trọng
    $tables = ['tblsubscriber', 'tblcategory', 'tblfeatureposts', 'tblcomments']; // Các bảng bạn muốn xóa
    foreach($tables as $table) {
        $query = mysqli_query($con, "DELETE FROM $table");
        if(!$query) {
            $error = "Lỗi khi xóa bảng $table: " . mysqli_error($con);
            break;
        }
    }

    if(!isset($error)) {
        $msg = "Tất cả dữ liệu đã bị xóa thành công!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset NewsWeb</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">Reset NewsWeb</h2>
        
        <?php if(isset($msg)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } elseif(isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form method="POST" class="text-center">
            <button type="submit" name="reset" class="btn btn-danger btn-lg">Xóa tất cả dữ liệu</button>
        </form>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
