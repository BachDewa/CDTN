<?php

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";

$run_customer = mysqli_query($conn, $get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$customer_name = $row_customer['customer_name'];

$customer_email = $row_customer['customer_email'];

$customer_contact = $row_customer['customer_contact'];

$customer_address = $row_customer['customer_address'];

$customer_image = $row_customer['customer_image'];

?>

<div class="container mx-auto">
    <div class="text-center">
        <h1 class="text-2xl font-bold">Chỉnh sửa thông tin</h1>
        <p class="text-gray-600">
            Nếu có bất kỳ câu hỏi gì, vui lòng liên hệ đến mục
            <a href="../lienhe.php" class="font-bold">Liên hệ</a>. Dịch vụ chăm sóc khách hàng làm việc
            <strong>24/7</strong>
        </p>
    </div>

    <hr class="my-4">

    <form action="" method="post" enctype="multipart/form-data" class="max-w-sm mx-auto">
        <div class="mb-4">
            <label for="c_name" class="block text-sm font-medium text-gray-700">Tên khách hàng</label>
            <input type="text" name="c_name" id="c_name" class="w-full border border-gray-300 p-2 rounded-lg" value="<?php echo $customer_name; ?>" required>
        </div>

        <div class="mb-4">
            <label for="c_email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="c_email" id="c_email" class="w-full border border-gray-300 p-2 rounded-lg" value="<?php echo $customer_email; ?>" required>
        </div>

        <div class="mb-4">
            <label for="c_contact" class="block text-sm font-medium text-gray-700">Liên hệ</label>
            <input type="text" name="c_contact" id="c_contact" class="w-full border border-gray-300 p-2 rounded-lg" value="<?php echo $customer_contact; ?>" required>
        </div>

        <div class="mb-4">
            <label for="c_address" class="block text-sm font-medium text-gray-700">Địa chỉ</label>
            <input type="text" name="c_address" id="c_address" class="w-full border border-gray-300 p-2 rounded-lg" value="<?php echo $customer_address; ?>" required>
        </div>

        <div class="mb-4">
            <label for="c_image" class="block text-sm font-medium text-gray-700">Ảnh đại diện</label>
            <input type="file" name="c_image" id="c_image" class="form-input mt-1 w-full" required>
            <img src="customer_images/<?php echo $customer_image; ?>" alt="Customer Image" class="mt-2 w-full h-48 object-cover">
        </div>

        <div class="text-center">
            <button name="update" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                <i class="fa fa-user-md mr-2"></i> Xác nhận cập nhật
            </button>
        </div>
    </form>
</div>

<?php

if (isset($_POST['update'])) {

    $update_id = $customer_id;

    $c_name = $_POST['c_name'];

    $c_email = $_POST['c_email'];

    $c_country = $_POST['c_country'];

    $c_city = $_POST['c_city'];

    $c_address = $_POST['c_address'];

    $c_contact = $_POST['c_contact'];

    $c_image = $_FILES['c_image']['name'];

    $c_image_tmp = $_FILES['c_image']['tmp_name'];

    move_uploaded_file($c_image_tmp, "customer_images/$c_image");

    $update_customer = "update customers set customer_name='$c_name',customer_email='$c_email',customer_country='$c_country',customer_city='$c_city',customer_address='$c_address',customer_contact='$c_contact',customer_image='$c_image' where customer_id='$update_id' ";

    $run_customer = mysqli_query($conn, $update_customer);

    if ($run_customer) {

        echo "<script>alert('Tài khoản của bạn được sửa thành công, để hoàn tất tiến trình, hãy đăng nhập lại')</script>";

        echo "<script>window.open('logout.php','_self')</script>";
    }
}

?>
