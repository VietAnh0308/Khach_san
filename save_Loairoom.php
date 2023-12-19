<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'edit_id' is set to determine whether it's an add or edit operation
    if (isset($_POST['edit_id'])) {
        // Edit operation
        $roomId = $_POST['edit_id'];
        $roomName = $_POST['name'];
        $roomPrice = $_POST['price'];

        // Check if a new image file is provided
        if (isset($_FILES['cover_img']) && $_FILES['cover_img']['error'] === UPLOAD_ERR_OK) {
            // Handle the image upload
            $targetDir = 'C:/xampp/htdocs/PHP/QLKhachsan/'; // Replace with your desired upload directory
            $imageName = basename($_FILES['cover_img']['name']);
            $targetFile = $targetDir . $imageName;
            move_uploaded_file($_FILES['cover_img']['tmp_name'], $targetFile);

            // Update the room details in the database with the new image filename
            $sql = "UPDATE room_categories SET name='$roomName', price='$roomPrice', cover_img='$imageName' WHERE id=$roomId";
        } else {
            // Update the room details in the database without changing the existing image
            $sql = "UPDATE room_categories SET name='$roomName', price='$roomPrice' WHERE id=$roomId";
        }

        $result = $conn->query($sql);

        if ($result) {
            // Update successful
            echo 'Room updated successfully.';
        } else {
            // Error in update
            echo 'Error updating room: ' . $conn->error;
        }
    } else {
        // Add operation only if the file doesn't exist
        $roomName = $_POST['name'];
        $roomPrice = $_POST['price'];

        // Check if an image file is provided and if the room with the same name already exists
        if (isset($_FILES['cover_img']) && $_FILES['cover_img']['error'] === UPLOAD_ERR_OK) {
            $targetDir = 'C:/xampp/htdocs/PHP/QLKhachsan/';
            $imageName = basename($_FILES['cover_img']['name']);
            $targetFile = $targetDir . $imageName;

            // Check if the room with the same name already exists
            $checkExistingSql = "SELECT id FROM room_categories WHERE name='$roomName'";
            $existingResult = $conn->query($checkExistingSql);

            if ($existingResult->num_rows > 0) {
                // Room with the same name already exists, update the existing record
                $existingRow = $existingResult->fetch_assoc();
                $roomId = $existingRow['id'];

                $updateSql = "UPDATE room_categories SET name='$roomName', price='$roomPrice', cover_img='$imageName' WHERE id=$roomId";
                $result = $conn->query($updateSql);

                if ($result) {
                    header("Location: Loairooms.php");
                exit();
                } else {
                    echo 'Error updating room: ' . $conn->error;
                }
            } else {
                // Insert new room into the database with the image filename
                move_uploaded_file($_FILES['cover_img']['tmp_name'], $targetFile);
                $insertSql = "INSERT INTO room_categories (name, price, cover_img) VALUES ('$roomName', '$roomPrice', '$imageName')";
                $result = $conn->query($insertSql);

                if ($result) {
                    header("Location: Loairooms.php");
                exit();
                } else {
                    echo 'Error adding room: ' . $conn->error;
                }
            }
        } else {
            // Insert new room into the database without an image
            $insertSql = "INSERT INTO room_categories (name, price) VALUES ('$roomName', '$roomPrice')";
            $result = $conn->query($insertSql);

            if ($result) {
                header("Location: Loairooms.php");
                exit();
            } else {
                echo 'Error adding room: ' . $conn->error;
            }
        }
    }
} else {
    // Invalid request method
    echo 'Invalid request method.';
}

$conn->close();
?>
