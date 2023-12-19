<?php
// Include necessary files and initialize the database connection
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input data
    $roomId = $_POST['id'];
    $roomName = mysqli_real_escape_string($conn, $_POST['name']);
    $roomPrice = floatval($_POST['price']);

    // Check if a new image file is uploaded
    if ($_FILES['cover_img']['error'] === 0) {
        $uploadDir = 'C:/xampp/htdocs/PHP/QLKhachsan/'; // You should create this directory
        $uploadFile = $uploadDir . basename($_FILES['cover_img']['name']);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['cover_img']['tmp_name'], $uploadFile)) {
            // Update room details with the new image file name
            $imageName = basename($_FILES['cover_img']['name']);
            $updateSql = "UPDATE room_categories SET name='$roomName', price=$roomPrice, cover_img='$imageName' WHERE id=$roomId";
            if ($conn->query($updateSql) === TRUE) {
                header("Location: Loairooms.php");
                exit();
            } else {
                echo 'Error updating room: ' . $conn->error;
            }
        } else {
            echo 'Error uploading file.';
        }
    } else {
        // No new image file uploaded, update room details without changing the image
        $updateSql = "UPDATE room_categories SET name='$roomName', price=$roomPrice WHERE id=$roomId";
        if ($conn->query($updateSql) === TRUE) {
            header("Location: Loairooms.php");
                exit();
        } else {
            echo 'Error updating room: ' . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
