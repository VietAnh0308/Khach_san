<?php
// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối của bạn)
require 'connect.php';

// Thu thập dữ liệu từ form
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$type = $_POST['type']; // Lấy giá trị từ trường vai trò trong form

// Thêm vào cơ sở dữ liệu
$sql = "INSERT INTO users ( name ,username, password, type) VALUES ('$name','$username', '$password', '$type')";

if ($conn->query($sql) === TRUE) {
    echo "Đăng ký thành công!";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
// Trong tệp nơi bạn kiểm tra quyền, ví dụ: dashboard.php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['id'])) {
    header("Location: Flogin.php");
    exit();
}

// Lấy vai trò của người dùng từ cơ sở dữ liệu
$stmt = $pdo->prepare("SELECT type FROM users WHERE id = ?");
$stmt->execute([$_SESSION['id']]);
$user = $stmt->fetch();

// Kiểm tra vai trò và thực hiện các hành động tương ứng
if ($user['type'] == 1) {
    // Hiển thị nội dung chỉ dành cho quản trị viên
    echo "Chào mừng bạn, quản trị viên!";
} else {
    // Hiển thị nội dung cho người dùng thông thường
    echo "Chào mừng bạn!";
}

// Chuyển hướng người dùng sau khi đăng ký
header("Location: Flogin.php");
exit();

?>
