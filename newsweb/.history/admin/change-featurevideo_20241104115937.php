<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else {
    if (isset($_POST['update'])) {
        $postid = intval($_GET['pid']);
        $postVideo = $_POST['postvideo'];
        
        // Biến để lưu thông báo lỗi
        $error = "";

        // Kiểm tra nếu người dùng nhập URL hoặc mã nhúng (iframe)
        if (!empty($postVideo)) {
            // Nếu là mã nhúng iframe, trích xuất URL
            if (strpos($postVideo, '<iframe') !== false) {
                preg_match('/src="([^"]+)"/', $postVideo, $matches);
                if (isset($matches[1])) {
                    $postVideo = $matches[1]; // Sử dụng URL từ iframe
                } else {
                    echo "<script>alert('Invalid embed code.');</script>";
                    return;
                }
            }

            // Kiểm tra nếu là URL hợp lệ
            if (filter_var($postVideo, FILTER_VALIDATE_URL)) {
                // Nếu là URL YouTube, chuyển đổi thành mã nhúng
                if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $postVideo, $matches)) {
                    $videoId = $matches[1];
                    $postVideo = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
                }
            } else {
                echo "<script>alert('Invalid video format. Please provide a valid URL or embed code.');</script>";
                return;
            }
        }

        // Kiểm tra upload video
        if (isset($_FILES['uploadvideo']) && $_FILES['uploadvideo']['error'] == 0) {
            // Xác định đường dẫn lưu video
            $targetDir = "featurepostvideo/";
            $targetFile = $targetDir . basename($_FILES["uploadvideo"]["name"]);
            $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Kiểm tra định dạng file
            $allowedTypes = array('mp4', 'avi', 'mov', 'wmv');
            if (!in_array($videoFileType, $allowedTypes)) {
                echo "<script>alert('Invalid video format. Only MP4, AVI, MOV, and WMV are allowed.');</script>";
                return;
            }

            // Di chuyển file upload vào thư mục đã chỉ định
            if (move_uploaded_file($_FILES["uploadvideo"]["tmp_name"], $targetFile)) {
                $postVideo = basename($_FILES["uploadvideo"]["name"]); // Chỉ lưu tên file
            } else {
                echo "<script>alert('There was an error uploading the video.');</script>";
                return;
            }
        } elseif (empty($postVideo)) {
            echo "<script>alert('Invalid video format. Please provide a valid URL, embed code, or upload a video file.');</script>";
            return;
        }

        // Tiến hành lưu vào cơ sở dữ liệu
        $query = mysqli_query($con, "UPDATE tblfeaturevideo SET PostVideo='$postVideo' WHERE id='$postid'");
        
        if($query) {
            $msg = "Post video updated successfully";
        } else {
            $error = "Something went wrong. Please try again.";    
        }
    }    

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Newsportal | Add Post</title>
        <!-- Summernote css -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />
        <!-- Select2 -->
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- Jquery filer css -->
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
        <script>
        function getSubCat(val) {
            $.ajax({
                type: "POST",
                url: "get_subcategory.php",
                data: 'catid=' + val,
                success: function(data) {
                    $("#subcategory").html(data);
                }
            });
        }
        </script>
    </head>
    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <?php include('includes/topheader.php');?>
            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php');?>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Update Video </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li><a href="#">Admin</a></li>
                                        <li><a href="#"> Posts </a></li>
                                        <li><a href="#"> Edit Posts </a></li>
                                        <li class="active">Update Video</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-sm-6">  
                                <!---Success Message--->  
                                <?php if($msg){ ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                </div>
                                <?php } ?>
                                <!---Error Message--->
                                <?php if($error){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <form name="addpost" method="post" enctype="multipart/form-data">
                        <?php
                        $postid = intval($_GET['pid']);
                        $query = mysqli_query($con, "select PostVideo,PostTitle from tblfeaturevideo where id='$postid' and Is_Active=1 ");
                        while($row = mysqli_fetch_array($query))
                        {
                        ?>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="p-6">
                                        <div class="">
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Post Title</label>
                                                <input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['PostTitle']);?>" name="posttitle" readonly>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Current Post Video</b></h4>
                                                        <?php if (strpos($row['PostVideo'], '<iframe') !== false) { ?>
                                                            <?php echo $row['PostVideo']; // Hiển thị mã nhúng iframe ?>
                                                        <?php } else { ?>
                                                            <video width="300" controls>
                                                                <source src="featurepostvideo/<?php echo htmlentities($row['PostVideo']); ?>" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        <?php } ?>
                                                        <br />
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Upload New Video or Embed Video</b></h4>
                                                        <div class="form-group">
                                                            <label for="uploadvideo">Upload Video</label>
                                                            <input type="file" name="uploadvideo" id="uploadvideo" accept="video/*" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="postvideo">Embed Video Code or URL</label>
                                                            <input type="text" name="postvideo" id="postvideo" class="form-control" placeholder="Enter video URL or embed code">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-right m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="update">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> <!-- container -->
                </div> <!-- content -->
                <footer class="footer">
                    © 2024. All rights reserved.
                </footer>
            </div> <!-- End Right content -->
        </div> <!-- END wrapper -->
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="plugins/switchery/switchery.min.js"></script>
        <script src="assets/js/app.js"></script>
    </body>
</html>
<?php } ?>