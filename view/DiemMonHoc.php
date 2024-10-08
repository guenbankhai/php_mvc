<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý điểm</title>
    <link rel="stylesheet" href="/view/css/Bang.css">
    <link rel="stylesheet" href="/view/css/inputForm.css">
</head>
<body>
    <?php require_once 'D:/Code/quanly_diem/view/shared/top-bar.php'; ?>
    <?php require_once 'D:/Code/quanly_diem/view/shared/menu.php'; ?>

    <div class="container">
        <div class="header">
            <h2 style="display: inline-block; margin-right: auto;">Danh sách điểm</h2>
            <?php if ($role === 'Admin'): ?>
                <button class="header-button" onclick="showForm()">Cập nhật điểm</button>
                <form id="importForm" action="index.php?controller=QuanLyDiem&action=CapNhatExcel" method="post" enctype="multipart/form-data">
                    <input type="file" class="header-button" name="file" id="fileInput" accept=".xlsx,.xls" required>
                    <button type="submit" class="header-button" id="importButton">Import</button>
                </form>
            <?php endif; ?>
            <form method="post" action="/view/excel/excel.php">
                <input type="hidden" name="exportData" value="<?php echo htmlentities(json_encode($data)); ?>">
                <input type="submit" class="header-button" value="Export">
            </form>
        </div>
                
        <table>
            <tr>
                <th>Họ và tên</th>
                <th>Mã học sinh</th>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Năm học</th>
                <th>Học kỳ</th>
                <th>Điểm HS1</th>
                <th>Điểm HS2</th>
                <th>Điểm HS3</th>
                <th>Điểm TB</th>
            </tr>
            <?php
            if (isset($data) && is_array($data) && !empty($data)) {
                // Số dòng tối đa mỗi trang
                $rowsPerPage = 50;
                // Tính toán số lượng trang dựa trên số lượng dòng dữ liệu
                $totalRows = count($data);
                $totalPages = ceil($totalRows / $rowsPerPage);
                // Xác định trang hiện tại, mặc định là trang 1
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                // Đảm bảo trang hiện tại không vượt quá số trang tổng cộng
                if ($currentPage > $totalPages) {
                    $currentPage = $totalPages;
                }
                // Tính chỉ số bắt đầu và kết thúc của dữ liệu để hiển thị cho trang hiện tại
                $start = ($currentPage - 1) * $rowsPerPage;
                $end = $start + $rowsPerPage;
                // Chỉ hiển thị dữ liệu từ $start đến $end
                for ($i = $start; $i < $end && $i < $totalRows; $i++) {
                    echo "<tr>";
                    echo "<td>".$data[$i]["maHS"]."</td>";
                    echo "<td>".$data[$i]["hoTen"]."</td>";
                    echo "<td>".$data[$i]["maMH"]."</td>";
                    echo "<td>".$data[$i]["tenMH"]."</td>";
                    echo "<td>".$data[$i]["namHoc"]."</td>";
                    echo "<td>".$data[$i]["hocKy"]."</td>";
                    echo "<td>".$data[$i]["diemHS1"]."</td>";
                    echo "<td>".$data[$i]["diemHS2"]."</td>";
                    echo "<td>".$data[$i]["diemHS3"]."</td>";
                    echo "<td>".$data[$i]["diemTB"]."</td>";
                    echo "</tr>";
                }
            } else {
                // Xử lý khi $data không hợp lệ
                $totalPages = 0;
                $currentPage = 0;
                echo "<tr><td colspan='8'>Không có dữ liệu để hiển thị.</td></tr>";
            }
            ?>
        </table>

        <?php
        // Require file và lấy giá trị của controller và action từ $_GET
        require_once 'D:/Code/quanly_diem/view/shared/sotrang.php';
        $controller = isset($_GET['controller']) ? $_GET['controller'] : null;
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        $input = isset($_GET['input']) ? $input = $_GET['input'] : null;
        // Gọi hàm displayPagination với các giá trị đã lấy được
        displayPagination($totalPages, $currentPage, $controller, $action, $input);
        ?>

    </div>
    
    <?php if ($role === 'Admin' || $role === 'Giáo viên'): ?>
        <div id="context-menu" style="display: none;">
            <ul>
                <li id="edit">Cập nhật</li>
                <?php if ($role === 'Admin'): ?>
                    <form id="deleteForm" method="POST" action="index.php?controller=QuanLyDiem&action=Xoa">
                        <input type="hidden" name="selectedRowsData" id="selectedRowsData">
                        <input type="submit" style="display: none;" id="deleteSubmitButton">
                        <li id="delete">Xoá</li>
                    </form>
                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="inputForm" id="addForm" style="display: none;">
        <h3>Cập nhật điểm</h3>
        <form action="index.php?controller=QuanLyDiem&action=CapNhat" method="post">
            <label for="maHS">Học sinh:</label>
            <?php
            if (!empty($listHS)) {
                echo '<select id="maHS" name="maHS" required>';
                echo '<option value="">Chọn mã học sinh</option>';
                foreach ($listHS as $HS) {
                    $value = $HS['maHS']; 
                    $display = $HS['maHS'] . ' - ' . $HS['hoTen'];
                    echo '<option value="'.$value.'">'.$display.'</option>';
                }
                echo '</select><br><br>';
            } else {
                echo "Không có dữ liệu mã học sinh.";
            }
            ?>


            <label for="maMH">Môn học:</label>
            <?php
            if (!empty($listMH)) {
                echo '<select id="maMH" name="maMH" required>';
                echo '<option value="">Chọn mã môn học</option>';
                foreach ($listMH as $MonHoc) {
                    $value = $MonHoc['maMH']; 
                    $display = $MonHoc['maMH'] . ' - ' . $MonHoc['tenMH'];
                    echo '<option value="'.$value.'">'.$display.'</option>';
                }
                echo '</select><br><br>';
            } else {
                echo "Không có dữ liệu mã môn học.";
            }
            ?>

            <label for="namHoc">Năm học:</label>
            <?php
            if (!empty($listNamHoc)) {
                echo '<select id="namHoc" name="namHoc" required>';
                echo '<option value="">Chọn năm học</option>';
                foreach ($listNamHoc as $namHoc) {
                    echo '<option value="'.$namHoc['namHoc'].'">'.$namHoc['namHoc'].'</option>';
                }
                echo '</select><br><br>';
            } else {
                echo "Không có dữ liệu năm học.";
            }
            ?>

            <label for="hocKy">Học kỳ:</label>
            <select id="hocKy" name="hocKy" required>
                <option value="">Chọn học kỳ</option>
                <option value="HK1">HK1</option>
                <option value="HK2">HK2</option>
            </select><br><br>

            <label class="diemLabel" for="diemHS1">Điểm HS1:</label>
            <span id="diemHS1Error" class="error-message"></span><br>
            <input type="text" id="diemHS1" name="diemHS1" oninput="validateInput('diemHS1', this.value)">

            <label class="diemLabel" for="diemHS2">Điểm HS2:</label>
            <span id="diemHS2Error" class="error-message"></span><br>
            <input type="text" id="diemHS2" name="diemHS2" oninput="validateInput('diemHS2', this.value)">

            <label class="diemLabel" for="diemHS3">Điểm HS3:</label>
            <span id="diemHS3Error" class="error-message"></span><br>
            <input type="text" id="diemHS3" name="diemHS3" oninput="validateInput('diemHS3', this.value)">

            <label></label>
            <span id="diemTBSpan"></span><br>

            <button type="submit" id="submitButton" disabled>Cập nhật</button>
            <button type="button" onclick="cancelForm()">Huỷ</button>
        </form>
    </div>
    
    <script src="/view/shared/js/ChonDong.js"></script>
    <script src="/view/js/DiemMonHocCapNhat.js"></script>
    <script src="/view/js/DiemMonHocXoa.js"></script>
</body>
</html>
