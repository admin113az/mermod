<?php
require_once 'connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Bật hiển thị lỗi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$message = '';

// Xử lý các yêu cầu thêm, sửa, xóa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : null;
    $table = isset($_POST['table']) ? $_POST['table'] : null;
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;

         // Xử lý yêu cầu xóa tất cả skins nếu nút Xóa tất cả được nhấn
if (isset($_POST['delete_all_skins'])) {
    $sql_delete_all = "DELETE FROM skins";
    if ($conn->query($sql_delete_all) === TRUE) {
        $message = "<div class='alert alert-success'>Đã xóa tất cả skins thành công!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Lỗi: Không thể xóa tất cả skins.</div>";
    }
}

    if ($action === 'add') {
        // Xử lý thêm dữ liệu cho bảng mod_che
        if ($table === 'mod_che') {
            $title = $_POST['title'];
            $image_url = $_POST['video_url'];
            $link = $_POST['link'];
            $alt_text = $_POST['alt_text'];
            $description = $_POST['description'];

            $sql_check = "SELECT COUNT(*) FROM mod_che WHERE title = ? AND link = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("ss", $title, $link);
            $stmt_check->execute();
            $stmt_check->bind_result($count);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($count == 0) {
                $sql = "INSERT INTO mod_che (title, video_url, link, alt_text, description, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $title, $image_url, $link, $alt_text, $description);
                $stmt->execute();
                $message = "<div class='alert alert-success'>Thao tác thành công!</div>";
                $stmt->close();
            } else {
                $message = "<div class='alert alert-warning'>Skin đã tồn tại.</div>";
            }
        }

        // Xử lý thêm dữ liệu cho bảng skins
        elseif ($table === 'skins') {
            $title = $_POST['title'];
            $image_url = $_POST['image_url'];
            $link = $_POST['link'];
            $alt_text = $_POST['alt_text'];
            $description = $_POST['description'];

            $sql_check = "SELECT COUNT(*) FROM skins WHERE title = ? AND link = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("ss", $title, $link);
            $stmt_check->execute();
            $stmt_check->bind_result($count);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($count == 0) {
                $sql = "INSERT INTO skins (title, image_url, link, alt_text, description, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $title, $image_url, $link, $alt_text, $description);
                $stmt->execute();
                $message = "<div class='alert alert-success'>Thao tác thành công!</div>";
                $stmt->close();
            } else {
                $message = "<div class='alert alert-warning'>Skin đã tồn tại.</div>";
            }
        }



        // Xử lý thêm dữ liệu cho bảng pack_skins
        elseif ($table === 'pack_skins') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $link = $_POST['link'];
            $alt_text = $_POST['alt_text'];
            $category = $_POST['category'];

            $sql_check = "SELECT COUNT(*) FROM pack_skins WHERE name = ? AND link = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("ss", $name, $link);
            $stmt_check->execute();
            $stmt_check->bind_result($count);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($count == 0) {
                $sql = "INSERT INTO pack_skins (name, link, alt_text, description, created_at, category) VALUES (?, ?, ?, ?, NOW(), ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $name, $link, $alt_text, $description, $category);
                $stmt->execute();
                $message = "<div class='alert alert-success'>Thao tác thành công!</div>";
                $stmt->close();
            } else {
                $message = "<div class='alert alert-warning'>Pack skin đã tồn tại.</div>";
            }
        }

        // Xử lý thêm dữ liệu cho bảng ipas
        elseif ($table === 'ipas') {
            $version = $_POST['version'];
            $image_url = $_POST['image_url'];
            $download_link = $_POST['download_link'];
            $map_type = $_POST['map_type'];

            $sql_check = "SELECT COUNT(*) FROM ipas WHERE version = ? AND download_link = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("ss", $version, $download_link);
            $stmt_check->execute();
            $stmt_check->bind_result($count);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($count == 0) {
                $sql = "INSERT INTO ipas (version, image_url, download_link, created_at, map_type) VALUES (?, ?, ?, NOW(), ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $version, $image_url, $download_link, $map_type);
                $stmt->execute();
                $message = "<div class='alert alert-success'>Thao tác thành công!</div>";
                $stmt->close();
            } else {
                $message = "<div class='alert alert-warning'>IPA đã tồn tại.</div>";
            }
        }

        // Xử lý thêm dữ liệu cho bảng updates
        elseif ($table === 'updates') {
            $update_date = $_POST['update_date'];

            $sql_check = "SELECT COUNT(*) FROM updates WHERE update_date = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("s", $update_date);
            $stmt_check->execute();
            $stmt_check->bind_result($count);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($count == 0) {
                $sql = "INSERT INTO updates (update_date) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $update_date);
                $stmt->execute();
                $message = "<div class='alert alert-success'>Thêm thành công!</div>";
                $stmt->close();
            } else {
                $message = "<div class='alert alert-warning'>Bản cập nhật đã tồn tại.</div>";
            }
        }
    } 

    // Xử lý xóa dữ liệu
    elseif ($action === 'delete') {
        if ($id > 0) {
            $sql = "DELETE FROM $table WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $message = "<div class='alert alert-success'>Xóa thành công!</div>";
            } else {
                $message = "<div class='alert alert-danger'>Lỗi: " . htmlspecialchars($conn->error) . "</div>";
            }
            $stmt->close();
        } else {
            $message = "<div class='alert alert-danger'>ID không hợp lệ.</div>";
        }
    }
}

