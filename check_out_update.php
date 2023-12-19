<?php
// check_out_update.php

include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Update status to Checked-Out in the 'checked' table
    $updateQuery = "UPDATE checked SET status = 2 WHERE id = $id";
    if ($conn->query($updateQuery) === TRUE) {
        // Log statement removed
    } else {
        // Log statement removed
    }

    // Update room status to vacant in the 'rooms' table (you may need to adjust this query based on your schema)
    $updateRoomQuery = "UPDATE rooms SET status = '0' WHERE id = (SELECT room_id FROM checked WHERE id = $id)";
    if ($conn->query($updateRoomQuery) === TRUE) {
        // Log statement removed
    } else {
        // Log statement removed
    }

    // Additional actions if needed
    
    echo 'Success'; // Send a success response
    header("Location: FMain.php");
    exit();
} else {
    echo 'Error: Invalid request.';
}
?>
