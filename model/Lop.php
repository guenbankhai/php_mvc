<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
class Lop extends Database {
    public static function HienThi()
	{
        $database = new Database();
		$sql = "SELECT * FROM Lop";
        return $database->Getdata($sql);
	}
}
?>