// Lấy danh sách dữ liệu
$skins = $conn->query("SELECT * FROM skins ORDER BY created_at DESC");
$pack_skins = $conn->query("SELECT * FROM pack_skins ORDER BY created_at DESC");
$ipas = $conn->query("SELECT * FROM ipas ORDER BY created_at DESC");
$mod_che = $conn->query("SELECT * FROM mod_che ORDER BY created_at DESC");
$updates = $conn->query("SELECT * FROM updates ORDER BY update_date DESC");

?>



<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Lý Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .btn.btn-danger.logout-button {
            margin-bottom: 20px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Quản Lý Admin</h1>
        <a href="logout.php" class="btn btn-danger logout-button">Logout</a>

        <!-- Hiển thị thông báo -->
        <?php if (isset($message)) echo $message; ?>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="skins-tab" data-toggle="tab" href="#skins" role="tab" aria-controls="skins" aria-selected="true">Danh sách skins lẻ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pack_skins-tab" data-toggle="tab" href="#pack_skins" role="tab" aria-controls="pack_skins" aria-selected="false">Danh sách Pack Skins</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ipas-tab" data-toggle="tab" href="#ipas" role="tab" aria-controls="ipas" aria-selected="false">Danh sách IPAs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="skinche-tab" data-toggle="tab" href="#skinche" role="tab" aria-controls="skinche" aria-selected="false">Danh sách skins chế</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Cập nhật ngày Update</a>
            </li>
           
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">

            
            

            <!-- Skins Tab -->
            <div class="tab-pane fade show active" id="skins" role="tabpanel" aria-labelledby="skins-tab">
                <h3 class="mt-4">Danh sách Skins Lẻ</h3>

                

<form id="deleteForm" method="post" style="display:none;">
    <input type="hidden" name="delete_all_skins" value="1">
</form>

<button type="button" class="btn btn-danger" onclick="confirmDeleteAll()">Xóa tất cả skins</button>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDeleteAll() {
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Thao tác này sẽ xóa tất cả skins!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Xóa tất cả',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form nếu xác nhận xóa
                document.getElementById('deleteForm').submit();
            }
        });
    }
