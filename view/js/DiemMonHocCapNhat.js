// Hàm xử lý hiện và ẩn addForm
function showForm() {
    var form = document.getElementById("addForm");
    //Nếu addForm đang có display là none đổi thành block nếu không đổi thành none
    form.style.display = form.style.display === "none" ? "block" : "none";
}

// Hàm xử lý huỷ addForm
function cancelForm() {
    var form = document.getElementById("addForm");
    var allInputs = form.querySelectorAll('input[type="text"]');
    var allSelects = form.querySelectorAll('select');
    // Xóa nội dung của các phần tử thông báo lỗi
    var errorMessages = form.querySelectorAll('.error-message');
    errorMessages.forEach(function(errorMessage) {
        errorMessage.textContent = '';
    });
    // Ẩn form đi
    form.style.display = "none";
    // Xóa thông tin đã nhập và các lựa chọn trước đó
    allInputs.forEach(function(input) {
        input.value = '';
    });
    allSelects.forEach(function(select) {
        select.value = '';
    });
    // Đặt lại trạng thái của nút Submit
    document.getElementById('submitButton').disabled = true;
    // Ẩn điểm trung bình
    document.getElementById('diemTBSpan').textContent = '';
}

// Sự kiện DOMContentLoaded - toàn bộ cấu trúc HTML đã được tải và biên dịch thành cây DOM hoàn chỉnh
document.addEventListener('DOMContentLoaded', function() {
    // Lắng nghe sự kiện khi một select thay đổi giá trị
    var selects = document.querySelectorAll('select');
    selects.forEach(function(select) {
        select.addEventListener('change', function() {
            var allSelected = true;
            selects.forEach(function(sel) {
                if (sel.value === '') {
                    allSelected = false;
                }
            });
            var submitButton = document.getElementById('submitButton');
            // Nếu tất cả các select đều có giá trị
            if (allSelected) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        });
    });
});

//Hàm tính điểm trung bình và hiển thị nếu các input hợp lệ
function calculateAverage() {
    var diemHS1 = parseFloat(document.getElementById('diemHS1').value);
    var diemHS2 = parseFloat(document.getElementById('diemHS2').value);
    var diemHS3 = parseFloat(document.getElementById('diemHS3').value);
    var diemTBElement = document.getElementById('diemTBSpan');

    // Nếu có ít nhất một input không hợp lệ hoặc trống
    if (isNaN(diemHS1) || isNaN(diemHS2) || isNaN(diemHS3) || diemHS1 < 0 || diemHS1 > 10 || diemHS2 < 0 || diemHS2 > 10 || diemHS3 < 0 || diemHS3 > 10) {
        diemTBElement.textContent = "";
        return;
    }
    // Hiển thị điểm trung bình
    var diemTB = ((diemHS1 + diemHS2 + diemHS3) / 3).toFixed(1);
    diemTBElement.textContent = "Điểm trung bình: " + diemTB;
}

// Hàm kích hoạt submit
function validateInput(inputId, value) {
    var inputElement = document.getElementById(inputId);
    var errorMessageElement = document.getElementById(inputId + "Error");
    // Nếu giá trị chứa ký tự không hợp lệ
    if (isNaN(value) || /[^\d.]/.test(value)) {
        errorMessageElement.textContent = "Vui lòng nhập giá trị số từ 0.0 đến 10.0";
        inputElement.setCustomValidity("invalid");
    // Nếu giá trị không từ khoảng 0 tới 10
    } else {
        var floatValue = parseFloat(value);
        if (floatValue < 0 || floatValue > 10) {
            errorMessageElement.textContent = "Vui lòng nhập giá trị từ 0.0 đến 10.0";
            inputElement.setCustomValidity("invalid");
        } else {
            errorMessageElement.textContent = "";
            inputElement.setCustomValidity("");
        }
    }
    calculateAverage();

    // Nếu có input có giá trị không hợp lệ
    var inputs = document.querySelectorAll('input[type="text"]');
    var allInputsValid = true;
    inputs.forEach(function(input) {
        if (input.value !== "" && input.checkValidity() === false) {
            allInputsValid = false;
        }
    });

    //Nếu có select không có giá trị
    var selects = document.querySelectorAll('select');
    var allSelected = true;
    selects.forEach(function(select) {
        if (select.value === '') {
            allSelected = false;
        }
    });

    // Nếu tất cả select có giá trị và tất cả input có giá trị hợp lệ
    var submitButton = document.getElementById('submitButton');
    if (allSelected && allInputsValid) {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
}

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
    const maHS = selectedRow.cells[0].innerText.trim();
    const maMH = selectedRow.cells[2].innerText.trim();
    const namHoc = selectedRow.cells[4].innerText.trim();
    const hocKy = selectedRow.cells[5].innerText.trim();
    const diemHS1 = selectedRow.cells[6].innerText.trim();
    const diemHS2 = selectedRow.cells[7].innerText.trim();
    const diemHS3 = selectedRow.cells[8].innerText.trim();

    // Đặt giá trị cho các trường trong form #addForm
    document.getElementById('maHS').value = maHS;
    document.getElementById('maMH').value = maMH;
    document.getElementById('namHoc').value = namHoc;
    document.getElementById('hocKy').value = hocKy;
    document.getElementById('diemHS1').value = diemHS1;
    document.getElementById('diemHS2').value = diemHS2;
    document.getElementById('diemHS3').value = diemHS3;

    // Tính điểm trung bình và hiển thị
    calculateAverage();
    submitButton.disabled = false;
    // Hiển thị form #addForm
    showForm();
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
    xhr.open('POST', 'index.php?controller=QuanLyDiem&action=CapNhatExcel', true);

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
