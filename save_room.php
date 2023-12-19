<?php
// Bao gồm tập tin kết nối đến cơ sở dữ liệu
include('connect.php');

// Kiểm tra xem biểu mẫu có được gửi đi không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ biểu mẫu
    $roomID = $_POST['id'];
    $roomName = $_POST['room'];
    $categoryID = $_POST['category_id'];
    $status = $_POST['status'];
    

    // Thực hiện truy vấn cơ sở dữ liệu để lưu hoặc cập nhật dữ liệu phòng
    if (empty($roomID)) {
        // Chèn một phòng mới
        $conn->query("INSERT INTO rooms (room, category_id, status) VALUES ('$roomName', '$categoryID', '$status')");
    } else {
        // Cập nhật phòng đã tồn tại
        $conn->query("UPDATE rooms SET room = '$roomName', category_id = '$categoryID', status = '$status' WHERE id = '$roomID'");
    }

    // Kiểm tra xem truy vấn có thành công hay không
    if ($conn->affected_rows > 0) {
        $response = ['status' => 'success', 'message' => 'Dữ liệu phòng đã được lưu thành công.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Không thể lưu dữ liệu phòng.'];
    }

    // Trả về phản hồi dưới dạng JSON cho máy khách
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Nếu biểu mẫu không được gửi đi thông qua phương thức POST, xử lý tùy ý
    $response = ['status' => 'error', 'message' => 'Yêu cầu không hợp lệ.'];
    header('Content-Type: application/json');
    echo json_encode($response);
}





?>