<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các bảng</title>
    <link rel="stylesheet" href="/view/css/Bang.css">
</head>
<body>

    <?php require_once 'D:/Code/quanly_diem/view/shared/top-bar.php'; ?>
    <?php require_once 'D:/Code/quanly_diem/view/shared/menu.php'; ?>

    <div class="container">
        <h2>Quản lý đào tạo</h2>

        <h3>Bảng Môn Học</h3>
        <table>
            <tr>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
            </tr>
            <?php
            if ($dataMonHoc !== false && !empty($dataMonHoc)) {
                foreach ($dataMonHoc as $row) {
                    echo "<tr>";
                    echo "<td>".$row["maMH"]."</td>";
                    echo "<td>".$row["tenMH"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Không có dữ liệu từ bảng Môn học</td></tr>";
            }
            ?>
        </table>

        <h3>Bảng Khối Thi</h3>
        <table>
            <tr>
                <th>Mã khối thi</th>
                <th>Mã Môn học 1</th>
                <th>Mã Môn học 2</th>
                <th>Mã Môn học 3</th>
            </tr>
            <?php
            if ($dataKhoiThi !== false && !empty($dataKhoiThi)) {
                foreach ($dataKhoiThi as $row) {
                    echo "<tr>";
                    echo "<td>".$row["maKT"]."</td>";
                    echo "<td>".$row["maMH1"]."</td>";
                    echo "<td>".$row["maMH2"]."</td>";
                    echo "<td>".$row["maMH3"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Không có dữ liệu từ bảng Khối thi</td></tr>";
            }
            ?>
        </table>

        <h3>Bảng Tổ chuyên môn</h3>
        <table>
            <tr>
                <th>Mã Tổ chuyên môn</th>
                <th>Tên Tổ chuyên môn</th>
                <th>Mã Môn học 1</th>
                <th>Mã Môn học 2</th>
                <th>Mã Môn học 3</th>
            </tr>
            <?php
            if ($dataToChuyenMon !== false && !empty($dataToChuyenMon)) {
                foreach ($dataToChuyenMon as $row) {
                    echo "<tr>";
                    echo "<td>".$row["maTCM"]."</td>";
                    echo "<td>".$row["tenTCM"]."</td>";
                    echo "<td>".$row["maMH1"]."</td>";
                    echo "<td>".$row["maMH2"]."</td>";
                    echo "<td>".$row["maMH3"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Không có dữ liệu từ bảng Tổ chuyên môn</td></tr>";
            }
            ?>
        </table>

        <h3>Bảng Năm học</h3>
        <table>
            <tr>
                <th>Năm bắt đầu</th>
                <th>Năm kết thúc</th>
                <th>Năm học</th>
            </tr>
            <?php
            if ($dataNamHoc !== false && !empty($dataNamHoc)) {
                foreach ($dataNamHoc as $row) {
                    echo "<tr>";
                    echo "<td>".$row["namBatDau"]."</td>";
                    echo "<td>".$row["namKetThuc"]."</td>";
                    echo "<td>".$row["namHoc"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Không có dữ liệu từ bảng Năm học</td></tr>";
            }
            ?>
        </table>

        <h3>Bảng Lớp</h3>
        <table>
            <tr>
                <th>Mã Lớp</th>
                <th>Mã Khối thi</th>
                <th>Năm mở lớp</th>
            </tr>
            <?php
            if ($dataLop !== false && !empty($dataLop)) {
                foreach ($dataLop as $row) {
                    echo "<tr>";
                    echo "<td>".$row["maLop"]."</td>";
                    echo "<td>".$row["maKT"]."</td>";
                    echo "<td>".$row["namMoLop"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Không có dữ liệu từ bảng Lớp</td></tr>";
            }
            ?>
        </table>

        <h3>Bảng Phân công giảng dạy</h3>
        <table>
            <tr>
                <th>Mã Lớp</th>
                <th>Mã Môn học</th>
                <th>Năm học</th>
                <th>Mã Giáo viên</th>
            </tr>
            <?php
            if ($dataPhanCongGiangDay !== false && !empty($dataPhanCongGiangDay)) {
                foreach ($dataPhanCongGiangDay as $row) {
                    echo "<tr>";
                    echo "<td>".$row["maLop"]."</td>";
                    echo "<td>".$row["maMH"]."</td>";
                    echo "<td>".$row["namHoc"]."</td>";
                    echo "<td>".$row["maGV"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Không có dữ liệu từ bảng Phân công giảng dạy</td></tr>";
            }
            ?>
        </table>

    </div>
</body>
</html>
