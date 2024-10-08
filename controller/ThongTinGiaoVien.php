<?php
session_start();
require_once 'D:/Code/quanly_diem/model/ThongTinGiaoVien.php';
require_once 'D:/Code/quanly_diem/model/ToChuyenMon.php';
require 'D:/Code/quanly_diem/view/excel/vendor/autoload.php';

$listTCM = ToChuyenMon::HienThi();
$listGV = ThongTinGiaoVien::ThongTinGiaoVien();

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
            $maTCM = $_POST["maTCM"];
            try {
                $result = ThongTinGiaoVien::Them($hoTen, $gioiTinh, $ngaySinh, $noiSinh, $soDT, $maTCM);
                header('location:index.php?controller=ThongTinGiaoVien');
            } catch (mysqli_sql_exception $e) {
                echo "Có lỗi xảy ra khi cập nhật thông tin học sinh: " . $e->getMessage();
            }
        } else {
            require_once 'D:/Code/quanly_diem/view/ThongTinGiaoVien.php';
        }
        break;
    case 'Sua':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $maGV = $_POST['maGV'];
            $hoTen = $_POST["hoTen"];
            $gioiTinh = $_POST["gioiTinh"];
            $ngaySinh = $_POST["ngaySinh"];
            $noiSinh = $_POST["noiSinh"];
            $soDT = $_POST["soDT"];
            $maTCM = $_POST["maTCM"];
            try {
                $result = ThongTinGiaoVien::Sua($maGV, $hoTen, $gioiTinh, $ngaySinh, $noiSinh, $soDT, $maTCM);
                header('location:index.php?controller=ThongTinGiaoVien');
            } catch (mysqli_sql_exception $e) {
                echo "Có lỗi xảy ra khi cập nhật điểm: " . $e->getMessage();
            }
        } else {
            require_once 'D:/Code/quanly_diem/view/ThongTinGiaoVien.php';
        }
        break;
    default:
        $userInfo['vaiTro'] = $_SESSION['role'];
        $userInfo['tenDangNhap'] = $_SESSION['username'];
        $data = ThongTinGiaoVien::ThongTinGiaoVien();
        if ($data) {
            require_once 'D:/Code/quanly_diem/view/ThongTinGiaoVien.php';
        } else {
            header('location:index.php');
        }
        break;
}
?>