<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/view/shared/css/top-bar.css">
</head>
<body>
    <div class="top-nav">
        <div class="user-info">
            <?php if (!empty($userInfo)): ?>
                <span><?php echo $userInfo['vaiTro']; ?></span>
                <div class="dropdown">
                    <span><?php echo $userInfo['tenDangNhap']; ?></span>
                    <div class="dropdown-content">
                        <a href="#">Trang chủ</a>
                        <a href="#">Đăng xuất</a>
                    </div>
                </div>
            <?php else: ?>
                <span>Vai trò</span>
                <div class="dropdown">
                    <span>Tên đăng nhập</span>
                    <div class="dropdown-content">
                        <a href="#">Trang chủ</a>
                        <a href="#">Đăng xuất</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
