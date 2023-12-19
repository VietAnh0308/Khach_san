<?php include('connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Your Page Title</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<style>
		body {
			background-color: #f8f9fa;
			/* padding-top: 20px; */
		}

		.container-fluid {
			margin-top: 20px;
		}

		.card {
			margin-bottom: 20px;
		}

		.card-header {
			background-color: #007bff;
			color: #fff;
			text-align: center;
			padding: 10px;
		}

		.card-body {
			padding: 20px;
		}

		.card-footer {
			background-color: #f8f9fa;
			padding: 10px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 10px;
			text-align: center;
		}

		th {
			background-color: #007bff;
			color: #fff;
		}

		.btn {
			margin-right: 5px;
		}

		.badge {
			padding: 5px 10px;
		}

		.bg-success {
			background-color: #28a745;
			color: #fff;
		}

		.bg-secondary {
			background-color: #6c757d;
			color: #fff;
		}

		.navbar {
			width: 100%;
			height: 60px;
		}

		nav.navbar a.nav-link:hover {
			color: #dcdcdc !important;
		}
	</style>
	</head>

	<body>
		<?php include('connect.php'); ?>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 36px;">
			<div class="container-fluid" style="padding-bottom: 19px;">
				<a class="navbar-brand" href="#">Room</a>
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

			<div class="col-lg-12">
				<div class="row">
					<!-- FORM Panel -->
					<div class="col-md-4">
						<form action="" id="manage-room">
							<div class="card">
								<div class="card-header">
									Mẫu Phòng
								</div>
								<div class="card-body">
									<input type="hidden" name="id">
									<div class="form-group">
										<label class="control-label">Phòng</label>
										<input type="text" class="form-control" name="room">
									</div>
									<div class="form-group">
										<label class="control-label">Loại</label>
										<select class="custom-select browser-default" name="category_id">
											<?php
											$cat = $conn->query("SELECT * FROM room_categories order by name asc ");
											while ($row = $cat->fetch_assoc()) {
												$cat_name[$row['id']] = $row['name'];
											?>
												<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="form-group">
<label for="" class="control-label">Tình trạng</label>
										<select class="custom-select browser-default" name="status">
											<option value="0">Có sẵn</option>
											<option value="1">Không có săn</option>

										</select>
									</div>
								</div>
								<div class="card-footer">
									<div class="row">
										<div class="col-md-12">
											<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Lưu</button>
											<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-room').get(0).reset()"> Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<!-- FORM Panel -->

					<!-- Table Panel -->
					<div class="col-md-8">
						<div class="card">
							<div class="card-body">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Loại</th>
											<th class="text-center">Phòng</th>
											<th class="text-center">Trạng Thái</th>
											<th class="text-center">Hoạt Động</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										$rooms = $conn->query("SELECT * FROM rooms order by id asc");
										while ($row = $rooms->fetch_assoc()) :
										?>
											<tr>
												<td class="text-center"><?php echo $i++ ?></td>

												<td class="text-center"><?php echo $cat_name[$row['category_id']] ?></td>
												<td class=""><?php echo $row['room'] ?></td>
												<?php if ($row['status'] == 0) : ?>
													<td class="text-center"><span class="badge bg-success">Có Sẵn</span></td>
												<?php else : ?>
													<td class="text-center"><span class="badge bg-secondary">Không có sẵn</span></td>
												<?php endif; ?>

												<td class="text-center">
													<button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $row['id'] ?>" data-room="<?php echo $row['room'] ?>" data-category_id="<?php echo $row['category_id'] ?>" data-status="<?php echo $row['status'] ?>">Edit</button>
													<button class="btn btn-sm btn-danger delete_cat" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
												</td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- Table Panel -->
				</div>
			</div>

		</div>

		< </body>

</html>
<!-- Add this at the end of your HTML file -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
	$(document).ready(function() {
		// Handle form submission
		$('#manage-room').submit(function(e) {
			e.preventDefault(); // Prevent the default form submission

			// Get form data
			var formData = $(this).serialize();

			// Perform AJAX request to save data
$.ajax({
				url: 'save_room.php', // Replace with the actual URL to handle form submission
				type: 'POST',
				data: formData,
				success: function(response) {
					// Handle the response from the server
					console.log(response);
					// You can update the UI or perform other actions based on the response

					// Nếu xóa lưu, làm mới trang
					if (response.status === 'success') {
						location.reload();
					}
				},
				error: function(error) {
					// Handle errors
					console.error('Error:', error);
				}
			});
		});
	});

	// xóa

	$(document).ready(function() {
		// Xử lý sự kiện click vào nút Delete
		$('.delete_cat').click(function() {
			// Lấy ID của phòng từ thuộc tính data-id
			var roomId = $(this).data('id');

			// Xác nhận xóa
			var confirmDelete = confirm('Bạn có chắc chắn muốn xóa phòng này?');

			if (confirmDelete) {
				// Thực hiện AJAX request để xóa phòng
				$.ajax({
					url: 'Delete_rooms.php', // Thay thế đường dẫn này bằng đường dẫn xử lý xóa thực tế trên máy chủ
					type: 'POST',
					data: {
						id: roomId
					},
					success: function(response) {
						// Xử lý phản hồi từ máy chủ
						console.log(response);
						// Cập nhật giao diện người dùng hoặc thực hiện các hành động khác dựa trên phản hồi

						// Nếu xóa thành công, làm mới trang
						if (response.status === 'success') {
							location.reload();
						}

					},
					error: function(error) {
						// Xử lý lỗi
						console.error('Lỗi:', error);
					}
				});
			}
		});
	});

	// edit

	$(document).ready(function() {
		// Xử lý sự kiện click vào nút Edit
		$('.edit_cat').click(function() {
			// Lấy thông tin từ thuộc tính data của nút Edit
			var roomId = $(this).data('id');
			var roomName = $(this).data('room');
			var categoryId = $(this).data('category_id');
			var status = $(this).data('status');

			// Đưa thông tin vào biểu mẫu chỉnh sửa
			$('#manage-room input[name="id"]').val(roomId);
			$('#manage-room input[name="room"]').val(roomName);
			$('#manage-room select[name="category_id"]').val(categoryId);
			$('#manage-room select[name="status"]').val(status);
		});
	});
</script>