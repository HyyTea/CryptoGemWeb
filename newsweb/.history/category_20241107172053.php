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
          if($_GET['catid']!=''){
            $_SESSION['catid']=intval($_GET['catid']);
          }

          if (isset($_GET['pageno'])) {
              $pageno = $_GET['pageno'];
          } else {
              $pageno = 1;
          }
          $no_of_records_per_page = 8;
          $offset = ($pageno-1) * $no_of_records_per_page;

          $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
          $result = mysqli_query($con,$total_pages_sql);
          $total_rows = mysqli_fetch_array($result)[0];
          $total_pages = ceil($total_rows / $no_of_records_per_page);

          // Chỉnh sửa truy vấn SQL để lấy dữ liệu từ nhiều bảng
          $query = mysqli_query($con, "
            SELECT tblposts.id as pid, tblposts.PostTitle as posttitle, tblposts.PostImage, 
              tblcategory.CategoryName as category, tblsubcategory.Subcategory as subcategory, 
              tblposts.PostDetails as postdetails, tblposts.PostingDate as postingdate, tblposts.PostUrl as url, 
              tblposts.PostType
            FROM tblposts
            LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId
            LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblposts.SubCategoryId
            WHERE tblposts.CategoryId = '".$_SESSION['catid']."' 
              AND tblposts.Is_Active = 1
            ORDER BY tblposts.id DESC
            LIMIT $offset, $no_of_records_per_page
          ");

          $rowcount = mysqli_num_rows($query);
          if ($rowcount == 0) {
              echo "No record found";
          } else {
              while ($row = mysqli_fetch_array($query)) {
                  $postType = $row['PostType']; // Lấy loại bài viết để phân biệt nguồn hình ảnh và liên kết
                  $imagePath = "";
                  $detailLink = "";

                  // Điều chỉnh nguồn ảnh và liên kết chi tiết tùy theo loại bài viết
                  if ($postType == 'main') {
                      $imagePath = "admin/mainpostimages/".$row['PostImage'];
                      $detailLink = "news-maindetails.php?nid=".$row['pid'];
                  } elseif ($postType == 'feature') {
                      $imagePath = "admin/featurepostimages/".$row['PostImage'];
                      $detailLink = "news-featuredetails.php?nid=".$row['pid'];
                  } elseif ($postType == 'popular') {
                      $imagePath = "admin/popularpostimages/".$row['PostImage'];
                      $detailLink = "news-populardetails.php?nid=".$row['pid'];
                  } elseif ($postType == 'recent') {
                      $imagePath = "admin/recentpostimages/".$row['PostImage'];
                      $detailLink = "news-recentdetails.php?nid=".$row['pid'];
                  }
          ?>
              <h1><?php echo htmlentities($row['category']);?> News</h1>
              <div class="card mb-4">
                  <img class="card-img-top" src="<?php echo $imagePath; ?>" alt="<?php echo htmlentities($row['posttitle']);?>">
                  <div class="card-body">
                      <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                      <a href="<?php echo $detailLink; ?>" class="btn btn-primary">Read More &rarr;</a>
                  </div>
                  <div class="card-footer text-muted">
                      Posted on <?php echo htmlentities($row['postingdate']);?>
                  </div>
              </div>
          <?php } ?>

          <ul class="pagination justify-content-center mb-4">
              <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
              <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                  <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
              </li>
              <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
                  <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" class="page-link">Next</a>
              </li>
              <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
          </ul>
          <?php } ?>
        </div>

        <!-- Sidebar Widgets Column -->
        <?php include('includes/sidebar.php');?>

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
