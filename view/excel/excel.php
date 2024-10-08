<?php
// Nhận dữ liệu từ POST
if (isset($_POST['exportData'])) {
    // Giải mã dữ liệu JSON
    $data = json_decode(html_entity_decode($_POST['exportData']), true);

    // Include thư viện PHP Spreadsheet
    require_once './vendor/autoload.php'; // Thay đổi đường dẫn đến thư mục autoload.php của thư viện

    // Khởi tạo đối tượng Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Thiết lập tiêu đề cho các cột
    $sheet->setCellValue('A1', 'Mã học sinh');
    $sheet->setCellValue('B1', 'Họ và tên');
    $sheet->setCellValue('C1', 'Mã môn học');
    $sheet->setCellValue('D1', 'Tên môn học');
    $sheet->setCellValue('E1', 'Năm học');
    $sheet->setCellValue('F1', 'Học kỳ');
    $sheet->setCellValue('G1', 'Điểm HS1');
    $sheet->setCellValue('H1', 'Điểm HS2');
    $sheet->setCellValue('I1', 'Điểm HS3');
    $sheet->setCellValue('J1', 'Điểm TB');

    // Lấy dữ liệu từ mảng $data và điền vào tệp Excel
    $row = 2;
    foreach ($data as $item) {
        $sheet->setCellValue('A' . $row, $item["maHS"]);
        $sheet->setCellValue('B' . $row, $item["hoTen"]);
        $sheet->setCellValue('C' . $row, $item["maMH"]);
        $sheet->setCellValue('D' . $row, $item["tenMH"]);
        $sheet->setCellValue('E' . $row, $item["namHoc"]);
        $sheet->setCellValue('F' . $row, $item["hocKy"]);
        $sheet->setCellValue('G' . $row, $item["diemHS1"]);
        $sheet->setCellValue('H' . $row, $item["diemHS2"]);
        $sheet->setCellValue('I' . $row, $item["diemHS3"]);
        $sheet->setCellValue('J' . $row, $item["diemTB"]);
        $row++;
    }

    // Xuất file Excel
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $fileName = 'danh_sach_diem.xlsx'; // Tên tệp Excel xuất ra
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
} else {
    // Xử lý khi không có dữ liệu được gửi từ danh_sach_diem.php
    echo "Không có dữ liệu để xuất ra Excel.";
}
?>
