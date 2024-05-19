<center>
    <h1 class="text-2xl font-bold mb-4">Bạn có chắc chắn muốn xoá tài khoản?</h1>
    <form action="" method="post" class="space-y-4">
        <input type="submit" name="Yes" value="Có, tôi muốn xoá tài khoản" class="bg-red-500 text-white py-2 px-4 rounded cursor-pointer hover:bg-red-700 transition duration-300">

        <input type="submit" name="No" value="Không, tôi sẽ giữ lại tài khoản" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer hover:bg-blue-700 transition duration-300">
    </form>
</center>


<?php

$c_email = $_SESSION['customer_email'];

if (isset($_POST['Yes'])) {

    $delete_customer = "delete from customers where customer_email='$c_email'";

    $run_delete_customer = mysqli_query($conn, $delete_customer);

    if ($run_delete_customer) {

        session_destroy();

        echo "<script>alert('Xoá tài khoản thành công, cảm thấy tiếc vì điều này. Tạm biệt')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

if (isset($_POST['No'])) {

    echo "<script>window.open('my_account.php?my_orders','_self')</script>";
}

?>