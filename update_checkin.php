<?php
// update_checkin.php

// Include your database connection file
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $room_id = $_POST['room_name']; // Thay đổi thành tên trường tương ứng trong cơ sở dữ liệu nếu cần
    $date_in = $_POST['date_in'];
    $date_out = $_POST['date_out'];

    // Cập nhật thông tin kiểm tra trong cơ sở dữ liệu
    $updateQuery = "UPDATE checked 
                    SET name = '$name', contact_no = '$contact', room_id = '$room_id', date_in = '$date_in', date_out = '$date_out'
                    WHERE id = $id";

$updateRoomQuery = "UPDATE rooms SET status = '0' WHERE id = (SELECT room_id FROM checked WHERE id = $id)";
if ($conn->query($updateRoomQuery) === TRUE) {
    
} else {
    
}
$sql_update = "UPDATE rooms SET status = '1' WHERE id = '$room_id'";
        $result_update = $conn->query($sql_update);

    if ($conn->query($updateQuery) === TRUE) {
        echo "Update successful!";
        header("Location: FMain.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request method. Please use POST.";
}

// Đóng kết nối với cơ sở dữ liệu
$conn->close();
?>
