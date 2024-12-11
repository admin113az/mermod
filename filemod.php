<?php
require_once 'connect.php';

// Bật hiển thị lỗi để kiểm tra
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Lấy dữ liệu phân loại từ cơ sở dữ liệu
$fullMods = [];
$packs = [];

// Truy vấn để lấy dữ liệu từ bảng pack_skins
$sql = "SELECT * FROM pack_skins ORDER BY created_at DESC";
$result = $conn->query($sql);

// Truy vấn để lấy dữ liệu từ bảng updates
$sqlUpdates = "SELECT update_date FROM updates ORDER BY update_date DESC LIMIT 1";
$resultUpdates = $conn->query($sqlUpdates);

$latestUpdateDate = ''; // Khởi tạo biến để lưu giá trị update_date

if ($resultUpdates && $resultUpdates->num_rows > 0) {
    $rowUpdate = $resultUpdates->fetch_assoc();
    $latestUpdateDate = $rowUpdate['update_date'];
} else {
    $latestUpdateDate = 'Không có dữ liệu cập nhật'; // Giá trị mặc định nếu không tìm thấy kết quả
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (isset($row['category'])) {
            if ($row['category'] === 'FULL') {
                $fullMods[] = $row;
            } elseif ($row['category'] === 'PACK') {
                $packs[] = $row;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Pack Mod</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css">
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>File Mod</title>
        <script async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4462169601041682"
            crossorigin="anonymous"></script>
        <!-- Google tag (gtag.js) -->
        <script async
            src="https://www.googletagmanager.com/gtag/js?id=G-0PXQB335HV"></script>
        <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0PXQB335HV');
</script>
        <link rel="stylesheet" href="css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
            rel='stylesheet'>
        <link rel="shortcut icon" type="logo.png" href="favicon.ico" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link rel="stylesheet" href="css/filemod.css">
   
</head>
<body>
<div class="container">
            <div class="header">
                <div class="menu-icon" id="hamburger">
                    <div class="hamburger">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <img class="logo" src="icon/dart.png" />
                <div class="header-menu" id="header-menu">
          <a href="index.php">Mua Chứng Chỉ</a>
                <a href="muakey.php" style="color: #056674;">Mua Key IPA</a>
                <a href="esign.php">Esign + DNS</a>
                <a href="ipa.php" style="color: #03AED2;">List IPA</a>
                <a href="filemod.php" style="color: #059212;">List Pack Mod</a>
                <a href="findmod.php" style="color: #C7253E;">List Mod Lẻ</a>
                <a href="modche.php" style="color: #050C9C;">List Mod Chế</a>
            </div><br>
            </div>

            <div class="cont">

                <div class="nd">
                    <div data-aos="flip-right"><div class="image-frame">
                            <img src="icon/favicon.ico" alt="Hd Mod">
                        </div></div>

                    <br>

                </div>
                <div class="task-container">
                    <h2><i class='bx bx-down-arrow-alt bx-tada'></i> THEO DÕI
                        CÁC
                        KÊNH CỦA Mer Mod <i
                            class='bx bx-down-arrow-alt bx-tada'></i></h2>
                  <ul>
                        <li><a href="https://www.facebook.com/BQD81"
                                target="_blank"><i
                                    class='bx bxl-meta bx-tada'></i>Facebook
                               Chính Chủ Mer Mod</a></li>
                        <li><a
                                href="https://www.youtube.com/@mer-mod?sub_confirmation=1"
                                target="_blank"><i
                                    class='bx bxl-youtube bx-tada'></i>YTB Mer Mod</a></li>
                        <li><a href="https://t.me/dart_mod" target="_blank"><i
                                    class='bx bx-bell bx-tada'></i>Kênh
                                thông báo Mer Mod</a></li>
                        <li><a href="https://t.me/dart_modd" target="_blank"><i
                                    class='bx bx-message-alt-dots bx-tada'></i>Kênh
                                chat AE Mer Mod</a></li>
                    </ul>
                </div> <br>

                <br>

                <div class="filemod">
                    <h2><i class='bx bxs-downvote bx-tada'></i> LƯU Ý TRƯỚC KHI
                        MOD SKIN <i
                            class='bx bxs-downvote bx-tada'></i></h2>
                    <h4>- Hướng dẫn dán MOD bên Hd Mod (Dán phát 1 & Dán bằng
                        Menu) : <a
                            href="https://youtu.be/p1Yq7RWhth4?si=CroH8IjuntL93g_p"
                            target="_blank"
                            rel="noopener noreferrer">Nhấp Vào Đây để xem hướng
                            dẫn</a></h4> <br>

                    <h3><i class='bx bx-timer bx-tada'></i> FILE MOD BÊN DƯỚI ĐƯỢC CẬP NHẬT KHI GAME UPDATE NGÀY <b class="new"><?php echo htmlspecialchars($latestUpdateDate); ?></b> !!! <i class='bx bx-timer bx-tada'></i></h3><br>


                    <h3>- NHỚ XÓA MOD, VÀO GAME LOAD TỚI SẢNH RỒI HÃY RA MOD
                        NHÉ, CHỨ BỊ TRẬN ẢO LỖI MẠNG VĂNG GAME ĐÓ. KHÔNG BIẾT
                        CÁCH XÓA MOD THÌ VÀO GROUP CHAT GÕ <b>"xóa mod"</b> LÀ
                        CÓ VIDEO
                        CHỈ.</h3> <br><br>

    <div class="dsfilemod">
        <div class="banmod">
            <h2 class="tieudebanmod">
                <i class='bx bx-joystick bx-tada'></i> 
                Bạn có nhu cầu LÀM PACK MOD theo yêu cầu? 
                <i class='bx bx-check bx-burst'></i> 
                Liên hệ AD để mua <a href="https://t.me/iamthit" target="_blank">tại đây</a>
            </h2>
        </div>

        <br>
       <!-- Danh sách Full Mod -->
    <h3 class="mod">
        <i class='bx bxs-downvote bx-tada'></i> FULL MOD <i class='bx bxs-downvote bx-tada'></i>
    </h3>
    <br>
    <ul>
        <?php foreach ($fullMods as $mod): ?>
            <li>
                <a href="<?php echo htmlspecialchars($mod['link'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" target="_blank">
                    <?php echo htmlspecialchars($mod['name'] ?? 'Chưa có tên', ENT_QUOTES, 'UTF-8'); ?> 
                    
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <br>

    <!-- Danh sách Pack Skin -->
    <h3 class="mod">
        <i class='bx bxs-downvote bx-tada'></i> PACK SKIN <i class='bx bxs-downvote bx-tada'></i>
    </h3>
    <br>
    <ul>
        <?php foreach ($packs as $pack): ?>
            <li>
                <a href="<?php echo htmlspecialchars($pack['link'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" target="_blank">
                    <?php echo htmlspecialchars($pack['name'] ?? 'Chưa có tên', ENT_QUOTES, 'UTF-8'); ?> 
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</div>
</div>

<div class="main"></div>
           <div class="footer">
                    <div class="bubbles">
                    </div>
                    <div class="content">
                        <div>
                            <div><b>Facebook :</b><a
                                    href="https://www.facebook.com/BQD81">Mer Mod</a></div>
                            
                            <div><b>Telegram:</b><a
                                    href="https://t.me/iamthit">Datt</a></div>
                            <div><b>Youtube :</b><a
                                    href="https://www.youtube.com/@Hd_Mod">Mer Mod</a></div>
                        </div>
                        <div><a class="image" href="#"
                                style="background-image: url(&quot;https://s3-us-west-2.amazonaws.com/s.cdpn.io/199011/happy.svg&quot;)"></a>
                            <p>©2024 Mer Mod</p>
                        </div>
                    </div>
                </div>
            <svg style="position:fixed; top:100vh">
                <defs>
                    <filter id="blob">
                        <fegaussianblur in="SourceGraphic" stdDeviation="10"
                            result="blur"></fegaussianblur>
                        <fecolormatrix in="blur" mode="matrix"
                            values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9"
                            result="blob"></fecolormatrix>
                    </filter>
                </defs>
            </svg>
            <script>





		const hamburger = document.getElementById('hamburger');
		const menu = document.getElementById('header-menu');

		hamburger.addEventListener('click', () => {
			menu.classList.toggle('active');
		});




		document.addEventListener("DOMContentLoaded", function() {
			const elements = document.querySelectorAll('.new');

			function getRandomColor() {
				const letters = '0123456789ABCDEF';
				let color = '#';
				for (let i = 0; i < 6; i++) {
				color += letters[Math.floor(Math.random() * 16)];
				}
				return color;
			}

			function getContrastColor(bgColor) {
				const brightness = (
				parseInt(bgColor.slice(1, 3), 16) * 299 +
				parseInt(bgColor.slice(3, 5), 16) * 587 +
				parseInt(bgColor.slice(5, 7), 16) * 114
				) / 1000;

				return brightness >= 128 ? '#000000' : '#FFFFFF';
			}

			function changeColor(element) {
				const bgColor = getRandomColor();
				const textColor = getContrastColor(bgColor);

				element.style.backgroundColor = bgColor;
				element.style.color = textColor;
			}

			elements.forEach(function(element) {
				setInterval(function() {
				changeColor(element);
				}, 2000); 
			});
		});


	</script>
            <script>
  AOS.init();
</script>
    </div>
    
</body>
</html>
