<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
class ThongTinHocSinh extends Database {
    public static function ThongTinHocSinh()
	{
        $database = new Database();
		$sql = "SELECT * FROM ThongTinHocSinh";
        return $database->Getdata($sql);
	}

    public static function HienThiCaNhan($mahocsinh)
	{
        $database = new Database();
		$sql = "SELECT * FROM ThongTinHocSinh WHERE maHS = '$mahocsinh'";
        return $database->Getdata($sql);
	}

    public static function Them($hoTen, $gioiTinh, $ngaySinh, $noiSinh, $soDT, $namNhaphoc, $maLop)
	{
        $database = new Database();
		$sql = "CALL ThemThongTinHocSinh('$hoTen', '$gioiTinh', '$ngaySinh', '$noiSinh', '$soDT', '$namNhaphoc', '$maLop')";
        return $database->Execute($sql);
	}

    public static function Sua($maHS, $hoTen, $gioiTinh, $ngaySinh, $noiSinh, $soDT, $namNhaphoc, $maLop)
	{
        $database = new Database();
		$sql = "CALL SuaThongTinHocSinh('$maHS', '$hoTen', '$gioiTinh', '$ngaySinh', '$noiSinh', '$soDT', '$namNhaphoc', '$maLop')";
        return $database->Execute($sql);
	}

    public static function TimKiemAD($input)
    {
        $database = new Database();
        $sql = "CALL TraCuuThongTinHocSinh('$input')";
        return $database->Getdata($sql);
    }
}
?>