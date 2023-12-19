<?php
// Check if the request is made using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'id' parameter is set in the POST data
    if (isset($_POST['id'])) {
        // Include your database connection script
        require 'connect.php';

        // Sanitize the input to prevent SQL injection
        $roomId = mysqli_real_escape_string($conn, $_POST['id']);

        // Prepare and execute the SQL query to delete the room
        $sql = "DELETE FROM room_categories WHERE id = $roomId";
        if ($conn->query($sql) === TRUE) {
            // If the deletion is successful, send a success response
            $response = [
                'status' => 'success',
                'message' => 'Room deleted successfully.'
            ];
        } else {
            // If there is an error, send an error response
            $response = [
                'status' => 'error',
                'message' => 'Error deleting room: ' . $conn->error
            ];
        }

        // Close the database connection
        $conn->close();

        // Send the JSON response back to the JavaScript code
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // If 'id' is not set in the POST data, send an error response
        $response = [
            'status' => 'error',
            'message' => 'Invalid request. Missing room ID.'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // If the request is not made using the POST method, send an error response
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method.'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
