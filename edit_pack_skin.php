<?php
require_once 'connect.php';

// Bật hiển thị lỗi để kiểm tra
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Lấy ID từ tham số URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Nếu ID không hợp lệ, chuyển hướng về trang admin
if ($id <= 0) {
    header('Location: admin.php');
    exit();
}

// Xử lý yêu cầu cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $alt_text = $_POST['alt_text'];
    $category = $_POST['category'];

    // Cập nhật thông tin pack skin
    $sql = "UPDATE pack_skins SET name=?, description=?, link=?, alt_text=?, category=?, updated_at=NOW() WHERE id=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $name, $description, $link, $alt_text, $category, $id);

    if ($stmt->execute()) {
        // Thông báo thành công và chuyển hướng
        $message = "<div class='alert alert-success'>Cập nhật thành công!</div>";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'admin.php';
            }, 1500); // Chuyển hướng sau 1,5 giây
        </script>";
    } else {
        $message = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
} else {
    // Lấy thông tin hiện tại của pack skin
    $sql = "SELECT * FROM pack_skins WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pack_skin = $result->fetch_assoc();

    if (!$pack_skin) {
        header('Location: admin.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Pack Skin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-4">Chỉnh Sửa Pack Skin</h1>

    <!-- Hiển thị thông báo -->
    <?php if (isset($message)) echo $message; ?>

    <!-- Form chỉnh sửa pack skin -->
    <form method="post" class="mt-3">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($pack_skin['id'], ENT_QUOTES, 'UTF-8'); ?>">
        
        <div class="form-group">
            <label for="name">Tên Pack Skin:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($pack_skin['name'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($pack_skin['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="form-group">
            <label for="link">Liên kết:</label>
            <input type="text" class="form-control" id="link" name="link" value="<?php echo htmlspecialchars($pack_skin['link'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div class="form-group">
            <label for="alt_text">Alt Text:</label>
            <input type="text" class="form-control" id="alt_text" name="alt_text" value="<?php echo htmlspecialchars($pack_skin['alt_text'], ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="form-group">
            <label for="category">Thể loại:</label>
            <select class="form-control" id="category" name="category" required>
                <option value="FULL" <?php echo ($pack_skin['category'] === 'FULL') ? 'selected' : ''; ?>>FULL</option>
                <option value="PACK" <?php echo ($pack_skin['category'] === 'PACK') ? 'selected' : ''; ?>>PACK</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="admin.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
