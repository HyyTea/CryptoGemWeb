<?php
session_start();
include('config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log email gửi đến
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];
file_put_contents('log.txt', "Received email: " . $email . "\n", FILE_APPEND); // Ghi log để kiểm tra email

// Kiểm tra email và xử lý
$stmt = $con->prepare("SELECT * FROM tblsubscriber WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Email đã được đăng ký.']);
} else {
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
