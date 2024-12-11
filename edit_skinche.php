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
    $title = $_POST['title'];
    $image_url = $_POST['video_url'];
    $link = $_POST['link'];
    $alt_text = $_POST['alt_text'];
    $description = $_POST['description'];

    // Cập nhật dữ liệu trong cơ sở dữ liệu
    $sql = "UPDATE mod_che SET title=?, video_url=?, link=?, alt_text=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $title, $image_url, $link, $alt_text, $description, $id);

    if ($stmt->execute()) {
        $update_success = true; // Đặt biến thành true nếu cập nhật thành công
    } else {
        $message = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}

// Lấy dữ liệu của skin cần chỉnh sửa
$sql = "SELECT * FROM mod_che WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$skin = $result->fetch_assoc();

if (!$skin) {
    die('Skin chế không tồn tại.');
}
$current_time = date('d/m/Y H:i:s');

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Skin chế</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Chỉnh sửa Skin chế</h1>

    <!-- Hiển thị thông báo -->
    <?php if (isset($message)) echo $message; ?>
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

    <!-- Biểu mẫu chỉnh sửa skin -->
    <form method="post" class="mt-3">
        <div class="form-group">
            <label for="title">Tiêu đề:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($skin['title'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="video_url">URL Hình ảnh:</label>
            <input type="text" class="form-control" id="video_url" name="video_url" value="<?php echo htmlspecialchars($skin['video_url'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="link">Liên kết:</label>
            <input type="text" class="form-control" id="link" name="link" value="<?php echo htmlspecialchars($skin['link'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="alt_text">Alt Text:</label>
            <input type="text" class="form-control" id="alt_text" name="alt_text" value="<?php echo htmlspecialchars($skin['alt_text'], ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($skin['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="admin.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
