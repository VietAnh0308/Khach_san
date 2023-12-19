<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Sử dụng Prepared Statements để tránh SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Lấy thông tin người dùng
        $user = $result->fetch_assoc();

        // Kiểm tra loại người dùng hoặc quyền hạn
        if ($user['type'] == '1') {
            // Đăng nhập thành công cho admin, chuyển hướng sang trang admin
            header("Location: FMain.php");
            exit();
        } elseif ($user['type'] == '2') {
            // Đăng nhập thành công cho user, chuyển hướng sang trang user
            header("Location: UserMain.php");
            exit();
        } else {
            // Đối với các quyền hạn khác, có thể xử lý tương ứng
            echo "Không có quyền hạn đăng nhập.";
        }
    } else {
        // Đăng nhập không thành công
        echo "Đăng nhập không thành công, vui lòng kiểm tra thông tin đăng nhập.\n";
    }

    $stmt->close();
}

$conn->close();
?>
