<?php
$active = 'Tài khoản của tôi';
include("includes/header.php");

?>

<div id="content">
    <div class="container mx-auto px-4">
        <div class="w-full mb-4">
            <ul class="breadcrumb flex space-x-2 text-gray-700">
                <!--Thu tu trang-->
                <li>
                    <a href="index.php" class="text-blue-500 hover:underline">Trang chủ</a>
                </li>
                <li class="text-gray-500">
                    Đăng ký
                </li>
            </ul>
        </div>

        <div class="w-full lg:w-1/4 mb-4">
            <?php
            include("includes/sidebar.php");
            ?>
        </div>

        <div class="w-full lg:w-3/4">
            <div class="box border border-gray-300 p-4 mb-4">
                <div class="box-header text-center">
                    <h2 class="text-2xl font-bold">Đăng ký người dùng mới</h2>
                </div>

                <form action="khach_dangky.php" method="post" enctype="multipart/form-data" class="space-y-4">
                    <div class="form-group">
                        <label class="block text-gray-700">Họ và tên của bạn</label>
                        <input type="text" placeholder="Nhập họ và tên" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="c_name" required>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700">Email của bạn</label>
                        <input type="email" placeholder="Nhập Email" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="c_email" required>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700">Mật khẩu của bạn</label>
                        <input type="password" placeholder="Nhập mật khẩu" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="c_pass" required>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700">Nhập lại mật khẩu</label>
                        <input type="password" placeholder="Nhập lại mật khẩu" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="c_pass_a" required>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700">Tên tỉnh nơi sinh sống</label>
                        <input type="text" placeholder="Nhập tên tỉnh" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="c_country" required>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700">Tên thành phố/quận/huyện sinh sống</label>
                        <input type="text" placeholder="Nhập tên thành phố/quận/huyện" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="c_city" required>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700">Liên hệ</label>
                        <input type="text" placeholder="Email hoặc số điện thoại" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="c_contact" required>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700">Địa chỉ</label>
                        <input type="text" placeholder="Nhập địa chỉ" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="c_address" required>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700">Hình ảnh đại diện</label>
                        <input type="file" class="form-control form-height-custom mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="c_image" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="register" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            <i class="fa fa-user-md"></i> Đăng ký
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Ket thuc content cua san pham-->


<?php

include("includes/footer.php");

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function callDelele() {
    var pro_id = document.getElementById("pro_id").value;
    window.location.href = "delete_item.php?pro_id=" + pro_id;
}
</script>

<script>
function callUpdate_Qty(pro_id, pro_qty) {
    window.location.href = "update_qty.php?pro_id=" + pro_id + "&qty=" + pro_qty;
}
</script>

</body>

</html>


<?php

if (isset($_POST['register'])) {
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_pass_a = $_POST['c_pass_a'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_ip = getRealIpUser();

    move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

    if ($c_pass != $c_pass_a) {
        echo "<script>alert('Xác nhận mật khẩu không khớp, vui lòng kiểm tra lại')</script>";
    } else {
        $insert_customer = "insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip) 
        values ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip')";

        $run_customer = mysqli_query($conn, $insert_customer);
        $sel_cart = "select * from cart where ip_add='$c_ip'";
        $run_cart = mysqli_query($conn, $sel_cart);

        $check_cart = mysqli_num_rows($run_cart);

        if ($check_cart > 0) {

            //Neu dang ky co san pham trong gio hang
            $_SESSION['customer_email'] = $c_email;
            //echo "<script>alert('$c_name $c_email $c_pass $c_country $c_city $c_contact $c_address $c_image $c_ip')</script>";
            echo "<script>alert('Đăng ký tài khoản thành công (1)')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        } else {

            //Neu dang ky ma khong co san pham trong gio hang
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Đăng ký tài khoản thành công (2)')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}

?>

</body>