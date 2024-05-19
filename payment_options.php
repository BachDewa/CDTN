<div class="box p-6 border border-gray-300 shadow-md">
    <?php
    $session_email = $_SESSION['customer_email'];

    $select_customer = "select * from customers where customer_email='$session_email'";
    $run_customer = mysqli_query($conn, $select_customer);
    $row_customer = mysqli_fetch_array($run_customer);

    $customer_id = $row_customer['customer_id'];
    ?>

    <h1 class="text-center text-2xl font-bold">Hình thức thanh toán</h1>
    <p class="lead text-center mt-4">
        <a href="order.php?c_id=<?php echo $customer_id ?>" class="text-blue-500 hover:underline">Thanh toán offline</a>
    </p>

    <center class="mt-6">
        <p class="lead">
            <a href="#" class="text-blue-500 hover:underline">
                Thanh toán bằng AirPay
                <hr class="my-4 border-t border-gray-300">
                <img class="img-responsive mx-auto" src="images/paypal_logo.jpg" alt="img-airpay">
            </a>
        </p>
    </center>
</div>
