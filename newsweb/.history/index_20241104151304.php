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

    <style>
    .rounded-pill {
        border-radius: 50rem;
        padding: 10px 20px;
        margin: 5px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
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
    <div class="d-flex justify-content-between">
        <!-- Hình ảnh và tên Category 1 -->
        <div class="text-center">
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
        <div class="text-center">
            <a class="text-decoration-none" href="category.php?catid=<?php echo htmlentities(string: "GameFi"); ?>">
                <div class="overflow-hidden" style="height: 100%; max-height: 764px;">
                    <img class="card-img-top w-100 h-auto" src="admin/mainpostimages/Category2.jpg" alt="GameFi">
                </div>
                <div style="font-weight: 500; color: black; font-size: 20px">
                        <?php echo htmlentities("GameFi"); ?>   
                </div>
            </a>
        </div>

        <!-- Hình ảnh và tên Category 3 -->
        <div class="text-center">
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
        <div class="text-center">
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
        <div class="text-center">
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
                        echo '<p class="badge rounded-pill bg-secondary text-white me-2">' . htmlentities($category) . '</p>'; // Display category name
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

<div class="">
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
            echo '<iframe id="featured-video" class="featured-video-iframe" src="' . htmlentities($videoEmbedUrl) . '" frameborder="0" allowfullscreen></iframe>';
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
    <div class="row mt-5" >
        <?php foreach (array_slice($posts3, 1, 5) as $index => $post3) { ?>
            <div class="custom-col mb-4 d-flex" onclick="playVideo('video-<?php echo $index; ?>')">
                <div class="card">
                    <!-- <div class="overlay-content">
                        <h5 class="text-light" style="font-weight: bold;"><?php echo htmlentities($post3['posttitle5']); ?></h5>
                        <small class="text-light"><?php echo htmlentities($post3['postingdate5']); ?></small>
                    </div> -->
                    
                    <?php
                    // Kiểm tra nếu video là link hay embed
                    if (strpos($post3['PostVideo'], 'youtube.com') !== false || strpos($post3['PostVideo'], 'vimeo.com') !== false) {
                        // Nếu là video YouTube hoặc Vimeo, sử dụng iframe
                        $videoEmbedUrl = $post3['PostVideo'];
                        if (strpos($videoEmbedUrl, 'watch?v=') !== false) {
                            $videoEmbedUrl = str_replace('watch?v=', 'embed/', $videoEmbedUrl);
                        }
                        echo '<iframe id="video-' . $index . '" style="max-height: 100%; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); width: 450px;" class="small-video-frame" src="' . htmlentities($videoEmbedUrl) . '" frameborder="0" allowfullscreen></iframe>';
                    } else {
                        // Nếu là video tải lên
                        echo '<video id="video-' . $index . '" class="small-video-frame" preload="none" controls poster="admin/featurepostimages/' . htmlentities($post3['PostVideo']) . '?t=1" onclick="event.stopPropagation()">
                                <source src="admin/featurepostvideo/' . htmlentities($post3['PostVideo']) . '" type="video/mp4">
                              </video>';
                    }



                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
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






</body>
</html>


    <main class="w-full">
        <section class="text-center py-20">
            <h2 class="text-white text-xs uppercase tracking-wide mb-1">Next-gen staking</h2>
            <h1 class="text-white text-6xl font-bold mb-6">The Gateway to Staking 4.0</h1>
            <p class="text-white text-xl mb-8">Easy Staking for Everyone</p>
            <a href="Stake/Stake.html">
                <button class="bg-white text-cyan-500 font-semibold py-3 px-8 rounded-lg shadow-md">STAKE NOW</button>
            </a>
        </section>
        <img src="img/iphone.png" alt="" class="w-64 mx-auto">

        <!-- <section class="flex justify-center space-x-12 my-12">
            <div class="text-white text-center">
                <p class="text-3xl font-bold">$34,330,419,929</p>
                <p>Total staked tokens</p>
            </div>
            <div class="text-white text-center">
                <p class="text-3xl font-bold">$1,734,015,165</p>
                <p>Total rewards paid</p>
            </div>
            <div class="text-white text-center">
                <p class="text-3xl font-bold">379,457</p>
                <p>Stakers</p>
            </div>
            <div class="md:col-span-2 md:row-start-2 flex justify-center items-center">
                <a href="https://apps.apple.com/us/app/facebook/id284882215" tabIndex="0" target="_blank">
                    <button> -->
        <!-- [[[ <a href="#" class="text-white bg-black px-4 py-2 rounded-full mr-2">
                        <i class="fab fa-apple"></i> App Store
                        <span class="font-semibold">Download</span> ]]] -->

        <!-- <img class="bn46 px-4 py-2 mr-2" src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"alt="bn45"/> -->

        <!-- [[[ <button type="button" class="flex items-center justify-center w-48 mt-3 text-black bg-black border border-white h-14 rounded-xl">
                            <div class="mr-3 text-white">
                                <svg viewBox="0 0 384 512" width="30">
                                    <path fill="currentColor" d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z">
                                    </path>
                                </svg>
                            </div>
                            <div class="text-white">
                                <div class="text-xs">
                                    Download on the
                                </div>
                                <div class="-mt-1 font-sans text-2xl font-semibold">
                                    App Store
                                </div>
                            </div>
                        </button> -->
        <!-- </a> ]]] -->
        <!-- </button>
                </a>
            </div> -->
        <!-- <nav>
            <div class="flex justify-between items-center">
                <div class="flex my-12">
                    <div class="text-white text-center">
                        <p class="text-2xl font-bold">$34,330,419,929</p>
                        <p class="text-2xs">Total staked tokens</p>
                    </div>
                    <div class="text-white text-center">
                        <p class="text-2xl font-bold">$1,734,015,165</p>
                        <p class="text-2xs">Total rewards paid</p>
                    </div>
                    <div class="text-white text-center">
                        <p class="text-2xl font-bold">379,457</p>
                        <p class="text-2xs">Stakers</p>
                    </div>
                </div>
                <div class="flex text-right">
                    <button class="text-white font-bold py-2 rounded">
                        <a href="https://play.google.com/store/apps/details?id=com.facebook.katana"
                            class="text-white font-bold py-2 px-4 rounded" target="_blank">
                            <img class="w-48 px-4 py-2 mr-2"
                                src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png"
                                alt="Download on Google Play Store" />
                        </a>
                    </button>
                    <button class="text-white font-bold py-2 rounded">
                        <a href="https://apps.apple.com/us/app/facebook/id284882215" tabIndex="0" target="_blank">
                            <img class="bn64 px-4 py-2 mr-2"
                                src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                                alt="bn45" />
                        </a>
                    </button>
                </div>
            </div>
        </nav> -->

        <nav class="pt-12 px-5 md:px-20">
            <div class="flex justify-between items-center">
                <div class="text-white">
                    <div class="flex space-x-12 my-12 text-center">
                        <div>
                            <p class="text-2xl font-bold">$34,330,419,929</p>
                            <p class="text-2xs">Total staked tokens</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">$1,734,015,165</p>
                            <p class="text-2xs">Total rewards paid</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">379,457</p>
                            <p class="text-2xs">Stakers</p>
                        </div>
                    </div>
                </div>
                <div class="flex text-right">
                    <button class="text-white font-bold py-2 rounded">
                        <a href="https://play.google.com/store/apps/details?id=com.facebook.katana"
                            class="text-white font-bold py-2 px-4 rounded" target="_blank">
                            <img class="w-48 px-4 py-2 mr-2"
                                src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png"
                                alt="Download on Google Play Store" />
                        </a>
                    </button>
                    <button class="text-white font-bold py-2 rounded">
                        <a href="https://apps.apple.com/us/app/facebook/id284882215" tabIndex="0" target="_blank">
                            <img class="bn64 px-4 py-2 mr-2"
                                src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                                alt="bn45" />
                        </a>
                    </button>
                </div>
            </div>
        </nav>
        

        <!-- <nav class="flex justify-between items-center px-5 md:px-20">
            <div class="flex justify-between items-center space-x-12 my-12">
                <div class="text-white text-center">
                    <p class="text-2xl font-bold">$34,330,419,929</p>
                    <p class="text-2xs">Total staked tokens</p>
                </div>
                <div class="text-white text-center">
                    <p class="text-2xl font-bold">$1,734,015,165</p>
                    <p class="text-2xs">Total rewards paid</p>
                </div>
                <div class="text-white text-center">
                    <p class="text-2xl font-bold">379,457</p>
                    <p class="text-2xs">Stakers</p>
                </div>
            </div>
            <div class="flex text-right">
                <button class="text-white font-bold py-2 rounded">
                    <a href="https://play.google.com/store/apps/details?id=com.facebook.katana"
                        class="text-white font-bold py-2 px-4 rounded" target="_blank">
                        <img class="w-48 px-4 py-2 mr-2"
                            src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png"
                            alt="Download on Google Play Store" />
                    </a>
                </button>
                <button class="text-white font-bold py-2 rounded">
                    <a href="https://apps.apple.com/us/app/facebook/id284882215" tabIndex="0" target="_blank">
                        <img class="bn64 px-4 py-2 mr-2"
                            src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                            alt="bn45" />
                    </a>
                </button>
            </div>
        </nav> -->

        <br><br><br><br><br><br><br>
        <!-- <section class="flex justify-center">
                <div class="bg-black rounded-xl p-4">
                    <img src="https://placehold.co/200x400" alt="Phone with CyberEx App" class="w-64 h-auto rounded-lg">
                </div>
            </section> -->
        <!-- <section class="container mx-auto px-6 py-8">
            <div>
                <h2 class="text-3xl font-bold text-white text-center mb-16">How CyberEx Works</h2>
                <p class="text-white text-xl mb-8 text-center">CyberEx is a decentralized exchange built on the
                    Arbitrum blockchain that<br>enables users to trade cryptocurrencies without the need for
                    intermediaries.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center mb-8">
                        <div class="mb-6 p-4 rounded-full w-32">
                            <img src="img/Stake.png" alt="Placeholder for staking image"
                                class="rounded-full border-2 border-dashed border-teal-300 p-2">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold mb-2">Stake</h3>
                            <p class="text-gray-400">Stake any amount, earn rewards daily</p>
                            <div class="text-9xl font-bold text-gray-300 absolute -mt-20 -ml-14 opacity-40">1</div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center mt-4">
                        <img src="img/Cyberwork.png" alt="" class="w-96 h-auto">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-with-gradient p-6 rounded-lg shadow-lg flex flex-col items-center">
                        <div class="mb-6 p-4 rounded-full w-32">
                            <img src="img/Gettoken.png" alt="Placeholder for token image"
                                class="rounded-full border-2 border-dashed border-teal-300 p-2">
                        </div>
                        <div class="text-center text-white">
                            <h3 class="text-xl font-bold mb-2">Get token</h3>
                            <p>Get liquid cyTokens and earn rewards instantly</p>
                            <div class="text-9xl font-bold text-gray-300 absolute -mt-20 -ml-14 opacity-40">2</div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center relative">
                        <div class="mb-6 p-4 rounded-full w-32">
                            <img src="img/UseinDefi.png" alt="Placeholder for DeFi image"
                                class="rounded-full border-2 border-dashed border-teal-300 p-2">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold mb-2">Use in DeFi</h3>
                            <p class="text-gray-400">Boost your daily rewards with cyTokens in DeFi</p>
                            <div class="text-9xl font-bold text-gray-300 absolute -mt-20 -ml-14 opacity-40">3</div>
                        </div>
                    </div>
                </div>
        </section> -->

        <section class="container mx-auto px-6 py-8">
            <div>
                <h2 class="text-3xl font-bold text-white text-center mb-16">How CyberEx Works</h2>
                <p class="text-white text-xl mb-8 text-center">
                    CyberEx is a decentralized exchange built on the Arbitrum blockchain that<br>
                    enables users to trade cryptocurrencies without the need for intermediaries.
                </p>
                <img src="img/Cyberwork.png" alt="" class="max-w-2xl mx-auto rotate-animation">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-2xl flex flex-col items-center">
                        <div class="mb-6 p-4 rounded-full w-32">
                            <img src="img/Stake.png" alt="Placeholder for staking image"
                                class="rounded-full border-2 border-dashed border-teal-300 p-2">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold mb-2">Stake</h3>
                            <p class="text-gray-400">Stake any amount, earn rewards daily</p>
                            <div class="text-9xl font-bold text-gray-300 absolute -mt-20 -ml-14 opacity-40">1</div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-with-gradient p-6 rounded-2xl shadow-lg flex flex-col items-center z-10">
                        <div class="mb-6 p-4 rounded-full w-32">
                            <img src="img/Gettoken.png" alt="Placeholder for token image"
                                class="rounded-full border-2 border-dashed border-teal-300 p-2">
                        </div>
                        <div class="text-center text-white">
                            <h3 class="text-xl font-bold mb-2">Get token</h3>
                            <p>Get liquid cyTokens and earn rewards instantly</p>
                            <div class="text-9xl font-bold text-gray-300 absolute -mt-20 -ml-14 opacity-40">2</div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col items-center relative">
                        <div class="mb-6 p-4 rounded-full w-32">
                            <img src="img/UseinDefi.png" alt="Placeholder for DeFi image"
                                class="rounded-full border-2 border-dashed border-teal-300 p-2">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold mb-2">Use in DeFi</h3>
                            <p class="text-gray-400">Boost your daily rewards with cyTokens in DeFi</p>
                            <div class="text-9xl font-bold text-gray-300 absolute -mt-20 -ml-14 opacity-40">3</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <br><br><br><br><br><br><br>

        <section class="text-white py-12 px-4 md:px-20">
            <div class="mb-8 text-center">
                <h3 class="text-lg font-semibold mb-1">NETWORKS</h3>
                <h2 class="text-4xl font-bold mb-4">Networks Available</h2>
                <p class="mb-6">Start staking on various networks with Cyberex. Select your network below.</p>
                <a href="Stake/Stake.html">
                    <button class="bg-white text-teal-500 font-bold py-2 px-8 rounded-full">Stake now</button>
                </a>
            </div>

            <div class="flex justify-center items-center space-x-4 overflow-x-auto">
                <!-- Placeholder for the mobile phone UI -->
                <div class="w-64 rounded-lg p-4 mx-2">
                    <img src="img/iphone1.png" alt="Mobile phone UI placeholder for Ethereum staking"
                        class="rounded-lg">
                </div>
                <div class="w-64 rounded-lg p-4 mx-2">
                    <img src="img/iphone2.png" alt="Mobile phone UI placeholder for Ethereum staking"
                        class="rounded-lg">
                </div>
            </div>
            <!-- Scroll indicator -->
            <div class="flex justify-center mt-16">
                <div class="animate-bounce">
                    <i class="fas fa-chevron-down text-white text-3xl"></i>
                </div>
            </div>
        </section>
    </main>
    <main>
        <section class="bg-white py-1 w-full">
            <!-- Placeholder for logos -->
            <div class="flex justify-center items-center space-x-40 overflow-x-auto mt-12">
                <img src="img/Bitcoin Text.png" alt="Logo placeholder for Bitcoin" class="mx-2" width="160" height="60">
                <img src="img/Solana Text.png" alt="Logo placeholder for Solana" class="mx-2" width="160" height="60">
                <img src="img/Ethereum Text.png" alt="Logo placeholder for Ethereum" class="mx-2" width="160"
                    height="60">
                <img src="img/Polygon Text.png" alt="Logo placeholder for Polygon" class="mx-2" width="160" height="60">
                <img src="img/Cosmos Text.png" alt="Logo placeholder for Cosmos" class="mx-2" width="160" height="60">
                <img src="img/Polkadot Text.png" alt="Logo placeholder for Polkadot" class="mx-2" width="160"
                    height="60">
            </div>
            <br><br><br><br><br><br><br>
            <div class="container mx-auto px-4">
                <h2 class="text-5xl font-bold text-center mb-12">CyberEX DAO</h2>
                <p class="text-lg text-center mb-12">A Decentralized Autonomous Organization (DAO) that governs the
                    CyberEX ecosystem.<br>CYDAO token holders have voting rights on crucial protocol upgrades and
                    parameters.</p>

                <div class="grid md:grid-cols-2 gap-8 text-gray-700">
                    <!-- Item 1 -->
                    <div class="flex flex-col items-center">
                        <img src="img/Dao1.jpg"
                            alt="Community Hub - Serves as a central platform for CyberEX users to connect, share ideas, and contribute to the protocol's development."
                            class="mb-4">
                        <h3 class="text-xl font-bold mb-2">Community Hub</h3>
                        <p class="text-center">Serves as a central platform for CyberEX users to connect, share
                            ideas, and contribute to the protocol's development.</p>
                    </div>
                    <!-- Item 2 -->
                    <div class="flex flex-col items-center">
                        <img src="img/Dao2.jpg"
                            alt="Decision Making - Outlines how changes are proposed, discussed, and implemented within the CyberEX protocol."
                            class="mb-4">
                        <h3 class="text-xl font-bold mb-2">Decision Making</h3>
                        <p class="text-center">Outlines how changes are proposed, discussed, and implemented within
                            the CyberEX protocol.</p>
                    </div>
                    <!-- Item 3 -->
                    <div class="flex flex-col items-center">
                        <img src="img/Dao3.jpg"
                            alt="CyberEx Grants - The CyberX Ecosystem Grants Program that supports projects that contribute to the growth of the CyberEX ecosystem."
                            class="mb-4">
                        <h3 class="text-xl font-bold mb-2">CyberEx Grants</h3>
                        <p class="text-center">The CyberX Ecosystem Grants Program that supports projects that
                            contribute to the growth of the CyberEX ecosystem.</p>
                    </div>
                    <!-- Item 4 -->
                    <div class="flex flex-col items-center">
                        <img src="img/Dao4.jpg"
                            alt="Governance History - Find all key governance decisions and their associated Snapshot/Aragon votes in one place."
                            class="mb-4">
                        <h3 class="text-xl font-bold mb-2">Governance History</h3>
                        <p class="text-center">Find all key governance decisions and their associated
                            Snapshot/Aragon votes in one place.</p>
                    </div>
                </div>
            </div>
        </section>
        <br><br><br><br><br><br><br>
        <section class="py-20 bg-gray-100">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-5xl font-bold mb-8">CyberEx Ecosystem</h2>
                <p class="text-lg mb-12">Explore apps and services within Lido ecosystem to get more benefits with
                    your staked tokens.</p>

                <div class="relative mb-12">
                    <!-- Placeholder for the mobile phone images and QR codes -->
                    <div class="inline-block rounded-full overflow-hidden bg-teal-200">
                        <img src="img/Ecosystem.png" alt="CyberEx Ecosystem phone UI placeholder" id="ecosystem-img"
                            class="rounded-xl card-shadow mx-auto max-w-2xl mb-4">
                    </div>
                </div>

                <div class="grid md:grid-cols-4 gap-4 text-gray-700">
                    <!-- App 1 -->
                    <div class="bg-white rounded-3xl p-6" onmouseover="changeImage('img/Eco 1inch.png')"
                        onmouseout="resetImage()">
                        <img src="img/1inch.png" width="50" alt="1inch logo" class="mx-auto mb-4">
                        <h3 class="text-xl font-bold mb-2">1inch</h3>
                        <p>Exchange and get daily staking rewards and provide liquidity with cyETH.</p>
                    </div>
                    <!-- App 2 -->
                    <div class="bg-white rounded-3xl p-6" onmouseover="changeImage('img/Eco Metamask.png')"
                        onmouseout="resetImage()">
                        <img src="img/Metamask.png" width="50" alt="Metamask logo" class="mx-auto mb-4">
                        <h3 class="text-xl font-bold mb-2">Metamask</h3>
                        <p>A crypto wallet & gateway to blockchain apps.</p>
                    </div>
                    <!-- App 3 -->
                    <div class="bg-white rounded-3xl p-6" onmouseover="changeImage('img/Eco Curve.png')"
                        onmouseout="resetImage()">
                        <img src="img/Curve.png" width="50" alt="Curve logo" class="mx-auto mb-4">
                        <h3 class="text-xl font-bold mb-2">Curve</h3>
                        <p>Use cyETH as liquidity to the respective pool to get more rewards.</p>
                    </div>
                    <!-- App 4 -->
                    <div class="bg-white rounded-3xl p-6" onmouseover="changeImage('img/Eco Uniswap.png')"
                        onmouseout="resetImage()">
                        <img src="img/Uniswap.png" width="50" alt="Uniswap logo" class="mx-auto mb-4">
                        <h3 class="text-xl font-bold mb-2">Uniswap</h3>
                        <p>Create a new liquidity pool, provide liquidity and swap tokens.</p>
                    </div>
                </div>
                <!-- View all link -->
                <div class="mt-8">
                    <p>99 Ecosystem Applications <span class="underline text-lg text-teal-500">View
                            all</span></p>
                </div>
            </div>
        </section>
        <br><br><br><br><br><br><br>
        <section>
            <div
                class="container mx-auto px-4 text-center rounded-3xl overflow-hidden bg-gradient-to-br from-teal-200 to-blue-200">
                <h2 class="text-5xl font-bold mb-6 mt-10">Join Community</h2>
                <p class="text-lg mb-8">CyberEx is trusted by a growing number of users worldwide, with thousands of
                    active users and counting.</p>
                <a href="#"
                    class="mt-4 inline-block bg-teal-500 text-white font-bold py-2 px-4 rounded-full hover:bg-teal-600 mb-10">Learn
                    more</a>
                <div class="flex flex-wrap justify-center gap-4 mb-10">
                    <!-- User testimonials or community pictures placeholders -->
                    <img src="img/Comm1.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Commun1.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Comm2.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Commun2.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Comm3.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Commun3.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Comm4.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Commun4.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Comm5.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Commun5.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Comm6.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Commun6.jpg" width="100" alt="Community Member" class="rounded-full">
                    <img src="img/Comm7.jpg" width="100" alt="Community Member" class="rounded-full">
                    <!-- Repeat the above line for each community member image -->
                </div>
            </div>
            <div class="container mx-auto px-4 text-center mt-20">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Community platform 1 -->
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-telegram hover:text-white">
                        <div class="flex items-center justify-center mb-4">
                            <i class="fab fa-telegram-plane text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Telegram</h3>
                        <p>Join chat</p>
                    </div>
                    <!-- Community platform 2 -->
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-discord hover:text-white">
                        <div class="flex items-center justify-center mb-4">
                            <i class="fab fa-discord text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Discord</h3>
                        <p>Join the community and ask questions</p>
                    </div>
                    <!-- Community platform 3 -->
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-community3 hover:text-white">
                        <div class="flex items-center justify-center mb-4">
                            <!-- Replace with actual logo or icon -->
                            <i class="fas fa-times text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">X</h3>
                        <p>Follow @newmoon_tv</p>
                    </div>
                    <!-- Community platform 4 -->
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-mail hover:text-white">
                        <div class="flex items-center justify-center mb-4">
                            <i class="fas fa-envelope text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Contact</h3>
                        <p>Get in touch with CyberEx</p>
                    </div>
                </div>
            </div>
        </section>
        <br><br><br><br><br><br><br>
        <section class="bg-[#EFF3F8]">
            <div class="max-w-7xl mx-auto py-10">
                <h1 class="text-6xl font-bold text-center mb-4">Blog</h1>
                <p class="text-base text-gray-600 text-center mb-12">The Cyberex protocol has undergone security audits
                    by industry-leading blockchain security companies.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="bg-white rounded-lg overflow-hidden shadow-xl">
                        <div class="relative group">
                            <img src="img/Blog.jpg"
                                alt="Coins falling onto a laptop screen indicating cryptocurrency earnings, with abstract blue shapes and plants in the background"
                                class="w-full h-100 object-cover">
                            <div
                                class="absolute top-0 left-0 w-full h-full bg-gray-800 opacity-0 group-hover:opacity-50 transition-all duration-500 ease-in-out">
                            </div>
                            <div
                                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center w-full opacity-0 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                                <h3 class="font-bold text-3xl my-2 text-white">Community Staking Module #1</h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <p class="text-sm text-blue-500 font-semibold tracking-wide uppercase">Use Guide</p>
                            <h2 class="font-bold text-3xl my-2">Community Staking Module #1</h2>
                            <!-- Thay đổi kích thước tiêu đề -->
                            <p class="text-gray-500 text-base mb-4">Stake allocation & Validator exits</p>
                            <!-- Thay đổi kích thước đoạn văn bản -->
                            <div class="flex justify-between items-center mt-12">
                                <p class="text-gray-700 font-semibold text-lg">By Laura News</p>
                                <!-- Thay đổi kích thước của tác giả -->
                                <p class="text-gray-400 text-sm">27 August 2023</p>
                                <!-- Thay đổi kích thước của ngày tháng -->
                            </div>
                        </div>
                    </div>


                    <div class="space-y-4">
                        <div
                            class="bg-white rounded-lg overflow-hidden shadow-xl grid grid-cols-1 md:grid-cols-2 transition-all duration-500 ease-in-out">
                            <div class="relative group">
                                <img src="img/Comm1.jpg" alt="Image"
                                    class="w-full h-auto md:w-auto md:h-full mb-4 md:mb-0">
                                <div
                                    class="absolute top-0 left-0 w-full h-full bg-gray-800 opacity-0 group-hover:opacity-50 transition-all duration-500 ease-in-out">
                                </div>
                                <div
                                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center w-full opacity-0 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                                    <h3 id="title" class="font-bold text-3xl my-2 text-white">Community Staking Module
                                        #1</h3>
                                </div>
                            </div>
                            <div class="p-6 relative">
                                <!-- Hình ảnh làm nền -->
                                <img src="img/Blog1.jpg" alt="Background Image"
                                    class="absolute inset-0 w-full h-full object-cover opacity-50">

                                <!-- Nội dung của box -->
                                <div class="relative z-10">
                                    <p class="text-sm text-blue-500 font-semibold tracking-wide uppercase">Report</p>
                                    <h3 class="font-bold text-2xl my-2">CyberEx Monthly Report #3</h3>
                                    <div class="space-y-2 mt-4">
                                        <ul>
                                            <li class="mb-2 font-semibold">
                                                <a href="#" class="flex items-center text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-chevron-right mr-2"></i>Stake Your Crypto and Earn
                                                    Rewards
                                                </a>
                                            </li>
                                            <li class="mb-2 font-semibold">
                                                <a href="#" class="flex items-center text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-chevron-right mr-2"></i>What Does Staking Mean in
                                                    Crypto?
                                                </a>
                                            </li>
                                            <li class="mb-2 font-semibold">
                                                <a href="#" class="flex items-center text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-chevron-right mr-2"></i>What Does Bitcoin Mean in
                                                    Crypto?
                                                </a>
                                            </li>
                                            <!-- Repeat for other posts -->
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div
                            class="bg-gradient-to-r from-[#6DD7B9] to-[#B4EAC5] rounded-lg overflow-hidden shadow-xl p-6 mt-10">
                            <div class="flex flex-col md:flex-row items-center justify-between mb-6">

                                <a href="#"
                                    class="text-blue-600 hover:text-blue-700 text-sm font-semibold uppercase tracking-wide">View
                                    all categories</a>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-white rounded-lg overflow-hidden shadow-xl p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="bg-[#FFB085] text-white p-2 rounded-full shadow-lg">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <div>
                                            <p class="text-lg text-gray-700 font-semibold">Coin Market</p>
                                            <p class="text-sm text-gray-600">OKX</p>
                                        </div>
                                    </div>
                                    <!-- Additional coin info -->
                                </div>
                                <div class="bg-white rounded-lg overflow-hidden shadow-xl p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="bg-[#FF5F5F] text-white p-2 rounded-full shadow-lg">
                                            <i class="fas fa-coins"></i>
                                        </div>
                                        <div>
                                            <p class="text-lg text-gray-700 font-semibold">Coin</p>
                                            <p class="text-sm text-gray-600">Ethereum</p>
                                        </div>
                                    </div>
                                    <!-- Additional coin info -->
                                </div>
                                <div class="bg-white rounded-lg overflow-hidden shadow-xl p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="bg-[#9E7CC1] text-white p-2 rounded-full shadow-lg">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <div>
                                            <p class="text-lg text-gray-700 font-semibold">Discussions</p>
                                            <p class="text-sm text-gray-600">Skillnet</p>
                                        </div>
                                    </div>
                                    <!-- Additional discussions info -->
                                </div>
                                <div class="bg-white rounded-lg overflow-hidden shadow-xl p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="bg-[#59A2FF] text-white p-2 rounded-full shadow-lg">
                                            <i class="fas fa-handshake"></i>
                                        </div>
                                        <div>
                                            <p class="text-lg text-gray-700 font-semibold">P2P</p>
                                            <p class="text-sm text-gray-600">Binance</p>
                                        </div>
                                    </div>
                                    <!-- Additional P2P info -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
    <div id="loading-spinner" style="display: none;">Loading...</div>
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between items-center">
                <div class="w-full lg:w-1/4 mb-6 lg:mb-0">
                    <a href="#" class="text-2xl font-bold">
                        <img src="img/LogoW.png" width="50" alt="CyberEx Finance logo">
                    </a>
                    <p class="mt-4">Take control of your financial security and streamline your cryptocurrency
                        management with ease.</p>
                    <div class="flex mt-4">
                        <a href="#" class="mr-3">
                            <i class="fab fa-twitter rounded-full border-2 p-2"></i>
                        </a>
                        <a href="#" class="mr-3">
                            <i class="fab fa-telegram-plane rounded-full border-2 p-2"></i>
                        </a>
                        <a href="#" class="mr-3">
                            <i class="fab fa-discord rounded-full border-2 p-2"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Company</h4>
                    <ul>
                        <li><a href="#" class="hover:underline">About Us</a></li>
                        <li><a href="#" class="hover:underline">CyETH Explorer</a></li>
                        <li><a href="#" class="hover:underline">CyberEx Docs</a></li>
                        <li><a href="#" class="hover:underline">CyberEx Whitepaper</a></li>
                        <li><a href="#" class="hover:underline">Risk Disclosure Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Community</h4>
                    <ul>
                        <li><a href="#" class="hover:underline">X</a></li>
                        <li><a href="#" class="hover:underline">Discord</a></li>
                        <li><a href="#" class="hover:underline">Telegram</a></li>
                        <li><a href="#" class="hover:underline">Mail</a></li>
                        <li><a href="#" class="hover:underline">Phone</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Help</h4>
                    <ul>
                        <li><a href="#" class="hover:underline">News</a></li>
                        <li><a href="#" class="hover:underline">FAQ</a></li>
                        <li><a href="#" class="hover:underline">Help Center</a></li>
                    </ul>
                    <div class="mt-4 flex">
                        <input type="email" placeholder="Enter your email"
                            class="p-2 rounded-l bg-gray-800 text-white focus:outline-none">
                        <button class="bg-teal-500 p-2 rounded-r"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 text-center py-8 mt-8 flex flex-wrap items-center justify-between">
                <a href="admin.php"
                    class="text-blue-600 hover:text-blue-700 text-sm font-semibold uppercase tracking-wide">
                    <p class="text-left">© 2023 CyberEx Finance. All rights reserved</p>
                </a>
                <div class="text-right">
                    <a href="#" class="hover:underline text-sm mx-2">Terms and Conditions</a>
                    <a href="#" class="hover:underline text-sm mx-2">Policy Service</a>
                    <a href="#" class="hover:underline text-sm mx-2">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>