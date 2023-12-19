<?php
require 'connect.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $roomId = $_GET['id'];

    // Perform the SQL query to delete the room with the specified ID
    $sql = "DELETE FROM room_categories WHERE id = $roomId";
    $result = $conn->query($sql);

    if ($result) {
        // Deletion successful
        echo 'Room deleted successfully.';
    } else {
        // Error in deletion
        echo 'Error deleting room: ' . $conn->error;
    }
} else {
    // 'id' parameter not set
    echo 'Invalid request. Room ID not specified.';
}

$conn->close();
?>
