<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
class ThongTinGiaoVien extends Database {
    public static function ThongTinGiaoVien()
	{
        $database = new Database();
		$sql = "SELECT * FROM ThongTinGiaoVien";
        return $database->Getdata($sql);
	}

    public static function HienThiCaNhan($magiaovien)
	{
        $database = new Database();
		$sql = "SELECT * FROM ThongTinGiaoVien WHERE maGV = '$magiaovien'";
        return $database->Getdata($sql);
	}

    public static function Them($hoTen, $gioiTinh, $ngaySinh, $noiSinh, $soDT, $maTCM)
	{
        $database = new Database();
		$sql = "CALL ThemThongTinGiaoVien('$hoTen', '$gioiTinh', '$ngaySinh', '$noiSinh', '$soDT', '$maTCM')";
        return $database->Getdata($sql);
	}

    public static function Sua($maGV, $hoTen, $gioiTinh, $ngaySinh, $noiSinh, $soDT, $maTCM)
	{
        $database = new Database();
		$sql = "CALL SuaThongTinGiaoVien('$maGV', '$hoTen', '$gioiTinh', '$ngaySinh', '$noiSinh', '$soDT', '$maTCM')";
        return $database->Getdata($sql);
	}
}
?>