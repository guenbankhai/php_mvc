<?php
// Tạo hàm để hiển thị thanh phân trang
function displayPagination($totalPages, $currentPage, $controller, $action, $input)
{
    echo '<div class="pagination">';

    // Xây dựng URL cơ bản
    $baseURL = '?controller='.$controller;

    // Nếu có action được chỉ định, thêm action vào URL cơ bản
    if ($action !== null) {
        $baseURL .= '&action='.$action;
    }

    if ($input !== null) {
        $baseURL .= '&input='.$input;
    }

    // Hiển thị nút đến trang đầu tiên
    echo '<a href="'.$baseURL.'&page=1">&laquo;</a>';

    // Hiển thị nút đến trang kế trước (nếu không ở trang đầu tiên)
    if ($currentPage > 1) {
        echo '<a href="'.$baseURL.'&page='.($currentPage - 1).'">&lsaquo;</a>';
    }

    // Hiển thị các trang gần trang hiện tại
    $maxPagesToShow = 12; // Số trang tối đa để hiển thị
    $halfPagesToShow = floor($maxPagesToShow / 2);
    $startPage = max(1, $currentPage - $halfPagesToShow);
    $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);

    for ($page = $startPage; $page <= $endPage; $page++) {
        if ($page == $currentPage) {
            echo '<a href="'.$baseURL.'&page='.$page.'" class="active">'.$page.'</a>';
        } else {
            echo '<a href="'.$baseURL.'&page='.$page.'">'.$page.'</a>';
        }
    }

    // Hiển thị nút đến trang kế tiếp (nếu không ở trang cuối cùng)
    if ($currentPage < $totalPages) {
        echo '<a href="'.$baseURL.'&page='.($currentPage + 1).'">&rsaquo;</a>';
    }

    // Hiển thị nút đến trang cuối cùng
    echo '<a href="'.$baseURL.'&page='.$totalPages.'">&raquo;</a>';

    echo '</div>';
}
?>
