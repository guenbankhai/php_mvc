// Sự kiện DOMContentLoaded - toàn bộ cấu trúc HTML đã được tải và biên dịch thành cây DOM hoàn chỉnh
document.addEventListener('DOMContentLoaded', function () {
    const table = document.querySelector('table');
    table.dataset.selectedRows = JSON.stringify([]);

    let lastSelectedRow = null;
    let isMouseDown = false;

    // Sự kiện click - nút chuột được nhấn trên một phần tử
    document.addEventListener('click', function (event) {
        // Nếu không phải là click vào bảng
        if (!event.target.closest('table')) {
            clearSelection();
            hideContextMenu();
        }
    });

    // Sự kiện mousedown - nút chuột được nhấn trên một phần tử
    table.addEventListener('mousedown', function (event) {
        const clickedRow = event.target.closest('tr');
        isMouseDown = true;
        // Nếu không giữ Shift và Ctrl
        if (!event.ctrlKey && !event.shiftKey) {
            clearSelection();
        }
        // Nếu giữ Shift và đã có dòng được chọn trước đó
        if (event.shiftKey && lastSelectedRow) {
            const clickedRowIndex = clickedRow.rowIndex;
            const lastSelectedRowIndex = lastSelectedRow.rowIndex;
            selectRowsInRange(lastSelectedRowIndex, clickedRowIndex);
        // Nếu không giữ Shift hoặc không có dòng được chọn trước đó
        } else {
            toggleRowSelection(clickedRow);
            lastSelectedRow = clickedRow;
        }
    });

    // Sự kiện mousemove - con trỏ chuột di chuyển qua một phần tử
    table.addEventListener('mousemove', function (event) {
        // Nếu sự hiện mousedow đang được kích hoạt
        if (isMouseDown) {
            const hoveredRow = event.target.closest('tr');
            // Nếu sự kiện xảy ra trên tr
            if (hoveredRow) {
                selectRow(hoveredRow);
            }
        }
    });

    // Sự kiện mouseup - nút chuột được nhả ra sau khi đã được nhấn trên một phần tử
    document.addEventListener('mouseup', function () {
        isMouseDown = false;
        const selectedRows = JSON.parse(table.dataset.selectedRows);
        // Nếu có dòng được chọn
        if (selectedRows.length > 0) {
            showContextMenu(event.pageX, event.pageY);
        // Nếu không dòng được chọn
        } else {
            hideContextMenu();
        }
    });

    // Hàm xử lý chọn một dòng
    function toggleRowSelection(row) {
        const rowIndex = row.rowIndex;
        let selectedRows = JSON.parse(table.dataset.selectedRows);
        // Nếu dòng đã được chọn
        if (selectedRows.includes(rowIndex)) {
            selectedRows = selectedRows.filter(index => index !== rowIndex);
            row.classList.remove('selected');
        // Nếu dòng chưa được chọn
        } else if (rowIndex !== 0){
            selectedRows.push(rowIndex);
            row.classList.add('selected');
        } else {
            return;
        }
        // Cập nhật thuộc tính dữ liệu trên table với danh sách mới
        table.dataset.selectedRows = JSON.stringify(selectedRows);
    }

    // Hàm xử lý chọn nhiều dòng trong một khoảng
    function selectRowsInRange(startIndex, endIndex) {
        const start = Math.min(startIndex, endIndex);
        const end = Math.max(startIndex, endIndex);
        let selectedRows = JSON.parse(table.dataset.selectedRows);
        for (let i = start; i <= end; i++) {
            //Nếu dòng đấy không có trong dánh sách các dòng đang chon và không phải là dòng đầu tiên
            if (!selectedRows.includes(i) && i !== 0) {
                selectedRows.push(i);
                table.rows[i].classList.add('selected');
            }
        }
        // Cập nhật thuộc tính dữ liệu trên table với danh sách mới
        table.dataset.selectedRows = JSON.stringify(selectedRows);
    }

    // Hàm xử lý chọn một dòng khi di chuột qua
    function selectRow(row) {
        const rowIndex = row.rowIndex;
        let selectedRows = JSON.parse(table.dataset.selectedRows);
        //Nếu dòng đấy không có trong dánh sách các dòng đang chon và không phải là dòng đầu tiên
        if (!selectedRows.includes(rowIndex) && rowIndex !== 0) {
            selectedRows.push(rowIndex);
            row.classList.add('selected');
        }
        // Cập nhật thuộc tính dữ liệu trên table với danh sách mới
        table.dataset.selectedRows = JSON.stringify(selectedRows);
    }

    // Hàm xóa hết các dòng đã chọn
    function clearSelection() {
        const selectedRows = JSON.parse(table.dataset.selectedRows);
        selectedRows.forEach(rowIndex => {
            const row = table.rows[rowIndex];
            //Nếu dòng đó có tồn tại
            if (row) {
                row.classList.remove('selected');
            }
        });
        // Đặt lại danh sách các dòng được chọn về rỗng
        table.dataset.selectedRows = JSON.stringify([]);
    }

    // Hàm xử lý hiện context menu tại vị trí chuột
    function showContextMenu(x, y) {
        const contextMenu = document.getElementById('context-menu');
        contextMenu.style.display = 'block';
        contextMenu.style.left = x + 'px';
        contextMenu.style.top = y + 'px';
        const editMenuItem = document.getElementById('edit');
        const deleteMenuItem = document.getElementById('delete');
        const selectedRows = JSON.parse(table.dataset.selectedRows);
        // Nếu chỉ có một dòng được chọn
        if (selectedRows.length === 1) {
            editMenuItem.style.display = 'block';
            deleteMenuItem.style.display = 'block';
        // Nếu có nhiều hơn một dòng được chọn
        } else {
            editMenuItem.style.display = 'none';
            deleteMenuItem.style.display = 'block';
        }
    }

    // Hàm ẩn context menu
    function hideContextMenu() {
        const contextMenu = document.getElementById('context-menu');
        contextMenu.style.display = 'none';
    }
});
