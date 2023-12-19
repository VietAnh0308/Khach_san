<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khách sạn - Đăng nhập</title>
    <style>
        body {
            background-image: url('nenmain.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Arial', sans-serif;
            color: #fff;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.5); /* Màu trắng trong suốt */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Hiệu ứng khối */
            overflow: hidden;
            width: 300px; /* Độ rộng của form */
        }

        .card-header {
            background: linear-gradient(to right, rgba(255,0,0,0.3), rgba(0,1,255,0.5)); /* Gradient overlay */
            color: #fff;
            text-align: center;
            font-weight: bold;
            border-bottom: none;
            padding: 20px;
        }

        .card-body {
            padding: 30px;
        }

        .form-label {
            color: #495057;
        }

        .form-control {
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            width: 100%;
            padding: 10px;
            color: #fff;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #1F1717;
            text-decoration: none; /* Thêm thuộc tính này để loại bỏ đường gạch chân */
        }

        .register-link:hover {
            color: #6C5F5B;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-header">Đăng nhập</div>
            <div class="card-body">
                <form method="post" action="login.php">
                    <label for="username" class="form-label" style="color: #1F1717;">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập">

                    <label for="password" class="form-label" style="color: #1F1717;">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                        <label class="form-check-label" for="rememberMe" style="color: #1F1717;">Nhớ Mật Khẩu</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    <a href="FDangky.php" class="register-link">Đăng Ký</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>