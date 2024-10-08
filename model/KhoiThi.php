<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
class KhoiThi extends Database {
    public static function HienThi()
	{
        $database = new Database();
		$sql = "SELECT * FROM KhoiThi";
        return $database->Getdata($sql);
	}
}
?>