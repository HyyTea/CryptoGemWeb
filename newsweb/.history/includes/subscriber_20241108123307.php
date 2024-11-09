<?php
session_start();
include('includes/config.php');
?>

<?php
// Kiểm tra kết nối
if ($con->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $con->connect_error]);
    exit();
}

// Lấy email từ yêu cầu JSON
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];

// Kiểm tra nếu email đã tồn tại
$stmt = $conn->prepare("SELECT * FROM subscriber WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Email đã được đăng ký.']);
} else {
    // Chèn email vào bảng subscribers
    $stmt = $conn->prepare("INSERT INTO subscriber (email) VALUES (?)");
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
