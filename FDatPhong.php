<?php
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm thông tin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
        /* Set a maximum width for the form */
        #infoForm {
            max-width: 600px; /* Adjust this value as needed */
            margin: 0 auto; /* Center the form horizontally */
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
        font-size: 1.5rem; /* Increase font size for the brand */
        font-weight: bold; /* Bold font for the brand */
        color: #fff; /* White color for the brand */
        text-decoration: none; /* Remove underline */
    }

    .navbar-nav {
        list-style: none; /* Remove default list styling */
        margin: 0;
        padding: 0;
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
    </style>
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
    

        <form id="infoForm" method="post" action="Datphong.php">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="contact_no" class="form-label">Contact Number:</label>
                <input type="text" class="form-control" id="contact_no" name="contact_no" required>
            </div>

            <div class="mb-3">
                <label for="room_id" class="form-label">Chọn Phòng:</label>
                <select class="form-select" id="room_id" name="room_id" required>
                    <option value="">Chọn phòng</option>
                    <?php
                    $query = "SELECT id FROM rooms WHERE status = 0";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["id"] . "</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No available rooms</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="row g-3">
                <div class="col">
                    <label for="date_in" class="form-label">Date In:</label>
                    <input type="date" class="form-control" id="date_in" name="date_in" required>
                </div>

                <div class="col">
                    <label for="date_out" class="form-label">Date Out:</label>
                    <input type="date" class="form-control" id="date_out" name="date_out" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="1">Checked In</option>
                    <option value="2">Checked Out</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Thêm </button>
        </form>
    </div>

    <div class="container mt-3" id="availableRooms">
        <!-- Kết quả về phòng đang trống sẽ được hiển thị ở đây -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
