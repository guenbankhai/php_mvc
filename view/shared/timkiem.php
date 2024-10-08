<?php
session_start();

if (isset($_POST['searchInput'])) {
    $searchValue = $_POST['searchInput'];

    // Thực hiện xử lý tìm kiếm dựa trên $searchValue
    // Ví dụ: redirect đến trang kết quả tìm kiếm
    $controller = $_GET['controller'];
    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

    // Chuyển hướng đến action timkiem với thông tin cần thiết
    exit();
}

// Xử lý các trường hợp khác nếu cần
?>
