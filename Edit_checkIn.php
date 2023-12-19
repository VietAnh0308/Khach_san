<?php
// edit_checkin.php

// Include your database connection file
include('connect.php');

// Kiểm tra xem có tham số 'id' truyền vào không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn để lấy thông tin kiểm tra dựa trên ID
    $query = "SELECT * FROM checked WHERE id = $id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Get the initially selected room_id
        $selectedRoomId = $row['room_id'];

        // Fetch only available rooms
        $roomQuery = "SELECT id, room, status FROM rooms WHERE status = '0' OR id = '$selectedRoomId'";
        $roomResult = $conn->query($roomQuery);

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Edit Check-in</title>
            <style>
                /* Custom CSS to adjust the form width */
                /* Reset some default styles for better consistency */
body, h1, h2, h3, p, ul, li {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa; /* Light gray background color */
}

nav {
    background-color: #007bff; /* Blue background color */
    padding: 10px 0; /* Add some padding for better spacing */
    color: #fff; /* White text color */
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar-brand {
    font-weight: bold; /* Bold font for the brand */
    color: #fff; /* White color for the brand */
    text-decoration: none; /* Remove underline */
}

.navbar-nav {
    list-style: none; /* Remove default list styling */
    display: flex;
    gap: 20px; /* Adjust the gap between items */
}

.nav-item {
    /* Optional: Add some styling for each navigation item */
}

.nav-link {
    text-decoration: none;
    color: #fff; /* White color for the links */
    font-weight: bold; /* Bold font for the links */
    transition: color 0.3s ease; /* Smooth color transition on hover */

    /* Optional: Add some styling for each link */
}

.nav-link:hover {
    color: #f8f9fa; /* Change color on hover */
}

/* Apply styles to the container holding the form */
.custom-form {
    width: 100%; /* Adjust the width as needed */
    margin: 50px auto; /* Center the form */
    background-color: #fff; /* White background color for the form */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
}

/* Style form labels and inputs */
.custom-form label {
    width: 100%;
    display: block;
    margin-bottom: 8px;
}

.custom-form input,
.custom-form select {
    width: 100%; /* Adjust the width as needed */
    padding: 10px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Center the form button */
.custom-form button {
    display: block;
    margin: 0 auto;
}
.custom-form button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

        
        
            </style>
        </head>
        <body>
        <nav>
    <div class="container">
        <a class="navbar-brand" href="#">Check-In</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="FMain.php">Trang Chủ</a>
            </li>
            <!-- Add more navigation items as needed -->
        </ul>
    </div>
</nav>

        <div class="container mt-5 custom-form">
            <form action="update_checkin.php" method="post">

                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($row['name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contact #</label>
                    <input type="text" name="contact" id="contact" class="form-control" value="<?= htmlspecialchars($row['contact_no']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="room_name" class="form-label">Room Name</label>
                    <select name="room_name" id="room_name" class="form-select" required>
                        <?php while ($roomRow = $roomResult->fetch_assoc()): ?>
                            <?php $selected = ($roomRow['id'] == $selectedRoomId) ? 'selected' : ''; ?>
                            <option value="<?= $roomRow['id'] ?>" <?= $selected ?>><?= htmlspecialchars($roomRow['room']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date_in" class="form-label">Check-in Date</label>
                    <input type="date" name="date_in" id="date_in" class="form-control" value="<?= date("Y-m-d", strtotime($row['date_in'])) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="date_out" class="form-label">Check-out Date</label>
                    <input type="date" name="date_out" id="date_out" class="form-control" value="<?= date("Y-m-d", strtotime($row['date_out'])) ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>

            </form>
        </div>

        </body>
        </html>

        <?php
    } else {
        echo "Error: Unable to fetch check-in data.";
    }
} else {
    echo "Error: Invalid request.";
}

// Đóng kết nối với cơ sở dữ liệu
$conn->close();
?>
