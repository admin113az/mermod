<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'connect.php';

// Khởi tạo biến $update_success
$update_success = false;

// Kiểm tra xem có ID nào được cung cấp
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID không hợp lệ.');
}

$id = intval($_GET['id']);

// Xử lý yêu cầu cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_date = $_POST['update_date'];
    $description = $_POST['description'];

    // Cập nhật dữ liệu trong cơ sở dữ liệu
    $sql = "UPDATE updates SET update_date = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $update_date, $description, $id); // Chỉnh sửa kiểu dữ liệu truyền vào (ssi)

    if ($stmt->execute()) {
        $update_success = true; // Đặt biến thành true nếu cập nhật thành công
    } else {
        $message = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }

    $stmt->close(); // Đảm bảo đóng statement sau khi sử dụng
}

// Lấy dữ liệu của bản cập nhật cần chỉnh sửa
$sql = "SELECT * FROM updates WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$updates = $result->fetch_assoc(); // Đổi tên biến thành $updates để khớp với mã HTML bên dưới

if (!$updates) {
    die('Bản cập nhật không tồn tại.');
}
$stmt->close(); // Đảm bảo đóng statement sau khi sử dụng

$current_time = date('d/m/Y H:i:s');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa ngày update</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Chỉnh sửa ngày update</h1>

    <!-- Hiển thị thông báo lỗi -->
    <?php if (isset($message)) echo $message; ?>
    
    <!-- Hiển thị thông báo thành công -->
    <?php if ($update_success): ?>
        <script>
            Swal.fire({
                title: 'Cập nhật thành công!',
                icon: 'success',
                timer: 1500,  // Thay đổi thời gian đóng thông báo
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'admin.php';
            });
        </script>
    <?php endif; ?>

    <p>Thời gian hiện tại: <?php echo $current_time; ?></p>

    <!-- Biểu mẫu chỉnh sửa update -->
    <form method="post" class="mt-3">
        <div class="form-group">
            <label for="update_date">Ngày update:</label>
            <input type="text" class="form-control" id="update_date" name="update_date" value="<?php echo htmlspecialchars($updates['update_date'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
      
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($updates['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="admin.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
