<?php
session_start();
require_once 'D:/Code/quanly_diem/model/TaiKhoan.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = NULL;
}

switch ($action) {
    case 'DangNhap':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $result = TaiKhoan::DangNhap($username, $password);
            
            // Kiểm tra xem có dữ liệu trả về hay không
            if ($result && count($result) > 0) {
                $user = $result[0]; // Lấy hàng đầu tiên từ kết quả trả về
                $userRole = $user['vaiTro']; // Lấy vai trò của người dùng từ hàng đó
                switch ($userRole) {
                    case 'Học sinh':
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        $_SESSION['role'] = $userRole;
                        $_SESSION['maHS'] = $user['maHS'];
                        header('location:index.php?controller=QuanLyDiem');
                        break;
                    case 'Giáo viên':
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        $_SESSION['role'] = $userRole;
                        $_SESSION['maGV'] = $user['maGV'];
                        header('location:index.php?controller=QuanLyDiem');
                        break;
                    case 'Admin':
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        $_SESSION['role'] = $userRole;
                        header('location:index.php?controller=QuanLyDiem');
                        break;
                    default:
                        // Trong trường hợp vai trò không xác định, điều hướng về trang mặc định
                        header('location:index.php');
                        break;
                }
            } else {
                $error = 'Tên đăng nhập hoặc mật khẩu không chính xác.';
                require_once 'D:/Code/quanly_diem/view/DangNhap.php';
            }
        }
        break;

    default:
        require_once 'D:/Code/quanly_diem/view/DangNhap.php';
        break;
}
?>