</script>


                <!-- Form thêm skin mới -->
                <form method="post" class="mt-3 mb-5">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="table" value="skins">
                    <div class="form-group">
                        <label for="title">Tiêu đề:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="image_url">URL Hình ảnh:</label>
                        <input type="text" class="form-control" id="image_url" name="image_url" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Liên kết:</label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                    <div class="form-group">
                        <label for="alt_text">Alt Text:</label>
                        <input type="text" class="form-control" id="alt_text" name="alt_text">
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm Skin lẻ</button>
                </form>

                <!-- Danh sách skins -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>URL Hình ảnh</th>
                            <th>Liên kết</th>
                            <th>Alt Text</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($skins->num_rows > 0): ?>
                            <?php while ($row = $skins->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><?php echo htmlspecialchars($row['image_url']); ?></td>
                                    <td><?php echo htmlspecialchars($row['link']); ?></td>
                                    <td><?php echo htmlspecialchars($row['alt_text']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    <td>
                                        <!-- Sửa -->
                                        <a href="edit_skin.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Sửa</a>
                                        <!-- Xóa -->
                                        <form method="post" style="display:inline;" action="admin.php">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="table" value="skins">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Chưa có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pack Skins Tab -->
            <div class="tab-pane fade" id="pack_skins" role="tabpanel" aria-labelledby="pack_skins-tab">
                <h3 class="mt-4">Danh sách Pack Skins</h3>
                <!-- Form thêm pack skin mới -->
                <form method="post" class="mt-3 mb-5">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="table" value="pack_skins">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Liên kết:</label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                    <div class="form-group">
                        <label for="alt_text">Alt Text:</label>
                        <input type="text" class="form-control" id="alt_text" name="alt_text">
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Danh mục:</label>
                        <input type="text" class="form-control" id="category" name="category">
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm Pack Skin</button>
                </form>

                <!-- Danh sách pack skins -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Liên kết</th>
                            <th>Alt Text</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th>Danh mục</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($pack_skins->num_rows > 0): ?>
                            <?php while ($row = $pack_skins->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['link']); ?></td>
                                    <td><?php echo htmlspecialchars($row['alt_text']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                                    <td>
                                        <!-- Sửa -->
                                        <a href="edit_pack_skin.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Sửa</a>
                                        <!-- Xóa -->
                                        <form method="post" style="display:inline;" action="admin.php">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="table" value="pack_skins">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Chưa có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- IPAs Tab -->
            <div class="tab-pane fade" id="ipas" role="tabpanel" aria-labelledby="ipas-tab">
                <h3 class="mt-4">Danh sách IPAs</h3>
                <!-- Form thêm IPA mới -->
                <form method="post" class="mt-3 mb-5">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="table" value="ipas">
                    <div class="form-group">
                        <label for="version">Phiên bản:</label>
                        <input type="text" class="form-control" id="version" name="version" required>
                    </div>
                    <div class="form-group">
                        <label for="image_url">URL Hình ảnh:</label>
                        <input type="text" class="form-control" id="image_url" name="image_url" required>
                    </div>
                    <div class="form-group">
                        <label for="download_link">Liên kết tải xuống:</label>
                        <input type="text" class="form-control" id="download_link" name="download_link" required>
                    </div>
                    <div class="form-group">
    <label for="map_type">Thể loại bản đồ:</label>
    <select class="form-control" id="map_type" name="map_type" required>
        <option value="NO MAP" <?php echo (isset($row['map_type']) && $row['map_type'] == 'NO MAP') ? 'selected' : ''; ?>>Không Map</option>
        <option value="CÓ MAP" <?php echo (isset($row['map_type']) && $row['map_type'] == 'CÓ MAP') ? 'selected' : ''; ?>>Có Map</option>
    </select>
</div>

                    <button type="submit" class="btn btn-primary">Thêm IPA</button>
                </form>

                <!-- Danh sách IPAs -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phiên bản</th>
                            <th>URL Hình ảnh</th>
                            <th>Liên kết tải xuống</th>
                            <th>Loại bản đồ</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($ipas->num_rows > 0): ?>
                            <?php while ($row = $ipas->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['version']); ?></td>
                                    <td><?php echo htmlspecialchars($row['image_url']); ?></td>
                                    <td><?php echo htmlspecialchars($row['download_link']); ?></td>
                                    <td><?php echo htmlspecialchars($row['map_type']); ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    <td>
                                        <!-- Sửa -->
                                        <a href="edit_ipa.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Sửa</a>
                                        <!-- Xóa -->
                                        <form method="post" style="display:inline;" action="admin.php">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="table" value="ipas">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Chưa có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
<!-- skin chế -->
<div class="tab-pane fade" id="skinche" role="tabpanel" aria-labelledby="skinche-tab">
                <h2>Danh sách Skins Chế</h2>
                <!-- Form thêm skin mới -->
                <form method="post" class="mt-3 mb-5">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="table" value="mod_che">
                    <div class="form-group">
                        <label for="title">Tiêu đề:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="video_url">URL Hình ảnh:</label>
                        <input type="text" class="form-control" id="video_url" name="video_url" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Liên kết:</label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                    <div class="form-group">
                        <label for="alt_text">Alt Text:</label>
                        <input type="text" class="form-control" id="alt_text" name="alt_text">
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm Skin chế</button>
                </form>

                <!-- Danh sách skins -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>URL Hình ảnh</th>
                            <th>Liên kết</th>
                            <th>Alt Text</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($mod_che->num_rows > 0): ?>
                            <?php while ($row = $mod_che->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><?php echo htmlspecialchars($row['video_url']); ?></td>
                                    <td><?php echo htmlspecialchars($row['link']); ?></td>
                                    <td><?php echo htmlspecialchars($row['alt_text']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    <td>
                                        <!-- Sửa -->
                                        <a href="edit_skinche.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Sửa</a>
                                        <!-- Xóa -->
                                        <form method="post" style="display:inline;" action="admin.php">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="table" value="mod_che">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Chưa có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>  
</div>

<div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
                <h2>Cập nhật ngày update</h2>
                <!-- Form thêm ngày update -->
                <form method="post" class="mt-3 mb-5">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="table" value="updates">
                    <div class="form-group">
                        <label for="update_date">Ngày update:</label>
                        <input type="text" class="form-control" id="update_date" name="update_date" required>
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Thêm Ngày UPDATE</button>
                </form>

                <!-- Danh sách skins -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mô Tả</th>
                            <th>ngày update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($updates->num_rows > 0): ?>
                            <?php while ($row = $updates->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td><?php echo htmlspecialchars($row['update_date']); ?></td>
                                    <td>
                                        <!-- Sửa -->
                                        <a href="edit_update.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Sửa</a>
                                        <!-- Xóa -->
                                        <form method="post" style="display:inline;" action="admin.php">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="table" value="updates">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Chưa có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
</div>


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>