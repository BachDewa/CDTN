<?php
session_start();

if (!isset($_SESSION['customer_email'])) {
    echo "<script>window.open('../checkout.php','_self')</script>";
} else {

    include("includes/database.php");
    include("functions/functions.php");

    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/output.css" rel="stylesheet">
    <title>My Website</title>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <div id="top" class="bg-gray-200 py-2">
        <div class="container mx-auto flex justify-between items-center">
            <div class="offer text-sm">
                <a href="#" class="btn btn-success btn-sm">
                    <?php
                    if (!isset($_SESSION['customer_email'])) {
                        echo "Chào mừng: Quý khách";
                    } else {
                        echo "Chào mừng: " . $_SESSION['customer_email'];
                    }
                    ?>
                </a>
                <a href="checkout.php" class="text-sm">
                    <?php items(); ?> sản phẩm trong giỏ hàng | Tổng tiền: <?php total_price(); ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <div id="navbar" class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4">
            <a href="../index.php" class="navbar-brand home">
                <img src="images/logo.jpg" alt="" class="block md:hidden h-10">
                <img src="images/logo.jpg" alt="" class="hidden md:block h-12">
            </a>
            <div class="navbar-collapse md:flex justify-end items-center space-x-4">
                <a href="../index.php" class="nav-link">Trang chủ</a>
                <a href="../cuahang.php" class="nav-link">Cửa hàng</a>
                <a href="my_account.php" class="nav-link active">Tài khoản của tôi</a>
                <a href="../giohang.php" class="nav-link">Giỏ hàng</a>
                <a href="../lienhe.php" class="nav-link">Liên hệ chúng tôi</a>
                <a href="../giohang.php" class="btn btn-primary">
                    <i class="fa fa-shopping-cart"></i>
                    <span><?php items(); ?> sản phẩm trong giỏ hàng</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Content của sản phẩm -->
    <div id="content" class="container mx-auto py-8">
        <div class="flex justify-between items-center">
            <ul class="breadcrumb">
                <li><a href="../index.php">Trang chủ</a></li>
                <li>Tài khoản của tôi</li>
            </ul>
        </div>

        <div class="flex">
            <div class="w-1/4">
                <?php include("includes/sidebar.php"); ?>
            </div>

            <div class="w-3/4">
                <div class="box p-6">
                    <h1 class="text-2xl text-center mb-4">Xác nhận thanh toán</h1>
                    <form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="invoice_no" class="block text-gray-700">Mã hoá đơn</label>
                            <input type="text" class="w-full border border-gray-300 p-2 rounded-lg" name="invoice_no" id="invoice_no" required>
                        </div>
                        <div class="mb-4">
                            <label for="amount_sent" class="block text-gray-700">Số tiền gửi</label>
                            <input type="text" class="w-full border border-gray-300 p-2 rounded-lg" name="amount_sent" id="amount_sent" required>
                        </div>
                        <div class="mb-4">
                            <label for="payment_mode" class="block text-gray-700">Chọn hình thức thanh toán</label>
                            <select name="payment_mode" id="payment_mode" class="w-full border border-gray-300 p-2 rounded-lg" required>
                                <option disabled selected>Chọn hình thức thanh toán</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                                <option value="4">Option 4</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="ref_no" class="block text-gray-700">Mã giao dịch</label>
                            <input type="text" class="w-full border border-gray-300 p-2 rounded-lg" name="ref_no" id="ref_no" required>
                        </div>
                        <div class="mb-4">
                            <label for="date" class="block text-gray-700">Ngày thanh toán</label>
                            <input type="date" class="w-full border border-gray-300 p-2 rounded-lg" name="date" id="date" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                                <i class="fa fa-user-md mr-2"></i> Xác nhận thanh toán
                            </button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['confirm_payment'])) {
                        $update_id = $_GET['update_id'];
                        $invoice_no = $_POST['invoice_no'];
                        $amount = $_POST['amount_sent'];
                        $payment_mode = $_POST['payment_mode'];
                        $ref_no = $_POST['ref_no'];
                        $code = $_POST['code'];
                        $payment_date = $_POST['date'];

                        $complete = "Hoàn tất";

                        $insert_payment = "INSERT INTO payments (invoice_no, amount, payment_mode, ref_no, code, payment_date) VALUES ('$invoice_no', '$amount', '$payment_mode',$ref_no', '$code', '$payment_date')";
                        $run_payment = mysqli_query($conn, $insert_payment);

                        $update_customer_order = "UPDATE customer_orders SET order_status='$complete' WHERE order_id='$update_id'";
                        $run_customer_order = mysqli_query($conn, $update_customer_order);

                        $update_pending_order = "UPDATE pending_orders SET order_status='$complete' WHERE order_id='$update_id'";
                        $run_pending_order = mysqli_query($conn, $update_pending_order);

                        if ($run_pending_order) {
                            echo "<script>alert('Cảm ơn đã mua hàng của chúng tôi, đơn đặt hàng của bạn sẽ được hoàn tất trong 24h tới')</script>";
                            echo "<script>window.open('my_account.php?my_orders','_self')</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Kết thúc content của sản phẩm -->

    <?php
    include("includes/footer.php");
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
<?php } ?>

