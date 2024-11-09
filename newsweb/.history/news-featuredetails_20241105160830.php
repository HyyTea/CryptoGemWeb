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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .post-header {
            position: relative;
            width: 100%;
        }
        .post-header img {
            width: 100%;
            height: auto;
            max-height: 450px;
        }
        .post-title {
            position: absolute;
            top: 20%;
            left: 10%;
            transform: translateX(-90%);
            font-size: 5rem;
            font-weight: bold;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
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
    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="row" style="margin-top: 4%">
        <div class="post-header">
            <?php
            $pid = intval($_GET['nid']);
            $query = mysqli_query($con, "SELECT tblfeatureposts.PostTitle AS posttitle, tblfeatureposts.PostImage, tblcategory.CategoryName AS category, tblcategory.id AS cid, tblsubcategory.Subcategory AS subcategory, tblfeatureposts.PostDetails AS postdetails, tblfeatureposts.PostingDate AS postingdate, tblfeatureposts.PostUrl AS url FROM tblfeatureposts LEFT JOIN tblcategory ON tblcategory.id = tblfeatureposts.CategoryId LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblfeatureposts.SubCategoryId WHERE tblfeatureposts.id = '$pid'");
            while ($row = mysqli_fetch_array($query)) {
            ?>
            <img class="img-fluid rounded" src="admin/featurepostimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>" style="object-fit: cover; height: 100%;">
            <h2 class="post-title"><?php echo htmlentities($row['posttitle']); ?></h2>
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

            <div class="col-md-8 px-5">
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

    <?php include('includes/footer.php'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyLink() {
            navigator.clipboard.writeText(window.location.href);
            alert('Link copied to clipboard.');
        }
    </script>
</body>
</html>
