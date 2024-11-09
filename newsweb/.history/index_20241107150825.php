<?php
session_start();
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CryptoGem</title>
<!-- #region -->
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/modern-business.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

    <style>
    .rounded-pill {
        border-radius: 50rem;
        padding: 10px 20px;
        margin: 5px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
    }
    @media (max-width: 768px) {
    .col-md-2 {
        width: 48%;
        margin-bottom: 10px; /* Reduce bottom margin for closer spacing */
    }

    .col-6 {
        width: 48%;
        margin-top: -10px; /* Reduce top margin */
    }


}

    </style>
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


    <!-- Navigation -->
    <?php
    include('includes/header.php');
    ?>

    <!-- Page Content -->
    <div class="row" style="margin-top: 4%">
       
        <!-- Blog Entries Column -->
        <div class="col-md-12">
        <!-- <div class="col-md-8"> -->

            <!-- Blog Post -->
<?php 
    if (isset($_GET['pageno'])) {
        $pageno1 = $_GET['pageno'];
    }   else {
        $pageno1 = 1;
    }
    $no_of_records_per_page1 = 1;
    $offset1 = ($pageno1-1) * $no_of_records_per_page1;

    $total_pages_sql1 = "SELECT COUNT(*) FROM tblmainposts";
    $result1 = mysqli_query($con, $total_pages_sql1);
    $total_rows1 = mysqli_fetch_array($result1)[0];
    $total_pages1 = ceil($total_rows1 / $no_of_records_per_page1);


