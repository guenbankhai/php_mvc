<?php
session_start();
require_once 'D:/Code/quanly_diem/model/ThongTinHocSinh.php';
require_once 'D:/Code/quanly_diem/model/NamHoc.php';
require_once 'D:/Code/quanly_diem/model/Lop.php';

$listNH = NamHoc::HienThi();
$listHS = ThongTinHocSinh::ThongTinHocSinh();
$listLop = Lop::HienThi();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = NULL;
}

switch ($action) {
    case 'Them':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hoTen = $_POST["hoTen"];
            $gioiTinh = $_POST["gioiTinh"];
            $ngaySinh = $_POST["ngaySinh"];
            $noiSinh = $_POST["noiSinh"];
            $soDT = $_POST["soDT"];
            $namNhapHoc = $_POST["namNhapHoc"];
            $maLop = $_POST["maLop"];
            try {
                $result = ThongTinHocSinh::Them($hoTen, $gioiTinh, $ngaySinh, $noiSinh, $soDT, $namNhapHoc, $maLop);
                require_once 'D:/Code/quanly_diem/view/ThongTinHocSinh.php';
            } catch (mysqli_sql_exception $e) {
                echo "Có lỗi xảy ra khi thông tin học sinh: " . $e->getMessage();
            }
        } else {
            require_once 'D:/Code/quanly_diem/view/ThongTinHocSinh.php';
        }
        break;
    case 'Sua':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $maHS = $_POST["maHS"];
            $hoTen = $_POST["hoTen"];
            $gioiTinh = $_POST["gioiTinh"];
            $ngaySinh = $_POST["ngaySinh"];
            $noiSinh = $_POST["noiSinh"];
            $soDT = $_POST["soDT"];
            $namNhapHoc = $_POST["namNhapHoc"];
            $maLop = $_POST["maLop"];
            try {
                $result = ThongTinHocSinh::Sua($maHS, $hoTen, $gioiTinh, $ngaySinh, $noiSinh, $soDT, $namNhapHoc, $maLop);
                require_once 'D:/Code/quanly_diem/view/ThongTinHocSinh.php';
            } catch (mysqli_sql_exception $e) {
                echo "Có lỗi xảy ra khi thông tin học sinh: " . $e->getMessage();
            }
        } else {
            require_once 'D:/Code/quanly_diem/view/ThongTinHocSinh.php';
        }
        break;
    case 'TimKiem':
        if (isset($_GET['controller']) && isset($_GET['input'])) {
            $input = $_GET['input'];
            $input = $_GET['input'];
            $data = ThongTinHocSinh::TimKiemAD($input);
            require_once 'D:/Code/quanly_diem/view/ThongTinHocSinh.php';
        } else {
            header('location:index.php?controller=QuanLyDiem');
        }
        break;
    default:
        $userInfo['vaiTro'] = $_SESSION['role'];
        $userInfo['tenDangNhap'] = $_SESSION['username'];
        $row = ThongTinHocSinh::ThongTinHocSinh();
        if ($row) {
            require_once 'D:/Code/quanly_diem/view/ThongTinHocSinh.php';
        } else {
            header('location:index.php');
        }
        break;
}
?>