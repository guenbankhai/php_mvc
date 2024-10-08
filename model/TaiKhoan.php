<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
class TaiKhoan extends Database {
    public static function DangNhap($username, $password)
	{
        $database = new Database();
		$sql = "SELECT * FROM TaiKhoan WHERE tenDangNhap = '$username' AND matKhau = '$password'";
        return $database->Getdata($sql);
	}
}
?>