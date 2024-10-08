<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/view/shared/css/menu.css">
</head>
<body>
    <div class="logo">
        <img src="/view/img/utt_banner.png" alt="utt_banner.png" class="menu-logo">
    </div>
    <div class="menu">
        <?php if (isset($_SESSION['role'])): ?>
            <?php $role = $_SESSION['role']; ?>
            
            <?php if ($role == 'Admin'): ?>
                <a href="index.php?controller=QuanLyDiem" class="menu-item">Quản lý điểm</a>
                <div class="separator"></div>
                <a href="index.php?controller=QuanLyDaoTao" class="menu-item">Quản lý đào tạo</a>
                <div class="separator"></div>
                <a href="index.php?controller=ThongTinHocSinh" class="menu-item">Quản lý học sinh</a>
                <div class="separator"></div>
                <a href="index.php?controller=ThongTinGiaoVien" class="menu-item">Quản lý giáo viên</a>
            <?php else: ?>
                <a href="index.php?controller=QuanLyDiem" class="menu-item">Quản lý điểm</a>
                <div class="separator"></div>
                <?php if ($role == 'Học sinh'): ?>
                    <a href="index.php?controller=ThongTinCaNhanHS" class="menu-item">Quản lý thông tin cá nhân</a>
                <?php else: ?>
                    <a href="index.php?controller=ThongTinCaNhanGV" class="menu-item">Quản lý thông tin cá nhân</a>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($_GET['controller'])): ?>
                <?php $controller = $_GET['controller']; ?>
                <form id="searchForm" action="index.php" method="get">
                    <!-- Truyền controller và action vào hidden input -->
                    <input type="hidden" name="controller" value="<?php echo $controller; ?>">
                    <input type="hidden" name="action" value="TimKiem">

                    <!-- Input tìm kiếm -->
                    <div class="search-bar">
                        <input type="text" id="searchInput" name="input" placeholder="Tìm kiếm..." oninput="toggleSubmitButton()">
                        <!-- Nút submit để gửi form -->
                        <button type="submit" id="searchButton" style="display: none;">Tìm</button>
                    </div>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script>
        function toggleSubmitButton() {
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');

            // Kiểm tra nếu ô tìm kiếm có giá trị thì hiển thị nút submit, ngược lại ẩn đi
            if (searchInput.value.trim() !== '') {
                searchButton.style.display = 'inline-block';
            } else {
                searchButton.style.display = 'none';
            }
        }
    </script>
</body>
</html>
