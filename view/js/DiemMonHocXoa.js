document.getElementById('delete').addEventListener('click', function () {
    const table = document.querySelector('table');
    const selectedRows = JSON.parse(table.dataset.selectedRows);

    if (selectedRows.length === 0) {
        alert('Không có dòng nào được chọn để xoá.');
        return; // Ngăn không cho tiếp tục nếu không có dòng nào được chọn
    }

    // Tạo một mảng để lưu trữ các đối tượng dữ liệu từ các dòng được chọn
    const selectedRowsData = [];

    selectedRows.forEach(rowIndex => {
        const selectedRow = table.rows[rowIndex];
        const maHS = selectedRow.cells[0].innerText.trim();
        const maMH = selectedRow.cells[2].innerText.trim();
        const namHoc = selectedRow.cells[4].innerText.trim();
        const hocKy = selectedRow.cells[5].innerText.trim();

        // Thêm đối tượng dữ liệu vào mảng
        selectedRowsData.push({
            maHS: maHS,
            maMH: maMH,
            namHoc: namHoc,
            hocKy: hocKy
        });
    });

    // Chuyển đổi mảng thành JSON và gán vào trường input ẩn trong form
    document.getElementById('selectedRowsData').value = JSON.stringify(selectedRowsData);

    // Gọi hàm để gửi form
    submitDeleteForm();
});

// Hàm gửi form
function submitDeleteForm() {
    document.getElementById('deleteSubmitButton').click(); // Kích hoạt sự kiện click của nút ẩn để gửi form
}
