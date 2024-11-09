<?php
// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "username"; // Thay bằng tên người dùng của bạn
$password = "password"; // Thay bằng mật khẩu của bạn
$dbname = "database"; // Thay bằng tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy email từ yêu cầu JSON
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];

// Kiểm tra nếu email đã tồn tại
$stmt = $conn->prepare("SELECT * FROM subscribers WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Email đã được đăng ký.']);
} else {
    // Chèn email vào bảng subscribers
    $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra.']);
    }
}

$stmt->close();
$conn->close();
?>
