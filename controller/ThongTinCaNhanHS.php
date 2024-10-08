<?php
session_start();
require_once 'D:/Code/quanly_diem/model/ThongTinHocSinh.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = NULL;
}

switch ($action) {
    case 'Sua':
        require_once 'D:/Code/quanly_diem/view/ThongTinCaNhanHS.php';
        break;
    default:
        $userInfo['vaiTro'] = $_SESSION['role'];
        $userInfo['tenDangNhap'] = $_SESSION['username'];
	    $maHS = $_SESSION['maHS'];
        $hsInfo = ThongTinHocSinh::HienThiCaNhan($maHS);
        if ($hsInfo && count($hsInfo) > 0) {
            $hsInfo = $hsInfo[0];
            require_once 'D:/Code/quanly_diem/view/ThongTinCaNhanHS.php';
        } else {
            header('location:index.php');
        }
        break;
}
?>