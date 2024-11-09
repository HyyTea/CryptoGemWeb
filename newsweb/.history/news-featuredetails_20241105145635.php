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
        }
        .post-title {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2rem;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row" style="margin-top: 4%">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <!-- Blog Post -->
                <?php
                $pid = intval($_GET['nid']);
                $query = mysqli_query($con, "SELECT tblfeatureposts.PostTitle AS posttitle, tblfeatureposts.PostImage, tblcategory.CategoryName AS category, tblcategory.id AS cid, tblsubcategory.Subcategory AS subcategory, tblfeatureposts.PostDetails AS postdetails, tblfeatureposts.PostingDate AS postingdate, tblfeatureposts.PostUrl AS url FROM tblfeatureposts LEFT JOIN tblcategory ON tblcategory.id = tblfeatureposts.CategoryId LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblfeatureposts.SubCategoryId WHERE tblfeatureposts.id = '$pid'");
                while ($row = mysqli_fetch_array($query)) {
                ?>
                <div class="post-header">
                    <img class="img-fluid rounded" src="admin/featurepostimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">
                    <h2 class="post-title"><?php echo htmlentities($row['posttitle']); ?></h2>
                </div>
                <p><b>Category : </b> <a href="category.php?catid=<?php echo htmlentities($row['cid']) ?>"><?php echo htmlentities($row['category']); ?></a> |
                    <b>Sub Category : </b><?php echo htmlentities($row['subcategory']); ?> <b> Posted on </b><?php echo htmlentities($row['postingdate']); ?></p>
                <hr />
                <p class="card-text"><?php 
                    $pt = $row['postdetails'];
                    echo (substr($pt, 0)); ?></p>
                <?php } ?>
            </div>

            <!-- Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>
        </div>
        <!-- /.row -->

        <!---Comment Section --->
        <div class="row" style="margin-top: -8%">
            <div class="col-md-8">
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form name="Comment" method="post">
                            <input type="hidden" name="csrftoken" value='<?php echo htmlentities($_SESSION['token']); ?>' />
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter your fullname" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter your Valid email" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                </div>

                <!---Comment Display Section --->
                <?php 
                $sts = 1;
                $query = mysqli_query($con, "SELECT name, comment, postingDate FROM tblcomments WHERE postId = '$pid' AND status = '$sts'");
                while ($row = mysqli_fetch_array($query)) {
                ?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo htmlentities($row['name']); ?> <br />
                            <span style="font-size:11px;"><b>at</b> <?php echo htmlentities($row['postingDate']); ?></span>
                        </h5>
                        <?php echo htmlentities($row['comment']); ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
