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
  <title>News Portal | Search Page</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/modern-business.css" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="css/modern-business.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <?php include('includes/header.php');?>

  <div class="container">
    <div class="row" style="margin-top: 4%">
      <div class="col-md-8">

        <?php 
        if ($_POST['searchtitle'] != '') {
          $st = $_SESSION['searchtitle'] = $_POST['searchtitle'];
        }

        $pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
        $no_of_records_per_page = 8;
        $offset = ($pageno - 1) * $no_of_records_per_page;

        // Query để lấy dữ liệu từ các bảng
        $query = mysqli_query($con, "
          SELECT id as pid, PostTitle as posttitle, PostingDate as postingdate, PostImage, 'main' as type FROM tblmainposts WHERE PostTitle LIKE '%$st%' AND Is_Active=1
          UNION
          SELECT id as pid, PostTitle as posttitle, PostingDate as postingdate, PostImage, 'feature' as type FROM tblfeatureposts WHERE PostTitle LIKE '%$st%' AND Is_Active=1
          UNION
          SELECT id as pid, PostTitle as posttitle, PostingDate as postingdate, PostImage, 'popular' as type FROM tblpopularposts WHERE PostTitle LIKE '%$st%' AND Is_Active=1
          UNION
          SELECT id as pid, PostTitle as posttitle, PostingDate as postingdate, PostImage, 'recent' as type FROM tblrecentposts WHERE PostTitle LIKE '%$st%' AND Is_Active=1
          LIMIT $offset, $no_of_records_per_page
        ");

        $rowcount = mysqli_num_rows($query);
        if ($rowcount == 0) {
          echo "No record found";
        } else {
          echo '<div class="px-5 py-5">';
          echo '<h5 class="mb-3" style="font-weight: 600;">Recent Posts</h5>';
          echo '<div class="row">';

          while ($row = mysqli_fetch_array($query)) {
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

          echo '</div></div>';
        }
        ?>

        <ul class="pagination justify-content-center mb-4">
          <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
          <li class="page-item <?php if ($pageno <= 1) echo 'disabled'; ?>">
            <a href="<?php if ($pageno <= 1) echo '#'; else echo "?pageno=" . ($pageno - 1); ?>" class="page-link">Prev</a>
          </li>
          <li class="page-item <?php if ($pageno >= $total_pages) echo 'disabled'; ?>">
            <a href="<?php if ($pageno >= $total_pages) echo '#'; else echo "?pageno=" . ($pageno + 1); ?>" class="page-link">Next</a>
          </li>
          <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
        </ul>

      </div>

      <?php include('includes/sidebar.php');?>

    </div>
  </div>

  <?php include('includes/footer.php');?>

</body>

</html>
