<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(strlen($_SESSION['login'])==0) { 
    header('location:index.php');
} else {

    if(isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['pid'])) {
        $postid = intval($_GET['pid']);
        // Chuyển dữ liệu vào bảng thùng rác
        $query = mysqli_query($con, "INSERT INTO tblsubscriber_trash SELECT * FROM tblsubscriber WHERE id='$postid'");
        if($query) {
            // Xóa bản ghi khỏi bảng chính
            $queryDelete = mysqli_query($con, "DELETE FROM tblsubscriber WHERE id='$postid'");
            if($queryDelete) {
                $msg = "Subscriber moved to trash";
            } else {
                $error = "Something went wrong while deleting.";
            }
        } else {
            $error = "Something went wrong while moving to trash.";
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

    <title>Newsportal | Manage Subscribers</title>

    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">

    <div id="wrapper">

        <!-- Top Bar Start -->
        <?php include('includes/topheader.php');?>

        <!-- Left Sidebar Start -->
        <?php include('includes/leftsidebar.php');?>

        <div class="content-page">
            <div class="content">
                <div class="container">

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Manage Subscribers</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li><a href="#">Admin</a></li>
                                    <li><a href="#">Subscriber</a></li>
                                    <li class="active">Manage Subscribers</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table table-colored table-centered table-inverse m-0">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = mysqli_query($con, "SELECT id AS postid, email, created_at FROM tblsubscriber WHERE Is_Active = 1");
                                            $rowcount = mysqli_num_rows($query);
                                            if($rowcount == 0) {
                                                echo '<tr><td colspan="3" align="center"><h3 style="color:red">No record found</h3></td></tr>';
                                            } else {
                                                while($row = mysqli_fetch_array($query)) {
                                            ?>
                                                    <tr>
                                                        <td><b><?php echo htmlentities($row['email']);?></b></td>
                                                        <td><?php echo htmlentities($row['created_at']); ?></td>
                                                        <td>
                                                            <a href="manage-subscriber.php?pid=<?php echo htmlentities($row['postid']);?>&action=del" onclick="return confirm('Do you really want to delete?')"><i class="fa fa-trash-o" style="color: #f05050"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php 
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php include('includes/footer.php');?>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>
</body>
</html>
<?php } ?>