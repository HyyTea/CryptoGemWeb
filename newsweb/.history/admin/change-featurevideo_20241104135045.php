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
    
        // Kiểm tra nếu người dùng nhập URL hoặc mã nhúng (iframe)
        if (!empty($postVideo) || !empty($_FILES['uploadvideo']['name'])) {
            // Nếu là mã nhúng iframe, trích xuất URL
            if (strpos($postVideo, '<iframe') !== false) {
                preg_match('/src="([^"]+)"/', $postVideo, $matches);
                if (isset($matches[1])) {
                    $postVideo = $matches[1];
                    if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $postVideo, $matches)) {
                        $videoId = $matches[1];
                        $postVideo = 'https://www.youtube.com/watch?v=' . $videoId;
                    }
                } else {
                    echo "<script>alert('Invalid embed code.');</script>";
                    return;
                }
            } elseif (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $postVideo)) {
                // Giữ nguyên URL YouTube nếu đã có
            } else {
                if (!filter_var($postVideo, FILTER_VALIDATE_URL)) {
                    echo "<script>alert('Invalid video format. Please provide a valid URL or embed code.');</script>";
                    return;
                }
            }
    
            // Xử lý upload video file
            if (!empty($_FILES['uploadvideo']['name'])) {
                $targetDir = "featurepostvideo/"; // Thư mục để lưu video
                $targetFile = $targetDir . basename($_FILES['uploadvideo']['name']);
                $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
                // Kiểm tra định dạng file
                $allowedFormats = ['mp4', 'avi', 'mov', 'wmv'];
                if (in_array($videoFileType, $allowedFormats)) {
                    // Di chuyển file đến thư mục đã chỉ định
                    if (move_uploaded_file($_FILES['uploadvideo']['tmp_name'], $targetFile)) {
                        $postVideo = basename($_FILES['uploadvideo']['name']); // Lưu tên file video
                    } else {
                        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                        return;
                    }
                } else {
                    echo "<script>alert('Sorry, only MP4, AVI, MOV, & WMV files are allowed.');</script>";
                    return;
                }
            }
    
            // Tiến hành lưu vào cơ sở dữ liệu
            $query = mysqli_query($con, "UPDATE tblfeaturevideo SET PostVideo='$postVideo' WHERE id='$postid'");
    
            if ($query) {
                $msg = "Post video updated successfully";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        } else {
            echo "<script>alert('Invalid video format. Please provide a valid URL, embed code, or upload a video file.');</script>";
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
  data:'catid='+val,
  success: function(data){
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
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#"> Posts </a>
                                        </li>
                                           <li>
                                            <a href="#"> Edit Posts </a>
                                        </li>
                                        <li class="active">
                                           Update Video
                                        </li>
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
$postid=intval($_GET['pid']);
$query=mysqli_query($con,"select PostVideo,PostTitle from tblfeaturevideo where id='$postid' and Is_Active=1 ");
while($row=mysqli_fetch_array($query))
{
?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post">
 <div class="form-group m-b-20">
<label for="exampleInputEmail1">Post Title</label>
<input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['PostTitle']);?>" name="posttitle"  readonly>
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
            <h4 class="m-b-30 m-t-0 header-title"><b>New Feature Video</b></h4>
            <textarea class="form-control" id="postvideo" name="postvideo" placeholder="Enter Video URL or Embed Code"></textarea>
            
            <label for="uploadvideo">Or upload a video file (URL or Embed Code Recommended!):</label>
            <input type="file" class="form-control" id="uploadvideo" name="uploadvideo" accept="video/*">
        </div>
    </div>
</div>



<button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update </button>
</form>
                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



                    </div> <!-- container -->

                </div> <!-- content -->

           <?php include('includes/footer.php');?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


  <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>



    </body>
</html>
<?php } ?>