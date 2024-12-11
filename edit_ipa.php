<?php
require_once 'connect.php';
session_start(); // Bắt đầu phiên làm việc với session

// Lấy ID từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy dữ liệu IPA từ cơ sở dữ liệu
if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM ipas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if (!$row) {
        echo "Không tìm thấy IPA.";
        exit;
    }
} else {
    echo "ID không hợp lệ.";
    exit;
}

// Xử lý dữ liệu khi form được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $version = $_POST['version'];
    $map_type = $_POST['map_type'];
    $image_url = $_POST['image_url'];
    $download_link = $_POST['download_link'];

    // Cập nhật dữ liệu IPA trong cơ sở dữ liệu
    $stmt = $conn->prepare("UPDATE ipas SET version = ?, map_type = ?, image_url = ?, download_link = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $version, $map_type, $image_url, $download_link, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Lưu thông báo vào session
        $_SESSION['message'] = "Cập nhật thành công!";
        $redirect_url = "admin.php"; // Địa chỉ trang đích
        $message = "<div class='alert alert-success'>Cập nhật thành công!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Không có thay đổi hoặc lỗi xảy ra.</div>";
        $redirect_url = "admin.php";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa IPA</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        // Hàm để chuyển hướng sau một khoảng thời gian
        function redirectTo(url) {
            setTimeout(function() {
                window.location.href = url;
            }, 1500); // Thời gian hiển thị thông báo (1500 ms = 1.5 giây)
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Sửa IPA</h1>
        
        <!-- Hiển thị thông báo -->
        <?php if (isset($message)) echo $message; ?>

        <!-- Form chỉnh sửa IPA -->
        <form method="post" class="mt-3 mb-5">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="table" value="ipas">
            <div class="form-group">
                <label for="version">Phiên bản:</label>
                <input type="text" class="form-control" id="version" name="version" value="<?php echo htmlspecialchars($row['version'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="map_type">Thể loại bản đồ:</label>
                <select class="form-control" id="map_type" name="map_type" required>
                    <option value="NO MAP" <?php echo ($row['map_type'] == 'NO MAP') ? 'selected' : ''; ?>>Không Map</option>
                    <option value="CÓ MAP" <?php echo ($row['map_type'] == 'CÓ MAP') ? 'selected' : ''; ?>>Có Map</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image_url">URL Hình ảnh:</label>
                <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo htmlspecialchars($row['image_url'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="download_link">Liên kết tải về:</label>
                <input type="text" class="form-control" id="download_link" name="download_link" value="<?php echo htmlspecialchars($row['download_link'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Cập nhật IPA</button>
            <a href="admin.php" class="btn btn-secondary">Quay lại</a>
        </form>
        
        <?php
        if (isset($redirect_url)) {
            echo "<script>redirectTo('$redirect_url');</script>";
        }
        ?>
    </div>
</body>
</html>
