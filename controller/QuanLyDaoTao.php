<?php
session_start();
require_once 'D:/Code/quanly_diem/model/MonHoc.php';
require_once 'D:/Code/quanly_diem/model/KhoiThi.php';
require_once 'D:/Code/quanly_diem/model/ToChuyenMon.php';
require_once 'D:/Code/quanly_diem/model/NamHoc.php';
require_once 'D:/Code/quanly_diem/model/Lop.php';
require_once 'D:/Code/quanly_diem/model/PhanCongGiangDay.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = NULL;
}

$userInfo['vaiTro'] = $_SESSION['role'];
$userInfo['tenDangNhap'] = $_SESSION['username'];

switch ($action) {
    case 'Sua':
        require_once 'D:/Code/quanly_diem/view/QuanLyDaoTao.php';
        break;
    default:
        $dataMonHoc = MonHoc::HienThi();
        $dataKhoiThi = KhoiThi::HienThi();
        $dataToChuyenMon = ToChuyenMon::HienThi();
        $dataNamHoc = NamHoc::HienThi();
        $dataLop = Lop::HienThi();
        $dataPhanCongGiangDay = PhanCongGiangDay::HienThi();
        if ($dataMonHoc && count($dataMonHoc) > 0) {
            require_once 'D:/Code/quanly_diem/view/QuanLyDaoTao.php';
        } else {
            header('location:index.php');
        }
        break;
}
?>