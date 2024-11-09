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
  <div class="">

    <div class="row" style="margin-top: 4%">

      <!-- Blog Entries Column -->
      <div class="col-md-12">

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
        $no_of_records_per_page = 50;
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
        ?>
        
        <div class="px-5 py-5">
          <h5 class="mb-3" style="font-weight: 600;">Recent Posts</h5>
          <div class="row">
            <?php 
            while ($row = mysqli_fetch_array($result)) {
              // Xác định loại bài viết để lấy hình ảnh và liên kết chi tiết
              $postType = $row['type'];
              $postImage = $row['PostImage'];
              $postTitle = $row['posttitle'];
              $postId = $row['pid'];
              $postingDate = $row['postingdate'];
            ?>
              <div class="col-md-2 mb-4">
                <a href="news-<?php echo $postType;?>details.php?nid=<?php echo htmlentities($postId);?>" class="text-decoration-none text-dark">
                  <div style="border: 1px solid #ccc; padding: 0; height: 100%; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div class="overflow-hidden" style="height: 200px; width: 100%; border-radius: 5%;">
                      <img src="admin/<?php echo $postType;?>postimages/<?php echo htmlentities($postImage);?>" class="w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlentities($postTitle);?>">
                    </div>
                    <div style="padding: 10px; color: black;">
                      <h6 style="font-size: 14px; font-weight: bold;"><?php echo htmlentities($postTitle);?></h6>
                      <small class="text-muted"><?php echo htmlentities($postingDate);?></small>
                    </div>
                  </div>
                </a>
              </div>
            <?php 
            }
            ?>
          </div>
        </div>

        <?php 
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
