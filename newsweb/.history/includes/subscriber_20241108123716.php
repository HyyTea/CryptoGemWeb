<?php
session_start();
include('config.php');
?>

<?php
// Lấy email từ yêu cầu JSON
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];

// Kiểm tra nếu email đã tồn tại
$stmt = $conn->prepare("SELECT * FROM tblsubscriber WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Email đã được đăng ký.']);
} else {
    // Chèn email vào bảng subscribers
    $stmt = $con->prepare("INSERT INTO tblsubscriber (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra.']);
    }
}

$stmt->close();
$con->close();
?>
