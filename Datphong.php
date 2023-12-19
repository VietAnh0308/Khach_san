<?php
require 'connect.php';

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Lấy giá trị từ form
    $room_id = $_POST["room_id"];
    $name = $_POST["name"];
    $contact_no = $_POST["contact_no"];
    $date_in = $_POST["date_in"];
    $date_out = $_POST["date_out"];
    $status = $_POST["status"];

    // Chuẩn bị truy vấn SQL
    $sql = "INSERT INTO Checked (room_id, name, contact_no, date_in, date_out, status) 
            VALUES ('$room_id','$name', '$contact_no', '$date_in', '$date_out','$status')";
            
    // Thực hiện truy vấn và kiểm tra
    if ($conn->query($sql) === TRUE) {
        // Cập nhật trạng thái của phòng từ 'available' (0) sang 'unavailable' (1)
        $sql_update = "UPDATE rooms SET status = '1' WHERE id = '$room_id'";
        $result_update = $conn->query($sql_update);

        if ($result_update) {
            echo "Đặt phòng thành công!";
            header("Location: FMain.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật trạng thái phòng: " . $conn->error;
        }
    } else {
        echo "Lỗi khi thêm thông tin: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>
