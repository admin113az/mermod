<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mua Key IPA Liên Quân</title>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4462169601041682" crossorigin="anonymous"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0PXQB335HV"></script>

    <!-- Font và Boxicons -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" type="image/png" href="favicon.ico" />
    <!-- CSS cho giao diện -->

    <!-- Thêm SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Thêm SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <!-- Thêm thư viện QRCode.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <!-- Thêm SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
       
       h1 {
    text-align: center;
    color: #007bff;
    margin-bottom: 20px;
}

.key-package h2 {
    text-align: center;
    margin-bottom: 10px;
    color: #333;
}

input[type="number"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 16px;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background-color: #0056b3;
}

#totalPrice {
    margin-top: 15px;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
}

.discount-note {
    margin-top: 20px;
    background-color: #CCE0AC;
    padding: 15px;
    border-radius: 15px;
    font-size: 14px;
}

.discount-note p {
    font-weight: bold;
    margin-bottom: 10px;
}

.discount-note ul {
    list-style: disc;
    margin-left: 20px;
}

.payment-section {
    margin-top: 20px;
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 5px;
    display: none;
}

.payment-methods h4 {
    margin-bottom: 10px;
}

.payment-methods ul {
    list-style: none;
    padding: 0;
}

.payment-methods li {
    margin-bottom: 20px;
    text-align: center; /* Căn giữa thông tin thanh toán */
}

.qr-code {
    width: 400px; 
    height: 400px; 
    margin-top: 10px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

#paymentTotal {
    color: #C62E2E;
}

.message-section {
    margin-top: 20px;
    padding: 15px;
    background-color: #d1ecf1;
    color: #0c5460;
    border-radius: 5px;
    display: none;
    text-align: center;
}

h4 {
    color: #A02334;
}

ul li {
    list-style: none;
    font-size : 18px;
    padding : 5px;
}

