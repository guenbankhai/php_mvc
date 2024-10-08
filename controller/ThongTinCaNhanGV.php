<?php
session_start();
require_once 'D:/Code/quanly_diem/model/ThongTinGiaoVien.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = NULL;
}

switch ($action) {
    case 'Sua':
        require_once 'D:/Code/quanly_diem/view/ThongTinCaNhanGV.php';
        break;
    default:
		$userInfo['vaiTro'] = $_SESSION['role'];
		$userInfo['tenDangNhap'] = $_SESSION['username'];
	    $maGV = $_SESSION['maGV'];
        $gvInfo = ThongTinGiaoVien::HienThiCaNhan($maGV);
        if ($gvInfo && count($gvInfo) > 0) {
            $gvInfo = $gvInfo[0];
            require_once 'D:/Code/quanly_diem/view/ThongTinCaNhanGV.php';
        } else {
            header('location:index.php');
        }
        break;
}
?>