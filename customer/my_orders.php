<div class="bg-white p-6">
    <h1 class="text-center text-3xl font-bold mb-4">Đơn hàng của tôi</h1>
    <p class="text-muted text-center mb-4">
        Nếu có bất kỳ câu hỏi gì, vui lòng liên hệ đến mục
        <a href="../lienhe.php" class="font-bold">Liên hệ</a>. Dịch vụ chăm sóc khách hàng làm việc
        <span class="font-bold">24/7</span>
    </p>

    <hr class="my-6">

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2">STT</th>
                    <th class="px-4 py-2">Số tiền</th>
                    <th class="px-4 py-2">Mã hoá đơn</th>
                    <th class="px-4 py-2">Số lượng</th>
                    <th class="px-4 py-2">Kích cỡ</th>
                    <th class="px-4 py-2">Ngày đặt hàng</th>
                    <th class="px-4 py-2">Tình trạng</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>

            <tbody>
                <?php
                $session_email = $_SESSION['customer_email'];
                $get_customer = "select * from customers where customer_email='$session_email'";
                $run_customer = mysqli_query($conn, $get_customer);
                $row_customer = mysqli_fetch_array($run_customer);
                $customer_id = $row_customer['customer_id'];
                $get_orders = "select * from customer_orders where customer_id='$customer_id'";
                $run_orders = mysqli_query($conn, $get_orders);
                $i = 0;
                while ($row_orders = mysqli_fetch_array($run_orders)) {
                    $order_id = $row_orders['order_id'];
                    $due_amount = $row_orders['due_amount'];
                    $invoice_no = $row_orders['invoice_no'];
                    $qty = $row_orders['qty'];
                    $size = $row_orders['size'];
                    $order_date = substr($row_orders['order_date'], 0, 11);
                    $order_status = ($row_orders['order_status'] == 'Đang chờ xử lý') ? 'Chưa thanh toán' : 'Đã thanh toán';
                    $i++;
                ?>
                <tr>
                    <td class="px-4 py-2"><?php echo $i; ?></td>
                    <td class="px-4 py-2"><?php echo $due_amount; ?> đ</td>
                    <td class="px-4 py-2"><?php echo $invoice_no; ?></td>
                    <td class="px-4 py-2"><?php echo $qty; ?></td>
                    <td class="px-4 py-2"><?php echo $size; ?></td>
                    <td class="px-4 py-2"><?php echo $order_date; ?></td>
                    <td class="px-4 py-2"><?php echo $order_status; ?></td>
                    <td class="px-4 py-2">
                        <a href="confirm.php?order_id=<?php echo $order_id; ?>" target="_blank"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Xác nhận
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