.tt {
    color:#059212;
    font-size: 28px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 800;
}

    </style>
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

        <br>

        <h1 class="tieudemuakey">Mua Key IPA Liên Quân</h1> <br> 
        <div class="key-package">
            <h2>Nhập số ngày muốn mua</h2>
            <form id="packageForm">
                <input type="number" id="daysInput" name="days" min="1" placeholder="Nhập số ngày" required>
                <p id="totalPrice"></p>
                <button type="button" id="buyNowBtn">Mua Ngay</button>
            </form>

            <!-- Ghi chú giảm giá -->
            <div class="discount-note">
                <p><strong>- Lưu ý về giảm giá:</strong></p>
                <ul>
                    <li>Mua dưới 14 ngày -> 3.000 VNĐ/ngày</li>
                    <li>Mua trên 14 ngày -> chỉ còn 2.000 VNĐ/Ngày</li>
                    <li>Mua trên 60 ngày -> chỉ còn 1.500 VNĐ/Ngày</li>
                    <p>- Hiện tại vượt link hơi khó khăn, vậy nên mua key là giải pháp tốt nhất. 1 key có thể dùng 2 bản (nếu 1 máy dùng 1 bản thì bạn có thể dùng 2 máy 1 key vẫn được) vậy nên ae có thể share cho bạn bè chơi chung</p>
                    <p>- Ngoài ra khi mua key sẽ được ad hỗ trợ lấy file mod, ipa mà không cần vượt link (mua > 1 tháng mới hỗ trợ)</p>
                </ul>
            </div>

            <!-- Thông tin thanh toán -->
            <div id="paymentSection" class="payment-section" style="display: none;">
                <h3>Thông tin thanh toán</h3>
                
                <!-- Phương thức thanh toán -->
                <div class="payment-methods">
                    <h4>Chọn phương thức thanh toán</h4>
                    <ul>
                        <li>
                            <strong>MoMo:</strong> 0363628622 (Tên tài khoản: Bùi Quốc Đạt)
                            <br>
                            <img src="images/qr_momo.png" alt="QR MoMo" class="qr-code">
                        </li>
                        <li>
                            <strong>Ngân hàng Vietcombank:</strong> Số tài khoản: 9363628622 (Tên tài khoản: BUI QUOC DAT)
                            <br>
                            <img src="images/qr_bank.png" alt="QR Banking" class="qr-code">
                        </li>
                    </ul>
                </div>

                <p class="tt">Tổng tiền: <span id="paymentTotal"></span> VND</p>
                
                <button type="button" id="confirmPaymentBtn">Xác nhận đã chuyển tiền</button> <br>
            </div>

            <!-- Thông báo -->
            <div id="messageSection" class="message-section" style="display: none;">
                <p>Vui lòng nhấn vào -> <a href="https://t.me/iamthit" target="_blank"> @iamthit và ib admin</a> để nhận key. Nếu chưa thấy ad rep thì ad đang bận, sẽ rep trong ngày, mong ae thông cảm</p>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const daysInput = document.getElementById("daysInput");
        const totalPriceDisplay = document.getElementById("totalPrice");
        const buyNowBtn = document.getElementById("buyNowBtn");
        const paymentSection = document.getElementById("paymentSection");
        const paymentTotal = document.getElementById("paymentTotal");
        const confirmPaymentBtn = document.getElementById("confirmPaymentBtn");
        const messageSection = document.getElementById("messageSection");
        const pricePerDay = 3000;

        // Tính tổng giá khi người dùng nhập số ngày
        daysInput.addEventListener("input", function () {
    const days = parseInt(daysInput.value) || 0; // Nếu không có giá trị thì mặc định là 0
    let pricePerDay;

    if (days > 59) {
        pricePerDay = 1500; // 1.500 VND/ngày nếu mua trên 60 ngày
    } else if (days > 13) {
        pricePerDay = 2000; // 2.000 VND/ngày nếu mua trên 14 ngày
    } else {
        pricePerDay = 3000; // Giá gốc 3.000 VND/ngày
    }

    // Tính tổng giá không cần giảm giá
    const totalPrice = days * pricePerDay;
    totalPriceDisplay.textContent = "Tổng Tiền: " + totalPrice.toLocaleString('vi-VN') + " VND";
});


        // Hiển thị thông tin thanh toán khi nhấn "Mua Ngay"
       // Hiển thị thông tin thanh toán khi nhấn "Mua Ngay"
buyNowBtn.addEventListener("click", function () {
    const days = parseInt(daysInput.value) || 0; // Nếu không có giá trị thì mặc định là 0

    // Kiểm tra số ngày hợp lệ
    if (days <= 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Thông báo',
            text: 'Vui lòng nhập số ngày lớn hơn 0.',
        });
        return; // Dừng hàm nếu số ngày không hợp lệ
    }

    let pricePerDay;

    if (days > 59) {
        pricePerDay = 1500; // 1.500 VND/ngày nếu mua trên 60 ngày
    } else if (days > 13) {
        pricePerDay = 2000; // 2.000 VND/ngày nếu mua trên 14 ngày
    } else {
        pricePerDay = 3000; // Giá gốc 3.000 VND/ngày
    }

    // Tính tổng giá dựa trên giá mỗi ngày đã điều chỉnh
    const totalPrice = days * pricePerDay;
    paymentTotal.textContent = totalPrice.toLocaleString('vi-VN') + " VND";
    paymentSection.style.display = "block";
});


        // Hiển thị thông báo khi nhấn "Xác nhận đã chuyển tiền"
        confirmPaymentBtn.addEventListener("click", function () {
            Swal.fire({
                icon: 'info',
                title: 'Thông báo',
                text: 'nhấn vào @iamthit và nhắn cho ad để nhận key. Nếu chưa thấy ad rep thì ad đang bận, sẽ rep trong ngày, mong ae thông cảm',
            });
            paymentSection.style.display = "none";
            messageSection.style.display = "block";
        });
    });
</script>


</body>

</html>