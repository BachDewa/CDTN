<?php
include("../includes/database.php");
include("includes/header.php");

// Xử lý biến page từ URL
$page = isset($_GET['page']) ? $_GET['page'] : '';

// Định nghĩa mảng các trang và file tương ứng
$page_files = [
    'pay_offline' => 'pay_offline.php',
    'edit_account' => 'edit_account.php',
    'change_pass' => 'change_pass.php',
    'delete_account' => 'delete_account.php',
    '' => 'my_orders.php' // Trang mặc định
];

// Lấy file tương ứng với trang được chọn
$page_file = isset($page_files[$page]) ? $page_files[$page] : $page_files[''];

// Kiểm tra nếu có yêu cầu đăng xuất
if (isset($_GET['logout'])) {
    include("logout.php");
}

// Kiểm tra nếu có yêu cầu xóa tài khoản
if (isset($_GET['delete_account'])) {
    include("delete_account.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cô gái tóc mây</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div id="content" class="container mx-auto py-8">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-3">
                <?php include("includes/sidebar.php"); ?>
            </div>
            <div class="col-span-9">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <?php include($page_file); ?>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
