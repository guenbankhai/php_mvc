<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
class ToChuyenMon extends Database {
    public static function HienThi()
	{
        $database = new Database();
		$sql = "SELECT * FROM ToChuyenMon";
        return $database->Getdata($sql);
	}
}
?>