// Hàm xử lý hiện và ẩn addForm
function showForm(inputForm) {
    var form = document.getElementById(inputForm);
    //Nếu addForm đang có display là none đổi thành block nếu không đổi thành none
    form.style.display = form.style.display === "none" ? "block" : "none";
}

// Hàm kiểm tra giá trị của các input và select
function checkFormCompletion(formId) {
    const form = document.getElementById(formId);
    if (!form) return; // Kiểm tra nếu không tìm thấy form
    // Lấy danh sách các input và select trong form
    const inputs = form.querySelectorAll('input, select');
    let isComplete = true;
    // Kiểm tra từng input và select
    inputs.forEach(input => {
        if (input.value === '' || (input.tagName === 'SELECT' && input.value === '')) {
            isComplete = false;
        }
    });
    // Lấy nút submit trong form
    const submitButton = form.querySelector('button[type="submit"]');
    // Kích hoạt hoặc vô hiệu hóa nút submit dựa trên kết quả kiểm tra
    if (submitButton) {
        submitButton.disabled = !isComplete;
    }
}

// Hàm xử lý huỷ addForm
function cancelForm(formId) {
    const form = document.getElementById(formId);
    if (form) {
        // Reset giá trị của các input và select trong form
        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.value = '';
        });
        form.style.display = "none";
        // Vô hiệu hóa nút submit
        const submitButton = form.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.disabled = true;
        }
    }
}
// Sự kiện DOMContentLoaded - toàn bộ cấu trúc HTML đã được tải và biên dịch thành cây DOM hoàn chỉnh
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addForm');
    if (form) {
        form.addEventListener('input', function() {
            checkFormCompletion('addForm');
        });
    }

    const formUpdate = document.getElementById('updateForm');
    if (formUpdate) {
        formUpdate.addEventListener('input', function() {
            checkFormCompletion('updateForm');
        });
    }
});

// Sự kiện Click - hiển thị lên form với các dữ liệu của dòng đang được chọn
document.getElementById('edit').addEventListener('click', function() {
    const table = document.querySelector('table');
    const selectedRows = JSON.parse(table.dataset.selectedRows);
    
    if (selectedRows.length !== 1) {
        alert('Vui lòng chọn một dòng để cập nhật.');
        return;
    }

    const selectedRowIndex = selectedRows[0];
    const selectedRow = table.rows[selectedRowIndex];

    // Lấy các giá trị từ dòng được chọn
    const maGV = selectedRow.cells[0].innerText.trim();
    const hoTen = selectedRow.cells[1].innerText.trim();
    const gioiTinh = selectedRow.cells[2].innerText.trim();
    const ngaySinh = selectedRow.cells[3].innerText.trim();
    const noiSinh = selectedRow.cells[4].innerText.trim();
    const soDT = selectedRow.cells[5].innerText.trim();
    const maTCM = selectedRow.cells[6].innerText.trim();

    // Đặt giá trị cho các trường trong form #addForm
    document.getElementById('updatemaGV').value = maGV;
    document.getElementById('updatehoTen').value = hoTen;
    document.getElementById('updategioiTinh').value = gioiTinh;
    document.getElementById('updatengaySinh').value = ngaySinh;
    document.getElementById('updatenoiSinh').value = noiSinh;
    document.getElementById('updatesoDT').value = soDT;
    document.getElementById('updatemaTCM').value = maTCM;

    var form = document.getElementById('updateForm');
    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.disabled = false;
    // Hiển thị form #addForm
    showForm('updateForm');
});

function importData() {
    const fileInput = document.getElementById('fileInput');
    const importButton = document.getElementById('importButton');

    // Kiểm tra xem người dùng đã chọn file chưa
    if (fileInput.files.length === 0) {
        alert('Vui lòng chọn file Excel để import.');
        return;
    }

    const file = fileInput.files[0];
    const formData = new FormData();
    formData.append('file', file);
    // Gửi dữ liệu file qua AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?controller=ThongTinGiaoVien&action=CapNhatExcel', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            // Xử lý kết quả từ server (nếu cần)
            console.log(xhr.responseText);
            alert('Import dữ liệu thành công.');
        } else {
            alert('Đã xảy ra lỗi trong quá trình import.');
        }
    };

    xhr.onerror = function() {
        alert('Đã xảy ra lỗi trong quá trình gửi yêu cầu.');
    };

    xhr.send(formData);
    // Disable nút import để tránh gửi lại nhiều lần
    importButton.disabled = true;
}
