<?php
session_start();
require_once 'D:/Code/quanly_diem/model/DiemMonHoc.php';
require_once 'D:/Code/quanly_diem/model/ThongTinHocSinh.php';
require_once 'D:/Code/quanly_diem/model/MonHoc.php';
require_once 'D:/Code/quanly_diem/model/NamHoc.php';
require 'D:/Code/quanly_diem/view/excel/vendor/autoload.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = NULL;
}

$userInfo['vaiTro'] = $_SESSION['role'];
$userInfo['tenDangNhap'] = $_SESSION['username'];

$listHS = ThongTinHocSinh::ThongTinHocSinh();
$listMH = MonHoc::HienThi();
$listNamHoc = NamHoc::HienThi();
use PhpOffice\PhpSpreadsheet\IOFactory;
switch ($action) {
    case 'CapNhatExcel':
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
            $file = $_FILES['file']['tmp_name'];
    
            try {
                $spreadsheet = IOFactory::load($file);
                $worksheet = $spreadsheet->getActiveSheet();
    
                $rowsAffected = 0;
    
                foreach ($worksheet->getRowIterator() as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);
    
                    $rowData = [];
                    foreach ($cellIterator as $cell) {
                        $rowData[] = $cell->getValue();
                    }
    
                    // Lấy dữ liệu từ mảng $rowData và cập nhật vào CSDL
                    $maHS = $rowData[0];
                    $maMH = $rowData[1];
                    $namHoc = $rowData[2];
                    $hocKy = $rowData[3];
                    $diemHS1 = $rowData[4];
                    $diemHS2 = $rowData[5];
                    $diemHS3 = $rowData[6];
    
                    // Gọi hàm cập nhật điểm từ model DiemMonHoc
                    $result = DiemMonHoc::CapNhat($maHS, $maMH, $namHoc, $hocKy, $diemHS1, $diemHS2, $diemHS3);
                    $rowsAffected += $result ? 1 : 0;
                }
    
                header('location:index.php?controller=QuanLyDiem');
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            header('location:index.php?controller=QuanLyDiem');
        }
        break;
    case 'CapNhat':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $maHS = $_POST["maHS"];
            $maMH = $_POST["maMH"];
            $namHoc = $_POST["namHoc"];
            $hocKy = $_POST["hocKy"];
            $diemHS1 = $_POST["diemHS1"];
            $diemHS2 = $_POST["diemHS2"];
            $diemHS3 = $_POST["diemHS3"];
            try {
                $result = DiemMonHoc::CapNhat($maHS, $maMH, $namHoc, $hocKy, $diemHS1, $diemHS2, $diemHS3);
                header('location:index.php?controller=QuanLyDiem');
            } catch (mysqli_sql_exception $e) {
                echo "Có lỗi xảy ra khi cập nhật điểm: " . $e->getMessage();
            }
        } else {
            require_once 'D:/Code/quanly_diem/view/DiemMonHoc.php';
        }
        break;
    case 'Xoa':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedRowsData = json_decode($_POST["selectedRowsData"], true);
            try {
                // Lặp qua từng đối tượng dữ liệu dòng được chọn và thực hiện xóa
                foreach ($selectedRowsData as $row) {
                    $maHS = $row["maHS"];
                    $maMH = $row["maMH"];
                    $namHoc = $row["namHoc"];
                    $hocKy = $row["hocKy"];
                    // Thực hiện xóa dữ liệu
                    $result = DiemMonHoc::Xoa($maHS, $maMH, $namHoc, $hocKy);
                }
                if (isset($_GET['input'])) {
                    $input = $_GET['input'];
                    $data = DiemMonHoc::TimKiemAD($input);
                    header('location:index.php?controller=QuanLyDiem');
                } else {
                    $data = DiemMonHoc::HienThiAD();
                    header('location:index.php?controller=QuanLyDiem');
                }
            } catch (mysqli_sql_exception $e) {
                echo "Có lỗi xảy ra khi xoá điểm: " . $e->getMessage();
            }
        } else {
            header('location:index.php?controller=QuanLyDiem');
        }
        break;
    case 'TimKiem':
        if (isset($_SESSION['role']) && isset($_GET['controller']) && isset($_GET['input'])) {
            $role = $_SESSION['role'];
            $input = $_GET['input'];
            switch ($role) {
                case 'Học sinh':
                    $maHS = $_SESSION['maHS'];
                    $data = DiemMonHoc::TimKiemHS($maHS,$input);
                    require_once 'D:/Code/quanly_diem/view/DiemMonHoc.php';
                    break;
                case 'Giáo viên':
                    $data = DiemMonHoc::TimKiemAD($input);
                    require_once 'D:/Code/quanly_diem/view/DiemMonHoc.php';
                    break;
                case 'Admin':
                    $data = DiemMonHoc::TimKiemAD($input);
                    require_once 'D:/Code/quanly_diem/view/DiemMonHoc.php';
                    break;
                default:
                    header('location:index.php?controller=QuanLyDiem');
                    break;
            }
        } else {
            header('location:index.php?controller=QuanLyDiem');
        }
        break;
    default:
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
            switch ($role) {
                case 'Học sinh':
                    if (isset($_SESSION['maHS'])) {
                        $maHS = $_SESSION['maHS'];
                        $data = DiemMonHoc::HienThiHS($maHS);
                        require_once 'D:/Code/quanly_diem/view/DiemMonHoc.php';
                    } else {
                        header('location:index.php');
                    }
                    break;
                case 'Giáo viên':
                    $data = DiemMonHoc::HienThiAD();
                    require_once 'D:/Code/quanly_diem/view/DiemMonHoc.php';
                    break;
                case 'Admin':
                    $data = DiemMonHoc::HienThiAD();
                    require_once 'D:/Code/quanly_diem/view/DiemMonHoc.php';
                    break;
                default:
                    header('location:index.php');
                    break;
            }
        } else {
            header('location:index.php');
        }
        break;
}
?>