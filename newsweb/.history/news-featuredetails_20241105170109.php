<?php 
session_start();
include('includes/config.php');

// Genrating CSRF Token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['submit'])) {
    // Verifying CSRF Token
    if (!empty($_POST['csrftoken'])) {
        if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];
            $postid = intval($_GET['nid']);
            $st1 = '0';
            $query = mysqli_query($con, "INSERT INTO tblcomments(postId, name, email, comment, status) VALUES('$postid', '$name', '$email', '$comment', '$st1')");
            if($query):
                echo "<script>alert('Comment successfully submitted. Comment will be displayed after admin review.');</script>";
                unset($_SESSION['token']);
            else :
                echo "<script>alert('Something went wrong. Please try again.');</script>";  
            endif;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>News Portal | Home Page</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/modern-business.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .post-header {
            position: relative;
            width: 100%;
        }

        .post-title {
        position: absolute;
        top: 20%;
        left: 5%; /* Khoảng cách từ lề trái */
        right: 5%; /* Khoảng cách từ lề phải */
        font-size: 5rem;
        font-weight: bold;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        text-align: left; /* Căn trái nội dung */
    }
        .post-content {
            margin-top: 30px;
        }
        .left-column, .right-column {
            font-size: 0.9rem;
        }
        .share-icons a {
            margin-right: 10px;
            color: #555;
        }
    </style>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="row" style="margin-top: 4%">
        <div class="card post-header">
            <?php
            $pid = intval($_GET['nid']);
            $query = mysqli_query($con, "SELECT tblfeatureposts.PostTitle AS posttitle, tblfeatureposts.PostImage, tblcategory.CategoryName AS category, tblcategory.id AS cid, tblsubcategory.Subcategory AS subcategory, tblfeatureposts.PostDetails AS postdetails, tblfeatureposts.PostingDate AS postingdate, tblfeatureposts.PostUrl AS url FROM tblfeatureposts LEFT JOIN tblcategory ON tblcategory.id = tblfeatureposts.CategoryId LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblfeatureposts.SubCategoryId WHERE tblfeatureposts.id = '$pid'");
            while ($row = mysqli_fetch_array($query)) {
            ?>
            <div class="overflow-hidden" style="height: 100%; max-height: 450px">
              <img class="card-img-top w-100 h-auto" src="admin/featurepostimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">
              <h2 class="post-title"><?php echo htmlentities($row['posttitle']); ?></h2>
            </div>
        </div>

        <div class="row post-content">
            <!-- Left Column (Date and Share) -->
            <div class="col-md-2 left-column px-5">
                <p><?php echo date("F d, Y", strtotime($row['postingdate'])); ?></p>
                <p><b>Share:</b></p>
                <div class="share-icons">
                    <a href="#" onclick="copyLink()" title="Copy link"><i class="fas fa-link"></i></a>
                    <a href="https://facebook.com/share?url=<?php echo htmlentities($row['url']); ?>" target="_blank" title="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo htmlentities($row['url']); ?>" target="_blank" title="Share on X"><i class="fab fa-x-twitter"></i></a>
                    <a href="https://t.me/share/url?url=<?php echo htmlentities($row['url']); ?>" target="_blank" title="Share on Telegram"><i class="fab fa-telegram"></i></a>
                    <a href="#" title="Bookmark"><i class="fas fa-bookmark"></i></a>
                    <a href="javascript:window.print()" title="Print"><i class="fas fa-print"></i></a>
                </div>
            </div>

            <!-- Main Content Column (Post Details) -->
            <!-- Main Content Column (Post Details) -->
            <style>
                .content-padding {
                    padding-left: 100px;
                    padding-right: 100px;
                }

                /* Giảm padding khi ở màn hình nhỏ hơn */
                @media (max-width: 768px) {
                    .content-padding {
                        padding-left: 20px;
                        padding-right: 20px;
                    }
                }
            </style>

            <div class="col-md-8 px-5 pb-5">
                <div class="content-padding">
                    <p class="card-text">
                        <?php 
                            $pt = $row['postdetails'];
                            echo (substr($pt, 0)); 
                        ?>
                    </p>
                </div>
            </div>


            <!-- Right Column (Category) -->
            <div class="col-md-2 right-column px-5">
                <p><b>Category:</b> <a href="category.php?catid=<?php echo htmlentities($row['cid']) ?>"><?php echo htmlentities($row['category']); ?></a></p>
                <p><b>Sub Category:</b> <?php echo htmlentities($row['subcategory']); ?></p>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php
        // Kết nối đến cơ sở dữ liệu (giả sử đã được thiết lập)
        // $con là kết nối đến cơ sở dữ liệu của bạn

        if (isset($_GET['pageno'])) {
            $pageno4 = $_GET['pageno'];
        } else {
            $pageno4 = 1;
        }
        $no_of_records_per_page4 = 14; // Số bài viết hiển thị
        $offset4 = ($pageno4 - 1) * $no_of_records_per_page4;

        // Lấy dữ liệu bài viết từ cơ sở dữ liệu
        $query4 = mysqli_query($con, "SELECT tblrecentposts.id AS pid4,
            tblrecentposts.PostTitle AS posttitle4,
            tblrecentposts.PostImage,
            tblcategory.CategoryName AS category4,
            tblcategory.id AS cid4,
            tblsubcategory.Subcategory AS subcategory4,
            tblrecentposts.PostDetails AS postdetails4,
            tblrecentposts.PostingDate AS postingdate4,
            tblrecentposts.PostUrl AS url4 
            FROM tblrecentposts 
            LEFT JOIN tblcategory ON tblcategory.id = tblrecentposts.CategoryId 
            LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblrecentposts.SubCategoryId 
            WHERE tblrecentposts.Is_Active = 1 
            ORDER BY tblrecentposts.id DESC  
            LIMIT $offset4, $no_of_records_per_page4");

        // Kiểm tra xem truy vấn có thành công hay không
        if (!$query4) {
            die("Truy vấn không thành công: " . mysqli_error($con));
        }

        // Khởi tạo mảng lưu trữ bài viết
        $posts2 = [];
        while ($row4 = mysqli_fetch_array($query4)) {
            $posts2[] = $row4; // Thêm bài viết vào mảng
        }
        ?>

<div class="px-5 py-5">
    <!-- Tiêu đề Feature Posts -->
    <h1 class="mb-3" style="font-weight: 600;">READ NEXT</h1>

    <!-- Bố cục chứa các bài viết -->
    <div class="row" style="gap: 20px;">
      <div class="col-md-2">
          <?php
          // Hiển thị các bài viết
          foreach (array_slice($posts2, 0, 5) as $index => $post2) {
              echo '<div class=" mb-4 d-flex">'; // Sử dụng flex-column để có chiều cao đồng đều
              echo '<a href="news-recentdetails.php?nid=' . htmlentities($post2['pid4']) . '" class="text-decoration-none text-dark" style="display: block;">';
              echo '<div style="border: 1px solid #ccc; padding: 0; max-height: 100%; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 100%;">'; // Chiều cao 100%
              echo '<div class="overflow-hidden" style="height: 250px; width: 100%; border-radius: 5%;">'; // Ảnh với border-radius
              echo '<img src="admin/recentpostimages/' . htmlentities($post2['PostImage']) . '" class="w-100 h-100" style="object-fit: cover;" alt="' . htmlentities($post2['posttitle4']) . '">'; 
              echo '</div>';
              echo '<div style="padding: 10px; color: black; flex-grow: 1;">'; // Flex-grow để tạo khoảng trống
              echo '<h5 style="font-size: 16px; font-weight: bold;">' . htmlentities($post2['posttitle4']) . '</h5>';


              // Loại bỏ thẻ HTML và cắt ngắn nội dung
              $plainText = strip_tags($post2['postdetails4']); // Loại bỏ thẻ HTML
              $shortText = htmlentities(substr($plainText, 0, 100)); // Cắt ngắn nội dung và mã hóa
              echo '<p style="font-size: 14px;">' . $shortText . '...</p>'; // Hiển thị nội dung cắt ngắn

              echo '<small class="text-muted">' . htmlentities($post2['postingdate4']) . '</small>';
              echo '</div>';
              echo '</div>'; // Kết thúc thẻ bao ngoài
              echo '</a>';
              echo '</div>'; // Kết thúc custom-col
          }
          ?>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyLink() {
            navigator.clipboard.writeText(window.location.href);
            alert('Link copied to clipboard.');
        }
    </script>

    <?php include('includes/footer.php');?>
</body>
</html>