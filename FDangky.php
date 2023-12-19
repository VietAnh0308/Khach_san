<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
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

        .container {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 300px;
        }

        h2 {
            background: linear-gradient(to right, rgba(255, 0, 0, 0.3), rgba(0, 1, 255, 0.5));
            /* Gradient overlay */
            color: #fff;
            text-align: center;
            font-weight: bold;
            border-bottom: none;
            padding: 20px;
            margin-bottom: 20px;
            margin-top: 0px;

        }

        form {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            color: #495057;
        }

        .form-control {
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            color: #fff;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* ... (các phần CSS hiện tại) */

        /* Phần mục "Vai trò" */
        .form-group-role {
            margin-bottom: 20px;
        }

        .form-label-role {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-select-role {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        /* Hiệu ứng khi hover và focus */
        .form-select-role:hover,
        .form-select-role:focus {
            border-color: #007bff;
            /* Màu xanh dương */
        }

        /* ... (các phần CSS hiện tại) */
    </style>
</head>

<body>

    <div class="container">
        <h2>Đăng ký</h2>
        <form action="Dangky.php" method="post">
            <div class="form-group">
                <label for="name" class="form-label" style="color: #1F1717;">Tên người dùng</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="username" class="form-label" style="color: #1F1717;">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label" style="color: #1F1717;">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password" class="form-label" style="color: #1F1717;">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group form-group-role">
                <label for="type" class="form-label-role">Vai trò</label>
                <select class="form-select-role" id="type" name="type" required>
                    <option value="2">user</option>
                    <option value="1">admin</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>