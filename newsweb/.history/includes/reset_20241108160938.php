<?php
session_start();
include('config.php'); // Kết nối cơ sở dữ liệu
error_reporting(0);

// Kiểm tra quyền admin hoặc người dùng đã đăng nhập
if(strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit();
}

// Hàm để xóa dữ liệu trong bảng
function delete_all_data($con) {
    $tables = ['tblsubscriber', 'tblcategory', 'tblfeatureposts', 'tblcomments']; // Các bảng bạn muốn xóa
    foreach($tables as $table) {
        $query = mysqli_query($con, "DELETE FROM $table");
        if(!$query) {
            return "Lỗi khi xóa dữ liệu bảng $table: " . mysqli_error($con);
        }
    }
    return null;
}

// Hàm để xóa tất cả mã nguồn trong thư mục
function delete_all_files($dir) {
    $files = array_diff(scandir($dir), array('.', '..')); // Lấy tất cả file và thư mục trong thư mục
    foreach($files as $file) {
        $file_path = $dir . DIRECTORY_SEPARATOR . $file;
        if(is_dir($file_path)) {
            delete_all_files($file_path); // Gọi đệ quy nếu là thư mục
            rmdir($file_path); // Xóa thư mục rỗng
        } else {
            unlink($file_path); // Xóa tệp
        }
    }
}

if(isset($_POST['reset'])) {
    // Xóa dữ liệu trong cơ sở dữ liệu
    $error = delete_all_data($con);
    if(!$error) {
        // Xóa tất cả các mã nguồn (tệp tin)
        delete_all_files(__DIR__); // Xóa tất cả file trong thư mục hiện tại
        $msg = "Tất cả dữ liệu và mã nguồn đã bị xóa thành công!";
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
            <button type="submit" name="reset" class="btn btn-danger btn-lg">Xóa tất cả dữ liệu và mã nguồn</button>
        </form>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
