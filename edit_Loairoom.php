<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Include necessary files and initialize the database connection
    require 'connect.php';

    // Check if an ID is provided in the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $roomId = $_GET['id'];

        // Fetch room details based on the provided ID
        $sql = "SELECT id, name, price, cover_img FROM room_categories WHERE id = $roomId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $room = $result->fetch_assoc();
            ?>
            <h2>Edit Room</h2>
            <form action="update_Loairoom.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
                
                <div class="mb-3">
                    <label for="name" class="form-label">Room Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $room['name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Room Price:</label>
                    <input type="number" id="price" name="price" step="0.01" class="form-control" value="<?php echo $room['price']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="cover_img" class="form-label">Cover Image:</label>
                    <input type="file" id="cover_img" name="cover_img" accept="image/*" class="form-control">
                    <img src="<?php echo $room['cover_img']; ?>" alt="Current Image" width="100">
                </div>

                <input type="submit" value="Update" class="btn btn-primary">
            </form>
            <?php
        } else {
            echo '<p>No room found with the provided ID.</p>';
        }

    } else {
        echo '<p>Invalid room ID.</p>';
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
