<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
class NamHoc extends Database {
    public static function HienThi()
	{
        $database = new Database();
		$sql = "SELECT * FROM NamHoc";
        return $database->Getdata($sql);
	}
}
?>