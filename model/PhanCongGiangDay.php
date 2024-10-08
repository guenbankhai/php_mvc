<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
class PhanCongGiangDay extends Database {
    public static function HienThi()
	{
        $database = new Database();
		$sql = "SELECT * FROM PhanCongGiangDay";
        return $database->Getdata($sql);
	}
}
?>