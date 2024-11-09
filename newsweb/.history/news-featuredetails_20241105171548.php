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

$pid = intval($_GET['nid']); // Lấy ID bài viết chính

// Lấy dữ liệu bài viết từ cơ sở dữ liệu, loại trừ bài viết chính
$query4 = mysqli_query($con, "SELECT tblfeatureposts.id AS pid4,
    tblfeatureposts.PostTitle AS posttitle4,
    tblfeatureposts.PostImage,
    tblcategory.CategoryName AS category4,
    tblcategory.id AS cid4,
    tblsubcategory.Subcategory AS subcategory4,
    tblfeatureposts.PostDetails AS postdetails4,
    tblfeatureposts.PostingDate AS postingdate4,
    tblfeatureposts.PostUrl AS url4 
    FROM tblfeatureposts 
    LEFT JOIN tblcategory ON tblcategory.id = tblfeatureposts.CategoryId 
    LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblfeatureposts.SubCategoryId 
    WHERE tblfeatureposts.Is_Active = 1 AND tblfeatureposts.id != '$pid' 
    ORDER BY tblfeatureposts.id DESC  
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
    <h1 class="mb-3" style="font-weight: 600;">READ NEXT</h1>

    <div class="row" style="gap: 20px;">
        <?php
        // Hiển thị các bài viết
        foreach (array_slice($posts2, 0, 5) as $index => $post2) {
            echo '<div class="custom-col mb-4 d-flex">'; // Sử dụng flex-column để có chiều cao đồng đều
            echo '<a href="news-featuredetails.php?nid=' . htmlentities($post2['pid4']) . '" class="text-decoration-none text-dark" style="display: block;">';
            echo '<div style="border: 1px solid #ccc; padding: 0; max-height: 100%; border-radius: 5%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 100%;">'; // Chiều cao 100%
            echo '<div class="overflow-hidden" style="height: 250px; width: 100%; border-radius: 5%;">'; // Ảnh với border-radius
            echo '<img src="admin/featurepostimages/' . htmlentities($post2['PostImage']) . '" class="w-100 h-100" style="object-fit: cover;" alt="' . htmlentities($post2['posttitle4']) . '">'; 
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
</div>
