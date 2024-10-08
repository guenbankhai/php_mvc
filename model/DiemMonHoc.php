<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
class DiemMonHoc extends Database {
    public static function HienThiHS($maHS)
	{
        $database = new Database();
		$sql = "SELECT * FROM BangDiemMonHoc WHERE maHS = '$maHS'";
        return $database->Getdata($sql);
	}

    public static function HienThiAD()
	{
        $database = new Database();
		$sql = "SELECT * FROM BangDiemMonHoc limit 10 ";
        return $database->Getdata($sql);
	}
    
    public static function TimKiemHS($maHS, $input)
    {
        $database = new Database();
        $sql = "CALL TraCuuBangDiemMonHoc('$maHS' + ' ' + '$input')";
        return $database->Getdata($sql);
    }

    public static function TimKiemAD($input)
    {
        $database = new Database();
        $sql = "CALL TraCuuBangDiemMonHoc('$input')";
        return $database->Getdata($sql);
    }

    public static function CapNhat($maHS, $maMH, $namHoc, $hocKy, $diemHS1, $diemHS2, $diemHS3)
    {
        $database = new Database();
    
        // Kiểm tra và xử lý các giá trị để chuyển các giá trị rỗng thành NULL
        $diemHS1 = ($diemHS1 !== '') ? "'" . $diemHS1 . "'" : 'NULL';
        $diemHS2 = ($diemHS2 !== '') ? "'" . $diemHS2 . "'" : 'NULL';
        $diemHS3 = ($diemHS3 !== '') ? "'" . $diemHS3 . "'" : 'NULL';
    
        // Tạo câu lệnh SQL sử dụng các giá trị đã được xử lý
        $sql = "CALL CapNhatDiemMonHoc('$maHS', '$maMH', '$namHoc', '$hocKy', $diemHS1, $diemHS2, $diemHS3)";
    
        return $database->Execute($sql);
    }
    

    public static function Xoa($maHS, $maMH, $namHoc, $hocKy)
    {
        $database = new Database();
        
        // Chú ý: Sửa câu truy vấn DELETE FROM để xử dụng đúng cú pháp và thêm đúng điều kiện xóa
        $sql = "DELETE FROM DiemMonHoc WHERE maHS = '$maHS' AND maMH = '$maMH' AND namHoc = '$namHoc' AND hocKy = '$hocKy'";
        
        return $database->Execute($sql);
    }

}
?>