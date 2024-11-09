<?php 
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>News Portal | Category Page</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <?php include('includes/header.php');?>

  <!-- Page Content -->
  <div class="container">

    <div class="row" style="margin-top: 4%">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <!-- Blog Post -->
        <?php 
        if ($_GET['catid'] != '') {
          $_SESSION['catid'] = intval($_GET['catid']);
        }

        if (isset($_GET['pageno'])) {
          $pageno = $_GET['pageno'];
        } else {
          $pageno = 1;
        }
        $no_of_records_per_page = 8;
        $offset = ($pageno - 1) * $no_of_records_per_page;

        // Tổng số bản ghi
        $total_pages_sql = "
          SELECT COUNT(*) FROM tblmainposts WHERE CategoryId = '".$_SESSION['catid']."' AND Is_Active = 1
          UNION
          SELECT COUNT(*) FROM tblfeatureposts WHERE CategoryId = '".$_SESSION['catid']."' AND Is_Active = 1
          UNION
          SELECT COUNT(*) FROM tblpopularposts WHERE CategoryId = '".$_SESSION['catid']."' AND Is_Active = 1
          UNION
          SELECT COUNT(*) FROM tblrecentposts WHERE CategoryId = '".$_SESSION['catid']."' AND Is_Active = 1
        ";
        $result = mysqli_query($con, $total_pages_sql);
        $total_rows = 0;
        while ($row = mysqli_fetch_array($result)) {
          $total_rows += $row[0];
        }
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        // Lấy dữ liệu từ các bảng khác nhau
        $query = "
          (SELECT id as pid, PostTitle as posttitle, PostImage, 
            'main' as type, PostingDate as postingdate 
          FROM tblmainposts 
          WHERE CategoryId = '".$_SESSION['catid']."' AND Is_Active = 1)
          UNION
          (SELECT id as pid, PostTitle as posttitle, PostImage, 
            'feature' as type, PostingDate as postingdate 
          FROM tblfeatureposts 
          WHERE CategoryId = '".$_SESSION['catid']."' AND Is_Active = 1)
          UNION
          (SELECT id as pid, PostTitle as posttitle, PostImage, 
            'popular' as type, PostingDate as postingdate 
          FROM tblpopularposts 
          WHERE CategoryId = '".$_SESSION['catid']."' AND Is_Active = 1)
          UNION
          (SELECT id as pid, PostTitle as posttitle, PostImage, 
            'recent' as type, PostingDate as postingdate 
          FROM tblrecentposts 
          WHERE CategoryId = '".$_SESSION['catid']."' AND Is_Active = 1)
          ORDER BY postingdate DESC LIMIT $offset, $no_of_records_per_page
        ";

        $result = mysqli_query($con, $query);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount == 0) {
          echo "No record found";
        } else {
          while ($row = mysqli_fetch_array($result)) {
            // Xác định loại bài viết để lấy hình ảnh và liên kết chi tiết
            $postType = $row['type'];
            $postImage = $row['PostImage'];
            $postTitle = $row['posttitle'];
            $postId = $row['pid'];
            $postingDate = $row['postingdate'];
        ?>
            <h1><?php echo htmlentities($_SESSION['catid']);?> News</h1>
            <div class="card mb-4">
              <!-- Lấy hình ảnh từ thư mục tương ứng -->
              <img class="card-img-top" src="admin/<?php echo $postType;?>postimages/<?php echo htmlentities($postImage);?>" alt="<?php echo htmlentities($postTitle);?>">
              <div class="card-body">
                <h2 class="card-title"><?php echo htmlentities($postTitle);?></h2>
                <!-- Liên kết đến trang chi tiết tương ứng -->
                <a href="news-<?php echo $postType;?>details.php?nid=<?php echo htmlentities($postId);?>" class="btn btn-primary">Read More &rarr;</a>
              </div>
              <div class="card-footer text-muted">
                Posted on <?php echo htmlentities($postingDate);?>
              </div>
            </div>
        <?php 
          }
        }
        ?>

        <ul class="pagination justify-content-center mb-4">
          <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
          <li class="<?php if ($pageno <= 1) { echo 'disabled'; } ?> page-item">
            <a href="<?php if ($pageno <= 1) { echo '#'; } else { echo "?pageno=" . ($pageno - 1); } ?>" class="page-link">Prev</a>
          </li>
          <li class="<?php if ($pageno >= $total_pages) { echo 'disabled'; } ?> page-item">
            <a href="<?php if ($pageno >= $total_pages) { echo '#'; } else { echo "?pageno=" . ($pageno + 1); } ?>" class="page-link">Next</a>
          </li>
          <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
        </ul>
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php include('includes/footer.php');?>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
