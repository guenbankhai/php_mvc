<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Giáo viên</title>
    <link rel="stylesheet" href="/view/css/ThongTinCaNhan.css">
</head>
<body>

    <?php require_once 'D:/Code/quanly_diem/view/shared/top-bar.php'; ?>
    <?php require_once 'D:/Code/quanly_diem/view/shared/menu.php'; ?>

    <div class="container">
        <h2>Thông tin cá nhân</h2>
        <div class="info-container">
            <div class="info-left">
                <div class="info-item">
                    <label for="ma_hs">Mã Giáo viên:</label>
                    <span id="ma_hs"><?php echo $gvInfo['maGV']; ?></span>
                </div>
                <div class="info-item">
                    <label for="ho_ten">Họ tên:</label>
                    <span id="ho_ten"><?php echo $gvInfo['hoTen']; ?></span>
                </div>
                <div class="info-item">
                    <label for="gioi_tinh">Giới tính:</label>
                    <span id="gioi_tinh"><?php echo $gvInfo['gioiTinh']; ?></span>
                </div>
                <div class="info-item">
                    <label for="noi_sinh">Ngày sinh:</label>
                    <span id="noi_sinh"><?php echo $gvInfo['ngaySinh']; ?></span>
                </div>
                <div class="info-item">
                    <label for="noi_sinh">Nơi sinh:</label>
                    <span id="noi_sinh"><?php echo $gvInfo['noiSinh']; ?></span>
                </div>
                <div class="info-item">
                    <label for="so_dien_thoai">Số điện thoại:</label>
                    <span id="so_dien_thoai"><?php echo $gvInfo['soDT']; ?></span>
                </div>
            </div>
            <div class="info-right">
                <div class="info-item">
                    <label for="ma_tcm">Mã TCM:</label>
                    <span id="ma_tcm"><?php echo $gvInfo['maTCM']; ?></span>
                </div>
                <div class="info-item">
                    <label for="ten_tcm">Tên TCM:</label>
                    <span id="ten_tcm">A</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