$query1 = mysqli_query($con, "select tblmainposts.id as pid1,
tblmainposts.PostTitle as posttitle1,
tblmainposts.PostImage,
tblcategory.CategoryName as category1,
tblcategory.id as cid1,
tblsubcategory.Subcategory as subcategory1,
tblmainposts.PostDetails as postdetails1,
tblmainposts.PostingDate as postingdate1,
tblmainposts.PostUrl as url1 from tblmainposts left join tblcategory on tblcategory.id=tblmainposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblmainposts.SubCategoryId where tblmainposts.Is_Active=1 order by tblmainposts.id desc  LIMIT $offset1, $no_of_records_per_page1");
while ($row1 = mysqli_fetch_array($query1)) {
?>

    <div class="card">
        <a href="news-maindetails.php?nid=<?php echo htmlentities($row1['pid1']) ?>" class="d-block text-decoration-none">
            <div class="overflow-hidden" style="height: 50%; max-height: 650px">
                <img class="card-img-top w-100 h-auto" src="admin/mainpostimages/<?php echo htmlentities($row1['PostImage']); ?>" alt="<?php echo htmlentities($row1['posttitle1']) ?>">
            </div>
            <div class="card-img-overlay d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <p class="mb-2 fw-bold text-center">
                        <span class="text-light border border-dark rounded-pill py-2 bg-dark">
                            <?php echo htmlentities($row1['category1']); ?>
                        </span>
                    </p>
                    <h2 style="font-weight: bold; max-width: 450px; color: black;" class="card-title mb-2 text-center display-5"><?php echo htmlentities($row1['posttitle1']); ?></h2>
                    <div class="text-muted small text-center"><?php echo htmlentities($row1['postingdate1']); ?></div>
                </div>
            </div>
        </a>
    </div>
    
<?php
}
?>


<div class="px-5 py-5">
    <!-- Tiêu đề phần trên cùng -->
    <h5 class="mb-3" style="font-weight: 600;">Top Category</h5>

    <!-- Hàng ngang chứa 5 hình ảnh và tên category tương ứng -->
    <div class="row d-flex justify-content-between flex-wrap">
        <!-- Hình ảnh và tên Category 1 -->
        <div class="col-md-2 col-6 text-center mb-4">
            <a class="text-decoration-none" href="category.php?catid=<?php echo htmlentities("Charts"); ?>">
                <div class="overflow-hidden" style="height: 100%; max-height: 764px;">
                    <img class="card-img-top w-100 h-auto" src="admin/mainpostimages/Category1.jpg" alt="Charts">
                </div>
                <div style="font-weight: 500; color: black; font-size: 20px">
                    <?php echo htmlentities("Charts"); ?>   
                </div>
            </a>
        </div>

        <!-- Hình ảnh và tên Category 2 -->
        <div class="col-md-2 col-6 text-center mb-4">
            <a class="text-decoration-none" href="category.php?catid=<?php echo htmlentities("GameFi"); ?>">
                <div class="overflow-hidden" style="height: 100%; max-height: 764px;">
                    <img class="card-img-top w-100 h-auto" src="admin/mainpostimages/Category2.jpg" alt="GameFi">
                </div>
                <div style="font-weight: 500; color: black; font-size: 20px">
                    <?php echo htmlentities("GameFi"); ?>   
                </div>
            </a>
        </div>

        <!-- Hình ảnh và tên Category 3 -->
        <div class="col-md-2 col-6 text-center mb-4">
            <a class="text-decoration-none" href="category.php?catid=<?php echo htmlentities("Experience"); ?>">
                <div class="overflow-hidden" style="height: 100%; max-height: 764px;">
                    <img class="card-img-top w-100 h-auto" src="admin/mainpostimages/Category3.jpg" alt="Experience">
                </div>
                <div style="font-weight: 500; color: black; font-size: 20px">
                    <?php echo htmlentities("Experience"); ?>   
                </div>
            </a>
        </div>

        <!-- Hình ảnh và tên Category 4 -->
        <div class="col-md-2 col-6 text-center mb-4">
            <a class="text-decoration-none" href="category.php?catid=<?php echo htmlentities("Knowledge"); ?>">
                <div class="overflow-hidden" style="height: 100%; max-height: 764px;">
                    <img class="card-img-top w-100 h-auto" src="admin/mainpostimages/Category4.jpg" alt="Knowledge">
                </div>
                <div style="font-weight: 500; color: black; font-size: 20px">
                    <?php echo htmlentities("Knowledge"); ?>   
                </div>
            </a>
        </div>

        <!-- Hình ảnh và tên Category 5 -->
        <div class="col-md-2 col-6 text-center mb-4">
            <a class="text-decoration-none" href="category.php?catid=<?php echo htmlentities("Analysis"); ?>">
                <div class="overflow-hidden" style="height: 100%; max-height: 764px;">
                    <img class="card-img-top w-100 h-auto" src="admin/mainpostimages/Category5.jpg" alt="Analysis">
                </div>
                <div style="font-weight: 500; color: black; font-size: 20px">
                    <?php echo htmlentities("Analysis"); ?>   
                </div>
            </a>
        </div>
    </div>
</div>


<!-- <div class="top-category; mx-5">
<h2 style="">Top Category</h2>
<div class="overflow-hidden" style="display: flex; justify-content: space-between; max-height: 650px;">
<?php
// Assuming you have a database connection established
$categories = ['Charts', 'GameFi', 'Experience', 'Knowledge', 'Analysis'];
$imagePaths = [
'admin/mainpostimages/Category1.jpg',
'admin/mainpostimages/Category2.jpg',
'admin/mainpostimages/Category3.jpg',
'admin/mainpostimages/Category4.jpg',
'admin/mainpostimages/Category5.jpg'
];

// Loop through the images and categories
for ($i = 0; $i < count($categories); $i++) {
echo '<div style="text-align: center;">';
echo '<a class="text-decoration-none" href="category.php?catid=' . htmlentities($categories[$i]) . '">'; // Sửa phần này
echo '<div class="overflow-hidden" style="height; 100%; max-height: 764px;">';
echo '<img class="card-img-top w-100 h-auto" src="' . htmlentities($imagePaths[$i]) . '" alt="' . htmlentities($categories[$i]) . '">';
echo '</div>';
echo '<p style="font-weight: 500; color: black; font-size: 20px">' . htmlentities($categories[$i]) . '</p>'; // Display category name
echo '</a>';
echo '</div>';
}
?>
</div>
</div> -->


<?php
// Kết nối đến cơ sở dữ liệu (giả sử đã được thiết lập)
// $con là kết nối đến cơ sở dữ liệu của bạn

if (isset($_GET['pageno'])) {
    $pageno2 = $_GET['pageno'];
} else {
    $pageno2 = 1;
}
$no_of_records_per_page2 = 6; // Số bài viết hiển thị
$offset2 = ($pageno2 - 1) * $no_of_records_per_page2;

// Lấy dữ liệu bài viết từ cơ sở dữ liệu
$query2 = mysqli_query($con, "SELECT tblfeatureposts.id AS pid2,
    tblfeatureposts.PostTitle AS posttitle2,
    tblfeatureposts.PostImage,
    tblcategory.CategoryName AS category2,
    tblcategory.id AS cid2,
    tblsubcategory.Subcategory AS subcategory2,
    tblfeatureposts.PostDetails AS postdetails2,
    tblfeatureposts.PostingDate AS postingdate2,
    tblfeatureposts.PostUrl AS url2 
    FROM tblfeatureposts 
    LEFT JOIN tblcategory ON tblcategory.id = tblfeatureposts.CategoryId 
    LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblfeatureposts.SubCategoryId 
    WHERE tblfeatureposts.Is_Active = 1 
    ORDER BY tblfeatureposts.id DESC  
    LIMIT $offset2, $no_of_records_per_page2");

// Kiểm tra xem truy vấn có thành công hay không
if (!$query2) {
    die("Truy vấn không thành công: " . mysqli_error($con));
}

// Khởi tạo mảng lưu trữ bài viết
$posts = [];
while ($row2 = mysqli_fetch_array($query2)) {
    $posts[] = $row2; // Thêm bài viết vào mảng
}
?>


<?php
        // Kết nối đến cơ sở dữ liệu (giả sử đã được thiết lập)
        // $con là kết nối đến cơ sở dữ liệu của bạn

        if (isset($_GET['pageno'])) {
            $pageno3 = $_GET['pageno'];
        } else {
            $pageno3 = 1;
        }
        $no_of_records_per_page3 = 5; // Số bài viết hiển thị
        $offset3 = ($pageno3 - 1) * $no_of_records_per_page3;

        // Lấy dữ liệu bài viết từ cơ sở dữ liệu
        $query3 = mysqli_query($con, "SELECT tblpopularposts.id AS pid3,
            tblpopularposts.PostTitle AS posttitle3,
            tblpopularposts.PostImage,
            tblcategory.CategoryName AS category3,
            tblcategory.id AS cid3,
            tblsubcategory.Subcategory AS subcategory3,
            tblpopularposts.PostDetails AS postdetails3,
            tblpopularposts.PostingDate AS postingdate3,
            tblpopularposts.PostUrl AS url3 
            FROM tblpopularposts 
            LEFT JOIN tblcategory ON tblcategory.id = tblpopularposts.CategoryId 
            LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblpopularposts.SubCategoryId 
            WHERE tblpopularposts.Is_Active = 1 
            ORDER BY tblpopularposts.id DESC  
            LIMIT $offset3, $no_of_records_per_page3");

        // Kiểm tra xem truy vấn có thành công hay không
        if (!$query3) {
            die("Truy vấn không thành công: " . mysqli_error($con));
        }

        // Khởi tạo mảng lưu trữ bài viết
        $posts1 = [];
        while ($row3 = mysqli_fetch_array($query3)) {
            $posts1[] = $row3; // Thêm bài viết vào mảng
        }
        ?>


<div class="px-5 py-5">
    <div class="row">
        <!-- Phần bên trái: Feature Posts -->
        <div class="col-md-9">
            <h5 class="mb-3" style="font-weight: 600;">Feature Posts</h5>
            <div class="row">
                <?php
                // Hiển thị các bài viết
                foreach ($posts as $index => $post) {
                    if ($index % 3 == 0 && $index != 0) 
                    echo '</div><div class="row">'; // Tạo hàng mới mỗi 3 bài viết
                    echo '<a href="news-featuredetails.php?nid=' . htmlentities($post['pid2']) . '" class="d-block text-decoration-none">';
                    echo '<div class="col-md-3 mb-3" style="border: 1px solid #ccc; margin: 10px; padding: 0; max-width: 100%; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">'; // Tạo border box với margin
                    echo '<div class="overflow-hidden" style="height: 250px; width: 100%; border-radius: 5%;">'; // Chỉnh width 100% để linh hoạt theo màn hình
                    echo '<img src="admin/featurepostimages/' . htmlentities($post['PostImage']) . '" class="w-100 h-100" style="object-fit: cover;" alt="' . htmlentities($post['posttitle2']) . '">'; // Ảnh chiếm toàn bộ div
                    echo '</div>';
                    echo '<div style="padding: 10px; color: black;">'; // Thêm padding để nội dung bên dưới không sát viền
                    echo '<h5>' . htmlentities($post['posttitle2']) . '</h5>';

                    // Loại bỏ thẻ HTML và cắt ngắn nội dung
                    $plainText = strip_tags($post['postdetails2']); // Loại bỏ thẻ HTML
                    $shortText = htmlentities(substr($plainText, 0, 100)); // Cắt ngắn nội dung và mã hóa
                    echo '<p>' . $shortText . '...</p>'; // Hiển thị nội dung cắt ngắn
                    
                    echo '<small class="text-muted mt-auto">' . htmlentities($post['postingdate2']) . '</small>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <!-- Phần bên phải có thể thêm nội dung khác ở đây -->
        <div class="col-md-3">
            <div class="mb-3">
                <h5 class="mb-3" style="font-weight: 600;">Recommended</h5>
                <div class="d-flex flex-wrap">
                    <?php
                    // Lấy danh sách category từ cơ sở dữ liệu
                    $categories = ["Bitcoin", "Charts", "Ethereum", "Crypto Market", "Trading Terminology", "Trading News", "GameFi", "Analysis"]; // Đây chỉ là ví dụ
                    foreach ($categories as $category) {
                        echo '<div style="text-align: center;">';
                        echo '<a class="text-decoration-none" href="category.php?catid=' . htmlentities($category) . '">';
                        echo '<p class="rounded-pill py-2 bg-secondary text-white me-2">' . htmlentities($category) . '</p>'; // Display category name
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

            <div class="mb-5">
                <h5 class="mb-3" style="font-weight: 600;">Most Popular Posts</h5>
                <?php
                foreach (array_slice($posts1, 0, 5) as $post1) { 
                    echo '<a href="news-populardetails.php?nid=' . htmlentities($post1['pid3']) . '" class="d-flex mb-3 text-decoration-none" style="width: 100%;">';
                    echo '<div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; flex-shrink: 0;">'; // Khung ảnh tròn kích thước cố định
                    echo '<img src="admin/popularpostimages/' . htmlentities($post1['PostImage']) . '" alt="' . htmlentities($post1['posttitle3']) . '" style="width: 100%; height: 100%; object-fit: cover;">'; // Đảm bảo ảnh vừa khung
                    echo '</div>';
                    echo '<div style="margin-left: 20px;">';
                    echo '<h6 style="margin: 0; color: black;">' . htmlentities($post1['posttitle3']) . '</h6>';
                    echo '<small class="text-muted mt-auto">' . htmlentities($post1['postingdate3']) . '</small>';
                    echo '</div>';
                    echo '</a>';
                }
                ?>
            </div>

            <div class="square p-3" style="border: 2px solid #ccc; margin: 10px; padding: 0; max-width: 100%; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                <h5 class="mb-3" style="font-weight: 600;">Stay Connected</h5>
                <div class="mb-2 d-flex justify-content-between hover-link">
                    <a href="#">
                        <div class="text-dark" style="display: flex; align-items: center;">
                            <i class="fab fa-facebook" style="font-size: 18px; margin-right: 10px;" aria-hidden="true"></i>
                            <span style="font-size: 18px;">Facebook</span>
                        </div>
                    </a>    
                    <div style="font-size: 18px;">5K Likes</div>
                </div>
                <div class="mb-2 d-flex justify-content-between hover-link">
                    <a href="#">
                        <div class="text-dark" style="display: flex; align-items: center;">
                            <i class="fab fa-twitter" style="font-size: 18px; margin-right: 10px; color: black;" aria-hidden="true"></i>
                            <span style="font-size: 18px;">Twitter</span>
                        </div>
                    </a>    
                    <div style="font-size: 18px;">2K Followers</div>
                </div>
                <div class="mb-2 d-flex justify-content-between hover-link">
                    <a href="#">
                        <div class="text-dark" style="display: flex; align-items: center;">
                            <i class="fab fa-telegram" style="font-size: 18px; margin-right: 10px; color: black;" aria-hidden="true"></i>
                            <span style="font-size: 18px;">Telegram</span>
                        </div>
                    </a>    
                    <div style="font-size: 18px;">1K Subscribers</div>
                </div>
            </div>

            <style>
            .hover-link {
                transition: color 0.3s ease;
                text-decoration: none;
            }

            .hover-link:hover {
                color: #d63384; /* Màu hồng đậm theo Bootstrap */
                text-decoration: none;
            }
            a {
                text-decoration: none; /* Loại bỏ underline cho tất cả các thẻ a */
            }

            a:hover {
                text-decoration: none; /* Đảm bảo không có underline khi hover */
            }
            </style>
            

        </div>
    </div>
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
    <h5 class="mb-3" style="font-weight: 600;">Recent Posts</h5>

    <!-- Bố cục chứa các bài viết -->
    <div class="row" style="gap: 20px;">
        <?php
        // Hiển thị các bài viết
        foreach (array_slice($posts2, 0, 5) as $index => $post2) {
            echo '<div class="custom-col mb-4 d-flex">'; // Sử dụng flex-column để có chiều cao đồng đều
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

    <div class="mb-5">
    <div class="row">
        <div class="col-md-4">
            <?php
            // Lấy 6 bài viết đầu tiên
            foreach (array_slice($posts2, 5, 3) as $index => $post2) {
                echo '<a href="news-recentdetails.php?nid=' . htmlentities($post2['pid4']) . '" class="d-flex mb-3 text-decoration-none" style="width: 100%;">';
                echo '<div style="width: 120px; height: 120px; overflow: hidden; flex-shrink: 0; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">'; // Khung ảnh vuông
                echo '<img src="admin/recentpostimages/' . htmlentities($post2['PostImage']) . '" alt="' . htmlentities($post2['posttitle4']) . '" style="width: 100%; height: 100%; object-fit: cover;">'; // Đảm bảo ảnh vừa khung
                echo '</div>';
                echo '<div style="margin-left: 20px;">';
                echo '<h6 style="margin: 0; color: black;">' . htmlentities($post2['posttitle4']) . '</h6>';
                echo '<small class="text-muted mt-auto">' . htmlentities($post2['postingdate4']) . '</small>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>

        <div class="col-md-4">
            <?php
            // Lấy 6 bài viết tiếp theo
            foreach (array_slice($posts2, 8, 3) as $index => $post2) {
                echo '<a href="news-recentdetails.php?nid=' . htmlentities($post2['pid4']) . '" class="d-flex mb-3 text-decoration-none" style="width: 100%;">';
                echo '<div style="width: 120px; height: 120px; overflow: hidden; flex-shrink: 0; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">'; // Khung ảnh vuông
                echo '<img src="admin/recentpostimages/' . htmlentities($post2['PostImage']) . '" alt="' . htmlentities($post2['posttitle4']) . '" style="width: 100%; height: 100%; object-fit: cover;">'; // Đảm bảo ảnh vừa khung
                echo '</div>';
                echo '<div style="margin-left: 20px;">';
                echo '<h6 style="margin: 0; color: black;">' . htmlentities($post2['posttitle4']) . '</h6>';
                echo '<small class="text-muted mt-auto">' . htmlentities($post2['postingdate4']) . '</small>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>

        <div class="col-md-4">
            <?php
            // Lấy 6 bài viết tiếp theo
            foreach (array_slice($posts2, 11, 3) as $index => $post2) {
                echo '<a href="news-recentdetails.php?nid=' . htmlentities($post2['pid4']) . '" class="d-flex mb-3 text-decoration-none" style="width: 100%;">';
                echo '<div style="width: 120px; height: 120px; overflow: hidden; flex-shrink: 0; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">'; // Khung ảnh vuông
                echo '<img src="admin/recentpostimages/' . htmlentities($post2['PostImage']) . '" alt="' . htmlentities($post2['posttitle4']) . '" style="width: 100%; height: 100%; object-fit: cover;">'; // Đảm bảo ảnh vừa khung
                echo '</div>';
                echo '<div style="margin-left: 20px;">';
                echo '<h6 style="margin: 0; color: black;">' . htmlentities($post2['posttitle4']) . '</h6>';
                echo '<small class="text-muted mt-auto">' . htmlentities($post2['postingdate4']) . '</small>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>
    </div>
</div>


<!-- Thêm CSS tùy chỉnh -->
<style>
    /* Tạo một cột tùy chỉnh cho 5 bài viết trên mỗi hàng trên màn hình lớn */
    .custom-col {
        width: calc(20% - 20px); /* Chia đều cho 5 bài, trừ đi khoảng cách giữa các bài */
    }
    
    @media (max-width: 992px) {
        /* Màn hình nhỏ hơn, hiển thị 1 bài viết trên mỗi hàng */
        .custom-col {
            width: 100%;
        }
    }
</style>

<?php
// Kết nối đến cơ sở dữ liệu và thiết lập phân trang
if (isset($_GET['pageno'])) {
    $pageno5 = $_GET['pageno'];
} else {
    $pageno5 = 1;
}
$no_of_records_per_page5 = 6; // Số bài viết hiển thị
$offset5 = ($pageno5 - 1) * $no_of_records_per_page5;

// Lấy dữ liệu bài viết từ cơ sở dữ liệu
$query5 = mysqli_query($con, "SELECT tblfeaturevideo.id AS pid5,
    tblfeaturevideo.PostTitle AS posttitle5,
    tblfeaturevideo.PostVideo,
    tblcategory.CategoryName AS category5,
    tblcategory.id AS cid5,
    tblsubcategory.Subcategory AS subcategory5,
    tblfeaturevideo.PostingDate AS postingdate5,
    tblfeaturevideo.PostUrl AS url5 
    FROM tblfeaturevideo 
    LEFT JOIN tblcategory ON tblcategory.id = tblfeaturevideo.CategoryId 
    LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblfeaturevideo.SubCategoryId 
    WHERE tblfeaturevideo.Is_Active = 1 
    ORDER BY tblfeaturevideo.id DESC  
    LIMIT $offset5, $no_of_records_per_page5");

// Kiểm tra xem truy vấn có thành công hay không
if (!$query5) {
    die("Truy vấn không thành công: " . mysqli_error($con));
}

// Khởi tạo mảng lưu trữ bài viết
$posts3 = [];
while ($row5 = mysqli_fetch_array($query5)) {
    $posts3[] = $row5; // Thêm bài viết vào mảng
}
?>

<div class="py-5">
    <!-- Tiêu đề Feature Video -->
    <h5 class="mb-3" style="font-weight: 600;">Featured Video</h5>

    <?php if (!empty($posts3)) { 
        $featuredVideo = $posts3[0]; // Lấy video nổi bật đầu tiên
    ?>
    <div class="card featured-video" onclick="playVideo('featured-video')">
    <!-- <div class="text-center overlay-content">
        <p class="mb-2 fw-bold">
            <span class="text-light border border-dark rounded-pill py-2 bg-dark">
                <?php echo htmlentities($featuredVideo['category5']); ?>
            </span>
        </p>
        <h2 style="font-weight: bold; max-width: 450px; color: white;" class="card-title mb-2 display-5">
            <?php echo htmlentities($featuredVideo['posttitle5']); ?>
        </h2>
        <div class="text-light small"><?php echo htmlentities($featuredVideo['postingdate5']); ?></div>
    </div> -->

        <div class="video-wrapper">
            <?php
            if (strpos($featuredVideo['PostVideo'], 'youtube.com') !== false || strpos($featuredVideo['PostVideo'], 'vimeo.com') !== false) {
                $videoEmbedUrl = $featuredVideo['PostVideo'];
                if (strpos($videoEmbedUrl, 'watch?v=') !== false) {
                    $videoEmbedUrl = str_replace('watch?v=', 'embed/', $videoEmbedUrl);
                }
                echo '<iframe id="featured-video" style="max-height: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 100%;" class="featured-video-iframe" src="' . htmlentities($videoEmbedUrl) . '" frameborder="0" allowfullscreen></iframe>';
            } else {
                echo '<video id="featured-video" class="featured-video-frame" preload="none" controls poster="admin/featurepostimages/' . htmlentities($featuredVideo['PostVideo']) . '?t=1" onclick="event.stopPropagation()">
                        <source src="admin/featurepostvideo/' . htmlentities($featuredVideo['PostVideo']) . '" type="video/mp4">
                    </video>';
            }
            ?>
        </div>
    </div>


    <?php } ?>

    <!-- Các video tiếp theo -->
    <div class="row mt-5 justify-content-center">
    <?php foreach (array_slice($posts3, 1, 5) as $index => $post3) { ?>
        <div class="custom-col mb-4 d-flex justify-content-center" onclick="playVideo('video-<?php echo $index; ?>')">
            <div class="card">
                <?php
                // Kiểm tra nếu video là link hay embed
                if (strpos($post3['PostVideo'], 'youtube.com') !== false || strpos($post3['PostVideo'], 'vimeo.com') !== false) {
                    // Nếu là video YouTube hoặc Vimeo, sử dụng iframe
                    $videoEmbedUrl = $post3['PostVideo'];
                    if (strpos($videoEmbedUrl, 'watch?v=') !== false) {
                        $videoEmbedUrl = str_replace('watch?v=', 'embed/', $videoEmbedUrl);
                    }
                    echo '<iframe id="video-' . $index . '" style="max-height: 100%; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); width: 100%;" class="small-video-frame" src="' . htmlentities($videoEmbedUrl) . '" frameborder="0" allowfullscreen></iframe>';
                } else {
                    // Nếu là video tải lên
                    echo '<video id="video-' . $index . '" class="small-video-frame" preload="none" controls poster="admin/featurepostimages/' . htmlentities($post3['PostVideo']) . '?t=1" onclick="event.stopPropagation()" style="width: 100%; max-width: 100%; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            <source src="admin/featurepostvideo/' . htmlentities($post3['PostVideo']) . '" type="video/mp4">
                          </video>';
                }
                ?>
            </div>
        </div>
    <?php } ?>
</div>


<!-- CSS -->
<style>
    /* Đặt khung video với chiều cao cố định */
    .video-wrapper {
    width: 100%;
    max-height: 650px;
    position: relative;
    padding-top: 56.25%; /* Tỷ lệ 16:9 */
    overflow: hidden;
}

.featured-video-iframe, .featured-video-frame {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Cài đặt kích thước cố định cho các video nhỏ */
.small-video-frame {
    width: 300px;
    height: 200px;
    object-fit: cover;
}

.overlay-content {
    color: white;
    text-align: center;
}
.featured-video, .card {
    position: relative;
    cursor: pointer;
}

</style>

<!-- JavaScript -->
<script>
    function playVideo(videoId) {
        var video = document.getElementById(videoId);
        // Kiểm tra nếu video là iframe
        if (video.tagName.toLowerCase() === 'iframe') {
            // Chỉ cần hiển thị iframe, không cần phải chơi/nhấn
            return; 
        } else {
            // Kiểm tra xem video có đang phát không
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        }
    }
</script>

</div>
</div>
<?php include('includes/footer.php');?>




</body>
</html>