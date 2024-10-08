<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/view/css/ThongTinCaNhan.css">
</head>
<body>

    <?php require_once 'D:/Code/quanly_diem/view/shared/top-bar.php'; ?>
    <?php require_once 'D:/Code/quanly_diem/view/shared/menu.php'; ?>

    <div class="container">
        <h2>Thông tin học sinh</h2>
        <div class="info-container">
            <div class="info-left">
                <div class="info-item">
                    <label for="ma_hs">Mã Học sinh:</label>
                    <span id="ma_hs"><?php echo $hsInfo['maHS']; ?></span>
                </div>
                <div class="info-item">
                    <label for="ho_ten">Họ tên:</label>
                    <span id="ho_ten"><?php echo $hsInfo['hoTen']; ?></span>
                </div>
                <div class="info-item">
                    <label for="gioi_tinh">Giới tính:</label>
                    <span id="gioi_tinh"><?php echo $hsInfo['gioiTinh']; ?></span>
                </div>
                <div class="info-item">
                    <label for="noi_sinh">Ngày sinh:</label>
                    <span id="noi_sinh"><?php echo $hsInfo['ngaySinh']; ?></span>
                </div>
                <div class="info-item">
                    <label for="noi_sinh">Nơi sinh:</label>
                    <span id="noi_sinh"><?php echo $hsInfo['noiSinh']; ?></span>
                </div>
                <div class="info-item">
                    <label for="so_dien_thoai">Số điện thoại:</label>
                    <span id="so_dien_thoai"><?php echo $hsInfo['soDT']; ?></span>
                </div>
            </div>
            <div class="info-right">
                <div class="info-item">
                    <label for="nam_nhap_hoc">Năm nhập học:</label>
                    <span id="nam_nhap_hoc"><?php echo $hsInfo['namNhapHoc']; ?></span>
                </div>
                <div class="info-item">
                    <label for="ma_lop">Mã lớp:</label>
                    <span id="ma_lop"><?php echo $hsInfo['maLop']; ?></span>
                </div>
                <div class="info-item">
                    <label for="khoi_thi">Khối thi:</label>
                    <span id="khoi_thi">A</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>