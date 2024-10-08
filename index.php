<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';

$database = new Database();
$data = $database->Connect();

if (isset($_GET['controller'])) {
	$controller = $_GET['controller'];
}
else
{
	$controller = NULL;
}

switch ($controller) {
	case 'DangNhap':
		require_once 'D:/Code/quanly_diem/controller/DangNhap.php';
		break;
	case 'ThongTinCaNhanHS':
		require_once 'D:/Code/quanly_diem/controller/ThongTinCaNhanHS.php';
		break;
	case 'ThongTinCaNhanGV':
		require_once 'D:/Code/quanly_diem/controller/ThongTinCaNhanGV.php';
		break;
	case 'QuanLyDiem':
		require_once 'D:/Code/quanly_diem/controller/DiemMonHoc.php';
		break;
	case 'QuanLyDaoTao':
		require_once 'D:/Code/quanly_diem/controller/QuanLyDaoTao.php';
		break;
	case 'ThongTinHocSinh':
		require_once 'D:/Code/quanly_diem/controller/ThongTinHocSinh.php';
		break;
	case 'ThongTinGiaoVien':
		require_once 'D:/Code/quanly_diem/controller/ThongTinGiaoVien.php';
		break;
	default:
		require_once 'D:/Code/quanly_diem/controller/DangNhap.php';
		break;
}
?>