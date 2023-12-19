<?php include('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        nav.navbar a.nav-link:hover {
			color: #dcdcdc !important;
		}
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 36px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Check-In</a>
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


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <form id="filter" class="row g-3">
                                        <div class="col-12">
                                            <label for="category" class="form-label">Loại</label>
                                            <select class="form-select" name="category_id">
                                                <option value="all" <?php echo isset($_GET['category_id']) && $_GET['category_id'] == 'all' ? 'selected' : '' ?>>All</option>
                                                <?php
                                                $cat = $conn->query("SELECT * FROM room_categories ORDER BY name ASC ");
                                                while ($row = $cat->fetch_assoc()) {
                                                    $cat_name[$row['id']] = $row['name'];
                                                ?>
                                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($_GET['category_id']) && $_GET['category_id'] == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary">Lọc</button>
</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                $where = '';
                                if (isset($_GET['category_id']) && !empty($_GET['category_id']) && $_GET['category_id'] != 'all') {
                                    $where .= " where category_id = '" . $_GET['category_id'] . "' ";
                                }
                                if (empty($where))
                                    $where .= " where status = '0' ";
                                else
                                    $where .= " and status = '0' ";
                                $rooms = $conn->query("SELECT * FROM rooms " . $where . " ORDER BY id ASC");

                                while ($row = $rooms->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class="text-center"><?php echo $cat_name[$row['category_id']] ?></td>
                                        <td><?php echo $row['room'] ?></td>
                                        <?php if ($row['status'] == 0) : ?>
                                            <td class="text-center"><span class="badge bg-success">Có Sẵn</span></td>
                                        <?php else : ?>
                                            <td class="text-center"><span class="badge bg-secondary">Không có sẵn</span></td>
                                        <?php endif; ?>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary check_in" type="button" onclick="handleCheckIn(<?php echo $row['id'] ?>)">Check-in</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function goBack() {
window.history.back();
        }

        function handleCheckIn(roomId) {
            // Display the room ID on the page


            // Redirect to the check-in page
            window.location.href = 'FDatPhong.php?room_id=' + roomId;
        }
    </script>
    <!-- Bootstrap JS Link (Optional: Only if you need Bootstrap JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>