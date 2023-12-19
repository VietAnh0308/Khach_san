<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Information</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container, .info-container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            padding: 20px;
            margin: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="form-container">
    <form action="save_Loairoom.php" method="post" enctype="multipart/form-data">
            

            <div class="mb-3">
                <label for="name" class="form-label">Room Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Room Price:</label>
                <input type="number" id="price" name="price" step="0.01" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cover_img" class="form-label">Cover Image:</label>
                <input type="file" id="cover_img" name="cover_img" accept="image/*" class="form-control" required>
            </div>

            <input type="submit" value="Lưu" class="btn btn-success">
        </form>
    </div>

    <div class="info-container">
        <?php
        // Kết nối đến cơ sở dữ liệu (thay thế thông tin của bạn ở đây)
        require 'connect.php';

        

        // Thực hiện truy vấn SQL để lấy dữ liệu
        $sql = "SELECT id, name, price, cover_img FROM room_categories";
        $result = $conn->query($sql);

        // Kiểm tra xem có dữ liệu trả về không
        if ($result->num_rows > 0) {
            // Hiển thị dữ liệu trong bảng Bootstrap
            echo '<table class="table table-bordered mt-3">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Name</th>';
            echo '<th>Price</th>';
            echo '<th>Image</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Output dữ liệu mỗi hàng
            $counter = 1; // Initialize a counter variable
            while ($row = $result->fetch_assoc()) {
                $formattedPrice = number_format($row['price'], 2); // Format price with 2 decimal places
                echo "<tr>
                        <td>{$counter}</td>
                        <td>{$row['name']}</td>
                        <td>\${$formattedPrice}</td> <!-- Include the dollar sign and formatted price -->
                        <td><img src='{$row['cover_img']}' alt='Room Image' width='100'></td>
                        <td>
                            <button class='btn btn-primary' onclick='editRoom({$row['id']})'>Edit</button>
                            <button class='btn btn-danger' onclick='deleteRoom({$row['id']})'>Delete</button>
                        </td>
                      </tr>";
                $counter++; // Increment the counter for the next iteration
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No results found.</p>';
        }

        $conn->close();
        ?>
    </div>
</div>

<!-- Your existing JavaScript functions -->
<!-- Inside your existing <script> tag -->
<script>
    function editRoom(roomId) {
        // Assuming you want to redirect to an edit page with the room ID
        window.location.href = 'edit_Loairoom.php?id=' + roomId;
    }
    function deleteRoom(roomId) {
    if (confirm('Are you sure you want to delete this room?')) {
      // User confirmed the deletion, send an AJAX request to delete the room
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          // Reload the page to reflect the changes after deletion
          location.reload();
        }
      };
      xhr.open('GET', 'delete_Loairoom.php?id=' + roomId, true);
      xhr.send();
    }
  }
  
</script>


<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>