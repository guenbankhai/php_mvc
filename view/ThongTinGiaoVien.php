<?php
require_once 'D:/Code/quanly_diem/connect/connect.php';
// Tạo một thể hiện của lớp Database_qldiem
$database = new Database();
// Lấy dữ liệu giáo viên từ cơ sở dữ liệu
$sql = "SELECT * FROM ThongTinGiaoVien";
$data = $database->GetData($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/view/css/Bang.css">
    <link rel="stylesheet" href="/view/css/inputForm.css">
</head>
<body>

    <?php require_once 'D:/Code/quanly_diem/view/shared/top-bar.php'; ?>
    <?php require_once 'D:/Code/quanly_diem/view/shared/menu.php'; ?>

    <div class="container">
        <div class="header">
            <h2 style="display: inline-block; margin-right: auto;">Danh sách giáo viên</h2>
            <?php if ($role === 'Admin'): ?>
                <button class="header-button" onclick="showForm('addForm')">Thêm Giáo viên</button>
                <form id="importForm" action="index.php?controller=ThongTinGiaoVien&action=CapNhatExcel" method="post" enctype="multipart/form-data">
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
                <th>Mã Giáo viên</th>
                <th>Họ và tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Nơi sinh</th>
                <th>Số điện thoại</th>
                <th>Mã tổ chuyên môn</th>
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
                    echo "<td>".$data[$i]["maGV"]."</td>";
                    echo "<td>".$data[$i]["hoTen"]."</td>";
                    echo "<td>".$data[$i]["gioiTinh"]."</td>";
                    echo "<td>".$data[$i]["ngaySinh"]."</td>";
                    echo "<td>".$data[$i]["noiSinh"]."</td>";
                    echo "<td>".$data[$i]["soDT"]."</td>";
                    echo "<td>".$data[$i]["maTCM"]."</td>";
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

    <div id="context-menu" style="display: none;">
        <ul>
            <li id="edit">Sửa</li>
            <form id="deleteForm" method="POST" action="index.php?controller=ThongTinGiaoVien&action=Xoa">
                <input type="hidden" name="selectedRowsData" id="selectedRowsData">
                <input type="submit" style="display: none;" id="deleteSubmitButton">
                <li id="delete">Xoá</li>
            </form>
        </ul>
    </div>

    <div class="inputForm" id="addForm" style="display: none;">
        <h3>Thêm thông tin giáo viên</h3>
        <form action="index.php?controller=ThongTinGiaoVien&action=Them" method="post">
            <label class="hoTen" for="hoTen">Họ tên:</label>
            <input type="text" id="hoten" name="hoTen" required>

            <label for="gioiTinh">Giới tính:</label>
            <select id="gioiTinh" name="gioiTinh" required>
                <option value="">Chọn giới tính</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select><br><br>

            <label for="ngaySinh">Ngày sinh:</label>
            <input type="text" id="ngaySinh" name="ngaySinh" required>

            <label class="noiSinh" for="noiSinh">Nơi sinh:</label>
            <input type="text" id="noiSinh" name="noiSinh" required>

            <label class="soDT" for="soDT">Số điện thoại:</label>
            <input type="text" id="soDT" name="soDT" required>

            <label for="maGV">Tổ chuyên:</label>
            <?php
            if (!empty($listTCM)) {
                echo '<select id="maTCM" name="maTCM" required>';
                echo '<option value="">Chọn mã tổ chuyên môn</option>';
                foreach ($listTCM as $TCM) {
                    $value = $TCM['maTCM']; 
                    $display = $TCM['maTCM'] . ' - ' . $TCM['tenTCM'];
                    echo '<option value="'.$value.'">'.$display.'</option>';
                }
                echo '</select><br><br>';
            } else {
                echo "Không có dữ liệu mã tổ chuyên môn.";
            }
            ?>

            <button type="submit" id="submitButton" disabled>Thêm</button>
            <button type="button" onclick="cancelForm('addForm')">Huỷ</button>
        </form>
    </div>

    <div class="inputForm" id="updateForm" style="display: none;">
        <h3>Sửa thông tin giáo viên</h3>
        <form action="index.php?controller=ThongTinGiaoVien&action=Sua" method="post">
            <label for="maGV">Giáo viên:</label>
            <?php
            if (!empty($listGV)) {
                echo '<select id="updatemaGV" name="maGV" required>';
                echo '<option value="">Chọn mã giáo viên</option>';
                foreach ($listGV as $GV) {
                    echo '<option value="'.$GV['maGV'].'">'.$GV['maGV'].'</option>';
                }
                echo '</select><br><br>';
            } else {
                echo "Không có dữ liệu mã giáo viên.";
            }
            ?>

            <label class="hoTen" for="hoTen">Họ tên:</label>
            <input type="text" id="updatehoTen" name="hoTen" required>

            <label for="gioiTinh">Giới tính:</label>
            <select id="updategioiTinh" name="gioiTinh" required>
                <option value="">Chọn giới tính</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select><br><br>

            <label for="ngaySinh">Ngày sinh:</label>
            <input type="text" id="updatengaySinh" name="ngaySinh" required>

            <label class="noiSinh" for="noiSinh">Nơi sinh:</label>
            <input type="text" id="updatenoiSinh" name="noiSinh" required>

            <label class="soDT" for="soDT">Số điện thoại:</label>
            <input type="text" id="updatesoDT" name="soDT" required>

            <label for="maGV">Tổ chuyên:</label>
            <?php
            if (!empty($listTCM)) {
                echo '<select id="updatemaTCM" name="maTCM" required>';
                echo '<option value="">Chọn mã tổ chuyên môn</option>';
                foreach ($listTCM as $TCM) {
                    $value = $TCM['maTCM']; 
                    $display = $TCM['maTCM'] . ' - ' . $TCM['tenTCM'];
                    echo '<option value="'.$value.'">'.$display.'</option>';
                }
                echo '</select><br><br>';
            } else {
                echo "Không có dữ liệu mã tổ chuyên môn.";
            }
            ?>

            <button type="submit" id="updatesubmitButton" disabled>Cập nhật</button>
            <button type="button" onclick="cancelForm('updateForm')">Huỷ</button>
        </form>
    </div>
        
    <script src="/view/shared/js/ChonDong.js"></script>
    <script src="/view/js/ThongTinGiaoVien.js"></script>

</body>
</html>