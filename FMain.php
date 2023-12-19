<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý khách sạn</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 56px;
        }

        nav.navbar {
            background-color: #343a40;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        nav.navbar a.navbar-brand, nav.navbar a.nav-link {
            color: #ffffff !important;
        }

        nav.navbar a.navbar-brand:hover, nav.navbar a.nav-link:hover {
            color: #dcdcdc !important;
        }

        /* Align the navbar to the right */
        .navbar-nav {
            margin-left: auto;
        }
        .image-slider {
            max-width: 100%;
            overflow: hidden;
        }

        .carousel-inner {
            display: flex;
            flex-direction: row;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item {
            flex: 0 0 auto;
            width: 100%;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Khách sạn </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="FcheckIn.php">Check-in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="FcheckOut.php">Check-out</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rooms.php">Danh sách phòng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Loairooms.php">Loại phòng</a>
                </li>
            </ul>
            
            <!-- Nút Đăng xuất -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Đăng xuất</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Your content goes here -->
<!-- Thanh trượt hình ảnh -->
<div id="imageSlider" class="carousel slide image-slider" data-bs-ride="carousel">
    <div class="carousel-inner">
<!-- Thêm hình ảnh phòng của bạn như các mục thanh trượt -->
        <div class="carousel-item active">
            <img src="1600480260_4.jpg" class="d-block w-100" alt="Phòng 4">
        </div>
        <div class="carousel-item">
            <img src="1600480680_2.jpg" class="d-block w-100" alt="Phòng 2">
        </div>
        <div class="carousel-item">
            <img src="1600480680_room-1.jpg" class="d-block w-100" alt="Phòng 1">
        </div>
        <div class="carousel-item">
            <img src="1600480740_3.jpg" class="d-block w-100" alt="Phòng 3">
        </div>
        <!-- Thêm nhiều mục thanh trượt hình ảnh khác nếu cần -->
    </div>
</div>

<!-- Bootstrap JS và Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- JavaScript tùy chỉnh cho thanh trượt hình ảnh -->
<script>
    // Kích hoạt thanh trượt
    var myCarousel = new bootstrap.Carousel(document.getElementById('imageSlider'), {
        interval: 2000, // Đặt khoảng thời gian giữa các chuyển đổi hình ảnh (tính bằng mili giây)
        ride: 'carousel',
        wrap: true
    });
</script>

</body>
</html>