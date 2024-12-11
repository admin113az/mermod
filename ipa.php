<?php
require_once 'connect.php';

// Lấy thời gian hiện tại
$current_time = new DateTime();

// Khoảng thời gian để xác định IPA mới (ví dụ: 7 ngày)
$new_duration = new DateInterval('P7D');

// Lấy tất cả các IPA từ cơ sở dữ liệu và sắp xếp theo thứ tự từ mới đến cũ
$sql = "SELECT * FROM ipas ORDER BY created_at DESC";
$result = $conn->query($sql);

$ips_no_map = [];
$ips_with_map = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ipa_created_time = new DateTime($row['created_at']);
        $is_new = $ipa_created_time >= $current_time->sub($new_duration); // Kiểm tra nếu IPA mới

        // Thêm thuộc tính is_new vào mỗi phần tử IPA
        $row['is_new'] = $is_new;

        if ($row['map_type'] == 'NO MAP') {
            $ips_no_map[] = $row;
        } else {
            $ips_with_map[] = $row;
        }
    }
}

// Xác định IPA mới nhất cho mỗi loại
$newest_ipa_no_map = isset($ips_no_map[0]) ? $ips_no_map[0] : null;
$newest_ipa_with_map = isset($ips_with_map[0]) ? $ips_with_map[0] : null;
?>



<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPA Liên Quân - HD MOD</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.0.7/css/boxicons.min.css" rel="stylesheet">
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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>List ipa</title>

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/ipa.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
            rel='stylesheet'>
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JS -->
        <script
            src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
        <link rel="shortcut icon" type="logo.png" href="icon/favicon.ico" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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
                            <img src="icon/favicon.ico" alt="Mer Mod">
                        </div></div>

                    <br>

                </div>
                <div class="task-container">
                    <h2><i class='bx bx-down-arrow-alt bx-tada'></i> THEO DÕI
                        CÁC
                        KÊNH CỦA MER MOD <i
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

                <div class="luuyquantrong">
                    <h4 style="color: rgb(21, 92, 92);"><i
                            class='bx bx-error bx-flashing'></i><b
                            class="luuy">ĐỌC VÀ CÂN NHẮC TRƯỚC
                            KHI CÀI </b><i class='bx bx-error bx-flashing'></i>
                    </h4>
                    <p><i class='bx bxs-right-arrow-alt bx-burst'></i> Đã là IPA
                        thì đều có khả năng bị BAN nick cả vì nó là phần
                        mềm thứ ba - không muốn
                        bị ban thì JB máy rồi mod thẳng vào game ở appstore.
                        <br>
                        <br>
                        <i class='bx bxs-right-arrow-alt bx-burst'></i> Tất cả
                        IPA của Hd Mod đều có antiban cả, vậy nên BAN tối
                        đa chỉ 7 ngày thôi (trừ khi mùa mới phiên bản mới gà rán
                        update anticheat thì mới ban 3-10 năm, vậy nên mới cập
                        nhật
                        phiên bản mới cần cân nhắc khi chơi IPA). <br> <br>
                        <i class='bx bxs-right-arrow-alt bx-burst'></i> Cài IPA
                        nào chơi <= 3 ván đã bị ban thì xóa cài ipa khác
                        chơi - còn nếu chơi ipa đó nhiều trận rồi mà bị ban thì
                        do
                        bị tố cáo ban, bị gà quét ban. Lúc đó chỉ cần đợi gà mở
                        nick
                        rồi chơi hoặc cũng có thể đổi IPA khác chơi. <br> <br>
                        <i class='bx bxs-right-arrow-alt bx-burst'></i> Nếu có
                        IPA mới, FILE MOD mới, Game update,... Admin sẽ thông
                        báo ở kênh
                        thông báo. vậy
                        nên phải vào KÊNH THÔNG BÁO để cập nhật thông tin
                        <br></p>
                    <br>
                </div>

                <div class="getkey">
                    <ul><a class="key" href="https://t.me/dart_modd"
                            target="_blank"><i
                                class='bx bx-key bx-tada'></i>NHẤN VÀO ĐÂY, VÀO
                            NHÓM VÀ NHẮN <b>"Key"</b> ĐỂ LẤY KEY VÀO GAME<i
                                class='bx bx-key bx-tada'></i></a></ul> <br>
                    <ul><h3 class="hienmenu">Mọi IPA bên dưới đều có MENU MOD
                            TRONG GAME. Bấm 3 ngón tay 2 lần cùng lúc vào màn
                            hình để MỞ menu</h3></ul>
                </div>
                <div class="ipa-lq">

                    <h2><i
                            class='bx bxs-downvote bx-tada'></i> DANH SÁCH IPA
                        LIÊN QUÂN<i
                            class='bx bxs-downvote bx-tada'></i></h2> <br> <br>

                    <i class='bx bx-badge-check bx-tada' ></i>
        <h3 class="ipaboss">IPA LIÊN QUÂN HỖ TRỢ MOD SKIN & KHÔNG MAP 
            <i class='bx bxs-downvote bx-tada'></i>
        </h3>
        <br> <br>
