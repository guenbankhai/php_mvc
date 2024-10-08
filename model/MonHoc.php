<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
class MonHoc extends Database {
    public static function HienThi()
	{
        $database = new Database();
		$sql = "SELECT * FROM MonHoc";
        return $database->Getdata($sql);
	}
}
?>