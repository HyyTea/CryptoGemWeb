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

        $total_pages_sql = "SELECT COUNT(*) FROM tblmainposts
                            UNION
                            SELECT COUNT(*) FROM tblfeatureposts
                            UNION
                            SELECT COUNT(*) FROM tblpopularposts
                            UNION
                            SELECT COUNT(*) FROM tblrecentposts";
        $result = mysqli_query($con, $total_pages_sql);
        $total_rows = 0;
        while ($row = mysqli_fetch_array($result)) {
          $total_rows += $row[0];
        }
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $query = "
          (SELECT tblmainposts.id as pid, tblmainposts.PostTitle as posttitle, tblmainposts.PostImage, 
            tblcategory.CategoryName as category, tblsubcategory.Subcategory as subcategory, 
            tblmainposts.PostDetails as postdetails, tblmainposts.PostingDate as postingdate, 
            tblmainposts.PostUrl as url 
          FROM tblmainposts 
          LEFT JOIN tblcategory ON tblcategory.id = tblmainposts.CategoryId
          LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblmainposts.SubCategoryId
          WHERE tblmainposts.CategoryId = '".$_SESSION['catid']."' AND tblmainposts.Is_Active = 1)
          UNION
          (SELECT tblfeatureposts.id as pid, tblfeatureposts.PostTitle as posttitle, tblfeatureposts.PostImage, 
            tblcategory.CategoryName as category, tblsubcategory.Subcategory as subcategory, 
            tblfeatureposts.PostDetails as postdetails, tblfeatureposts.PostingDate as postingdate, 
            tblfeatureposts.PostUrl as url 
          FROM tblfeatureposts 
          LEFT JOIN tblcategory ON tblcategory.id = tblfeatureposts.CategoryId
          LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblfeatureposts.SubCategoryId
          WHERE tblfeatureposts.CategoryId = '".$_SESSION['catid']."' AND tblfeatureposts.Is_Active = 1)
          UNION
          (SELECT tblpopularposts.id as pid, tblpopularposts.PostTitle as posttitle, tblpopularposts.PostImage, 
            tblcategory.CategoryName as category, tblsubcategory.Subcategory as subcategory, 
            tblpopularposts.PostDetails as postdetails, tblpopularposts.PostingDate as postingdate, 
            tblpopularposts.PostUrl as url 
          FROM tblpopularposts 
          LEFT JOIN tblcategory ON tblcategory.id = tblpopularposts.CategoryId
          LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblpopularposts.SubCategoryId
          WHERE tblpopularposts.CategoryId = '".$_SESSION['catid']."' AND tblpopularposts.Is_Active = 1)
          UNION
          (SELECT tblrecentposts.id as pid, tblrecentposts.PostTitle as posttitle, tblrecentposts.PostImage, 
            tblcategory.CategoryName as category, tblsubcategory.Subcategory as subcategory, 
            tblrecentposts.PostDetails as postdetails, tblrecentposts.PostingDate as postingdate, 
            tblrecentposts.PostUrl as url 
          FROM tblrecentposts 
          LEFT JOIN tblcategory ON tblcategory.id = tblrecentposts.CategoryId
          LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblrecentposts.SubCategoryId
          WHERE tblrecentposts.CategoryId = '".$_SESSION['catid']."' AND tblrecentposts.Is_Active = 1)
          ORDER BY pid DESC LIMIT $offset, $no_of_records_per_page
        ";

        $result = mysqli_query($con, $query);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount == 0) {
          echo "No record found";
        } else {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <h1><?php echo htmlentities($row['category']);?> News</h1>
            <div class="card mb-4">
              <img class="card-img-top" src="admin/<?php 
                // Kiểm tra nguồn bài viết để lấy đường dẫn hình ảnh và liên kết đúng
                if (strpos($row['url'], 'main') !== false) {
                  echo "mainpostimages/";
                } elseif (strpos($row['url'], 'feature') !== false) {
                  echo "featurepostimages/";
                } elseif (strpos($row['url'], 'popular') !== false) {
                  echo "popularpostimages/";
                } else {
                  echo "recentpostimages/";
                }
                echo htmlentities($row['PostImage']);
              ?>" alt="<?php echo htmlentities($row['posttitle']);?>">
              <div class="card-body">
                <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                <a href="news-<?php 
                  // Kiểm tra nguồn bài viết để xác định liên kết chi tiết
                  if (strpos($row['url'], 'main') !== false) {
                    echo "maindetails";
                  } elseif (strpos($row['url'], 'feature') !== false) {
                    echo "featuredetails";
                  } elseif (strpos($row['url'], 'popular') !== false) {
                    echo "populardetails";
                  } else {
                    echo "recentdetails";
                  }
                  ?>.php?nid=<?php echo htmlentities($row['pid'])?>" class="btn btn-primary">Read More &rarr;</a>
              </div>
              <div class="card-footer text-muted">
                Posted on <?php echo htmlentities($row['postingdate']);?>
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