<?php foreach ($ips_no_map as $ipa): ?>
    <?php
    $created_at = new DateTime($ipa['created_at']);
    ?>
    <div class="ipacon">
        <img class="imgipa" src="<?php echo htmlspecialchars($ipa['image_url']); ?>" alt="ipa hd mod">
        <ul>
            <a href="<?php echo htmlspecialchars($ipa['download_link']); ?>" target="_blank">
                LIÊN QUÂN 
                <p class="newnoi"><?php echo htmlspecialchars($ipa['map_type']); ?></p> 
                HỖ TRỢ MOD SKIN 
                <b><?php echo htmlspecialchars($ipa['version']); ?></b> 
                <!-- Định dạng thêm giờ phút theo 24 giờ -->
                <?php echo htmlspecialchars($created_at->format('d/m/Y H:i')); ?>
                <i class='bx bx-badge-check bx-burst' ></i>
            </a>
        </ul>
    </div>
<?php endforeach; ?>

<br>
<i class='bx bxs-chevron-right-circle bx-flashing'></i>
<h3 class="ipaboss">IPA LIÊN QUÂN HỖ TRỢ MOD SKIN & CÓ MAP 
    <i class='bx bxs-downvote bx-tada'></i>
</h3>
<br> <br>
<?php foreach ($ips_with_map as $ipa): ?>
    <?php
    $created_at = new DateTime($ipa['created_at']);
    ?>
    <div class="ipacon">
        <img class="imgipa" src="<?php echo htmlspecialchars($ipa['image_url']); ?>" alt="ipa hd mod">
        <ul>
            <a href="<?php echo htmlspecialchars($ipa['download_link']); ?>" target="_blank">
                LIÊN QUÂN 
                <p class="newnoi"><?php echo htmlspecialchars($ipa['map_type']); ?></p> 
                HỖ TRỢ MOD SKIN 
                <b><?php echo htmlspecialchars($ipa['version']); ?></b> 
                <!-- Định dạng thêm giờ phút theo 24 giờ -->
                <?php echo htmlspecialchars($created_at->format('d/m/Y H:i')); ?>
                <i class='bx bx-badge-check bx-burst' ></i>
            </a>
        </ul>
    </div>
<?php endforeach; ?>




        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.querySelectorAll('.link').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'LƯU Ý',
                        text: 'Bản này chỉ chơi để trải nghiệm cho biết AIM LÀ NHƯ THẾ NÀO THÔI !! bởi vì khá nhiều lỗi, NÓ KHÔNG NHƯ AE NGHĨ ĐÂU. KHÔNG NÊN CHƠI NAK, ENZO,...',
                        icon: 'error',
                        confirmButtonText: 'OK DỨT'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open(this.href, '_blank');
                        }
                    });
                });
            });
        </script>
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
                                    href="https://www.youtube.com/@mer_mod">Mer Mod</a></div>
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
