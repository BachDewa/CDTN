<div class="container mx-auto">
    <h1 class="text-center text-3xl font-bold mt-8">Thay đổi mật khẩu</h1>
    <p class="text-center text-gray-500 mt-4">
        Nếu có bất kỳ câu hỏi gì, vui lòng liên hệ đến mục
        <a href="../lienhe.php" class="text-blue-500 font-bold">Liên hệ</a>.
        Dịch vụ chăm sóc khách hàng làm việc <strong>24/7</strong>.
    </p>

    <hr class="my-8">

    <form action="" method="post" class="max-w-md mx-auto">
        <div class="mb-4">
            <label for="old_pass" class="block text-sm font-medium text-gray-700">Mật khẩu cũ của bạn</label>
            <input type="password" name="old_pass" id="old_pass" class="w-full border border-gray-300 p-2 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="new_pass" class="block text-sm font-medium text-gray-700">Mật khẩu mới của bạn</label>
            <input type="password" name="new_pass" id="new_pass" class="w-full border border-gray-300 p-2 rounded-lg" required>
        </div>

        <div class="mb-6">
            <label for="new_pass_again" class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu mới</label>
            <input type="password" name="new_pass_again" id="new_pass_again" class="w-full border border-gray-300 p-2 rounded-lg" required>
        </div>

        <div class="text-center">
            <button name="submit" type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                <i class="fa fa-user-md mr-2"></i> Xác nhận thay đổi
            </button>
        </div>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $c_email = $_SESSION['customer_email'];
    $c_old_pass = $_POST['old_pass'];
    $c_new_pass = $_POST['new_pass'];
    $c_new_pass_again = $_POST['new_pass_again'];

    $sel_c_old_pass = "select * from customers where customer_email='$c_email' and customer_pass='$c_old_pass'";
    $run_c_old_pass = mysqli_query($conn, $sel_c_old_pass);

    if (mysqli_num_rows($run_c_old_pass) == 0) {
        echo "<script>alert('Xin lỗi, mật khẩu không đúng. Vui lòng thử lại.')</script>";
        exit();
    }

    if ($c_new_pass != $c_new_pass_again) {
        echo "<script>alert('Xin lỗi, mật khẩu mới không khớp. Vui lòng nhập lại.')</script>";
        exit();
    }

    $update_c_pass = "update customers set customer_pass='$c_new_pass' where customer_email='$c_email'";
    $run_c_pass = mysqli_query($conn, $update_c_pass);

    if ($run_c_pass) {
        echo "<script>alert('Mật khẩu của bạn đã được thay đổi thành công.')</script>";
        echo "<script>window.open('my_account.php?my_orders','_self')</script>";
    }
}
?>
