<?php
include('connect.php');
function fetchRoomCategories($conn) {
    $cat = $conn->query("SELECT * FROM room_categories");
    $cat_arr = array();
    while ($row = $cat->fetch_assoc()) {
        $cat_arr[$row['id']] = $row;
    }
    return $cat_arr;
}

function fetchRooms($conn) {
    $room = $conn->query("SELECT * FROM rooms");
    $room_arr = array();
    while ($row = $room->fetch_assoc()) {
        $room_arr[$row['id']] = $row;
    }
    return $room_arr;
}

function fetchCheckedData($conn) {
    $checked = $conn->query("SELECT * FROM checked where status != 0 order by status desc, id asc ");
    $checked_arr = array();
    while ($row = $checked->fetch_assoc()) {
        $checked_arr[] = $row;
    }
    return $checked_arr;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .table-container {
            max-height: 400px;
            overflow-y: auto;
        }

        .table-container table thead th {
            position: sticky;
            top: 0;
            background-color: #f8f9fa;
        }
        nav.navbar a.nav-link:hover {
			color: #dcdcdc !important;
		}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 36px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Check-out</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Bỏ đi chữ "Check-In" ở đây -->
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="FMain.php" style="color: #fff;">Trang Chủ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Your navigation bar here -->
</nav>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <th>#</th>
                            <th>Loại</th>
                            <th>Phòng</th>
                            <th>Trạng Thái</th>
                            <th>Hoạt Động</th>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $cat_arr = fetchRoomCategories($conn);
                            $room_arr = fetchRooms($conn);
$checked_arr = fetchCheckedData($conn);

                            foreach ($checked_arr as $row):
                                ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $cat_arr[$room_arr[$row['room_id']]['category_id']]['name'] ?></td>
                                    <td><?php echo $room_arr[$row['room_id']]['room'] ?></td>

                                    <?php if ($row['status'] == 1) : ?>
                                    <td class="text-center"><span class="badge bg-success">Check-in</span></td>
                                <?php else: ?>
                                    <td class="text-center"><span class="badge bg-secondary">Check-out</span></td>
                                <?php endif; ?>

                                    <td>
                                        <button class="btn btn-primary check_out" type="button"
                                                data-id="<?php echo $row['id'] ?>" data-bs-toggle="modal"
                                                data-bs-target="#checkOutModal">View
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Check-Out Information -->
<div class="modal fade" id="checkOutModal" tabindex="-1" aria-labelledby="checkOutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkOutModalLabel">Check-Out Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="checkOutModalBody">
                <!-- Content loaded via AJAX will be displayed here -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $('.check_out').on('click', function () {
        // Fetch data using AJAX based on the clicked element's data-id
        $.ajax({
            url: 'check_out.php', // Change this URL to the correct endpoint
            type: 'POST',
            data: {id: $(this).data("id")},
            success: function (response) {
                $('#checkOutModalBody').html(response);
                $('#checkOutModal').modal('show'); // Show the modal after content is loaded
            }
        });
    });
</script>

</body>
</html>