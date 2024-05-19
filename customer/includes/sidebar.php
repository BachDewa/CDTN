<div class="bg-white rounded-lg shadow-md p-6">
    <?php
    $session_email = $_SESSION['customer_email'];
    $select_customer = "select * from customers where customer_email='$session_email'";
    $run_customer = mysqli_query($conn, $select_customer);
    $row_customer = mysqli_fetch_array($run_customer);

    $customer_image = $row_customer['customer_image'];
    $customer_name = $row_customer['customer_name'];

    if (isset($_SESSION['customer_email'])) {
    ?>
        <div class="text-center">
            <img class="w-52 h-52 rounded-full mx-auto mb-4" src="../customer/customer_images/customer.jpg" alt="Customer Image">
            <h1 class="text-xl font-bold"><?php echo $customer_name; ?></h1>
        </div>
    <?php
    }
    ?>

    <ul class="space-y-4">
        <li class="<?php echo isset($_GET['my_orders']) ? 'bg-gray-100' : ''; ?>">
            <a href="my_account.php?page=my_orders" class="flex items-center space-x-2 py-2 px-4 rounded-lg transition duration-300 <?php echo isset($_GET['my_orders']) ? 'text-blue-500' : 'text-gray-600'; ?>">
                <i class="fa fa-list"></i>
                <span>Đơn hàng của tôi</span>
            </a>
        </li>

        <li class="<?php echo isset($_GET['pay_offline']) ? 'bg-gray-100' : ''; ?>">
            <a href="my_account.php?page=pay_offline" class="flex items-center space-x-2 py-2 px-4 rounded-lg transition duration-300 <?php echo isset($_GET['pay_offline']) ? 'text-blue-500' : 'text-gray-600'; ?>">
                <i class="fa fa-bolt"></i>
                <span>Thanh toán offline</span>
            </a>
        </li>

        <li class="<?php echo isset($_GET['edit_account']) ? 'bg-gray-100' : ''; ?>">
            <a href="my_account.php?page=edit_account" class="flex items-center space-x-2 py-2 px-4 rounded-lg transition duration-300 <?php echo isset($_GET['edit_account']) ? 'text-blue-500' : 'text-gray-600'; ?>">
                <i class="fa fa-pencil"></i>
                <span>Chỉnh sửa thông tin</span>
            </a>
        </li>

        <li class="<?php echo isset($_GET['change_pass']) ? 'bg-gray-100' : ''; ?>">
            <a href="my_account.php?page=change_pass" class="flex items-center space-x-2 py-2 px-4 rounded-lg transition duration-300 <?php echo isset($_GET['change_pass']) ? 'text-blue-500' : 'text-gray-600'; ?>">
                <i class="fa fa-user"></i>
                <span>Thay đổi mật khẩu</span>
            </a>
        </li>

        <li class="<?php echo isset($_GET['delete_account']) ? 'bg-gray-100' : ''; ?>">
            <a href="my_account.php?page=delete_account" class="flex items-center space-x-2 py-2 px-4 rounded-lg transition duration-300 <?php echo isset($_GET['delete_account']) ? 'text-blue-500' : 'text-gray-600'; ?>">
                <i class="fa fa-trash-o"></i>
                <span>Xoá tài khoản</span>
            </a>
        </li>

        <li>
            <a href="logout.php" class="flex items-center space-x-2 py-2 px-4 rounded-lg transition duration-300 text-gray-600 hover:text-blue-500">
                <i class="fa fa-sign-out"></i>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</div>
