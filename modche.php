<?php
// findmod.php

require_once 'connect.php';

$sql = "SELECT * FROM mod_che ORDER BY created_at DESC";
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List skins chế - HD MOD</title>
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
        <link rel="stylesheet" href="css/findmod.css">
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

            <div class="luuy">
                <h2><i class='bx bxs-right-arrow-alt bx-tada'></i> Những bản mod
                    chế này được upload sau khi liên quân UPDATE NGÀY
                    <b class="new"><?php echo htmlspecialchars($latestUpdateDate); ?></b> </h2> <br>
                    <h2><i class='bx bxs-right-arrow-alt bx-tada'></i>AE nào thích thì có thể tải về và trải nghiệm để biết hiệu ứng</h2>
                <br><h3><i class='bx bx-chevron-right bx-tada'></i>Tất cả các
                    file mod lẻ đều phải dán theo cách "dán từng file" hoặc zip resource lại trỏ bằng menuhoặc zip resource lại trỏ bằng menu !!! Ai
                    chưa biết thì vào nhóm chat gõ "dán từng file" <br> <br> <a
                        href="https://t.me/dart_modd" target="_blank">Nhấp vào
                        đây để vào nhóm</a></h3>
                <br><h3><i class='bx bxs-right-arrow-alt bx-tada'></i> Ad sẽ
                    update skin chế (nếu có) lên web này, vậy nên lâu lâu AE có
                    thể vào link này check <i
                        class='bx bx-badge-check bx-tada'></i></h3> <br>
            </div>

            <div class="search-bar">
                <input type="text" id="search-input"
                    placeholder="Nhập tên tướng cần tìm ..."
                    oninput="searchHeroes()">
                <div class="search-icon" onclick="searchHeroes()">
                    <i class='bx bx-search'></i>
                </div>
            </div>

           <div class="st-heroes__list">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <a href="<?php echo $row['link']; ?>" target="_blank" class="st-heroes__item">
                    <div class="st-heroes__item--img">
                        <img src="<?php echo $row['video_url']; ?>" alt="<?php echo $row['alt_text']; ?>">
                    </div>
                    <h2 class="st-heroes__item--name">
                        <?php echo $row['title']; ?>
                    </h2>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Chưa có skin chế nào được upload lên web !! vui lòng đợi admin upload</p>
        <?php endif; ?>
    </div>
    </div>


<script>

            const hamburger = document.getElementById('hamburger');
		const menu = document.getElementById('header-menu');

		hamburger.addEventListener('click', () => {
			menu.classList.toggle('active');
		});

        
    document.addEventListener('DOMContentLoaded', function() {
        const heroes = document.querySelectorAll('.st-heroes__item');
        const searchInput = document.getElementById('search-input');
        const searchIcon = document.querySelector('.search-icon');

        function searchHeroes() {
            const query = searchInput.value.toLowerCase();
            heroes.forEach(hero => {
                const name = hero.querySelector('.st-heroes__item--name').textContent.toLowerCase();
                if (name.includes(query)) {
                    hero.style.display = 'block'; // Hiển thị các thẻ a khi tìm thấy
                } else {
                    hero.style.display = 'none'; // Ẩn các thẻ a không phù hợp
                }
            });
        }

        // Đặt giá trị mặc định
        searchInput.value = '';
        searchHeroes(); // Hiển thị tất cả khi trang tải

        searchInput.addEventListener('input', searchHeroes);
        searchIcon.addEventListener('click', searchHeroes);
        
    });
</script>

        <script>
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



</body>
</html>

<?php
$conn->close();
?>
