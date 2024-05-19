<?php
$active = 'Giỏ hàng';
include("includes/header.php");
?>

<div id="content" class="container mx-auto">
    <div class="grid grid-cols-12 gap-4">
        <!-- Phần breadcrumb -->
        <!-- <div class="col-span-12">
            <ul class="breadcrumb">
                <li>
                    <a href="index.php" class="text-blue-500">Trang chủ</a>
                </li>
                <li>
                    Giỏ hàng
                </li>
            </ul>
        </div> -->

        <!-- Danh sách sản phẩm (9 cột trên màn hình lớn) -->
        <div id="cart" class="col-span-12 lg:col-span-9 my-2">
            <div class="box p-4 bg-white rounded-lg shadow-md">
                <form action="order.php" method="post">
                    <h1 class="text-2xl font-semibold mb-4">Giỏ hàng của bạn</h1>

                    <?php
                    $ip_add = getRealIpUser();
                    $select_cart = "SELECT * FROM cart WHERE ip_add='$ip_add'";
                    $run_cart = mysqli_query($conn, $select_cart);
                    $count = mysqli_num_rows($run_cart);
                    ?>

                    <p class="text-gray-600 mb-4"><?php echo $count; ?> sản phẩm hiện có trong giỏ hàng</p>
                    <div class="table-responsive">
                        <table class="w-full border-collapse border">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">Sản phẩm</th>
                                    <th class="border px-4 py-2">Số lượng</th>
                                    <th class="border px-4 py-2">Đơn giá</th>
                                    <th class="border px-4 py-2">Tổng tiền</th>
                                    <th class="border px-4 py-2">Xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                while ($row_cart = mysqli_fetch_array($run_cart)) {
                                    $pro_id = $row_cart['p_id'];
                                    $pro_size = $row_cart['size'];
                                    $pro_qty = $row_cart['qty'];

                                    $get_product = "SELECT * FROM products WHERE product_id='$pro_id'";
                                    $run_product = mysqli_query($conn, $get_product);

                                    if ($row_product = mysqli_fetch_array($run_product)) {
                                        $product_title = $row_product['product_title'];
                                        $product_img = $row_product['product_img'];
                                        $only_price = $row_product['product_price'];
                                        $sub_total = $only_price * $pro_qty;
                                        $total += $sub_total;
                                ?>
                                        <tr>
                                            <td class="border px-4 py-2">
                                                <div class="flex items-center space-x-4">
                                                    <img src="admin_area/product_images/<?php echo $product_img; ?>" alt="<?php echo $product_title; ?>" class="w-16 h-16 rounded-lg">
                                                    <span><?php echo $product_title; ?></span>
                                                </div>
                                            </td>
                                            <td class="border px-4 py-2">
                                                <input type="number" min="1" value="<?php echo $pro_qty; ?>" onchange="updateQuantity(<?php echo $pro_id; ?>, this.value)" class="w-16 px-2 py-1 border rounded focus:outline-none focus:ring focus:ring-blue-300">
                                            </td>
                                            <td class="border px-4 py-2"><?php echo number_format($only_price) . ' đ'; ?></td>
                                            <td class="border px-4 py-2"><?php echo number_format($sub_total) . ' đ'; ?></td>
                                            <td class="border px-4 py-2">
                                                <button type="button" onclick="deleteCartItem(<?php echo $pro_id; ?>)" class="text-red-600 hover:text-red-800 focus:outline-none">Xoá</button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tổng tiền -->
                    <div class="mt-4">
                        <div class="flex justify-between">
                            <span class="font-semibold">Tổng tiền:</span>
                            <span class="font-semibold"><?php echo number_format($total) . ' đ'; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Phí vận chuyển:</span>
                            <span>30,000 đ</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Thuế (10%):</span>
                            <span><?php echo number_format($total * 0.1) . ' đ'; ?></span>
                        </div>
                        <div class="flex justify-between mt-4 border-t pt-4">
                            <span class="font-semibold">Tổng thanh toán:</span>
                            <span class="font-semibold"><?php echo number_format($total * 1.1 + 30000) . ' đ'; ?></span>
                        </div>
                    </div>

                    <!-- Footer của form (nút Quay lại cửa hàng và Tiến hành thanh toán) -->
                    <div class="flex justify-end mt-4 space-x-4">
                        <a href="cuahang.php" class="btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-full">
                            <i class="fa fa-chevron-circle-left mr-2"></i> Quay lại cửa hàng
                        </a>
                        <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
                            Tiến hành thanh toán <i class="fa fa-chevron-right ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar (3 cột trên màn hình lớn) -->
        <div class="col-span-12 lg:col-span-3">
            <div id="order-summary" class="box p-4 bg-white rounded-lg shadow-md">
                <div class="box-header">
                    <h3 class="text-xl font-semibold">Tổng tiền đơn hàng</h3>
                </div>
                <p class="text-gray-600">Đã tính bao gồm thuế và phí vận chuyển</p>
                <div class="table-responsive">
                    <table class="table w-full">
                        <tbody>
                            <tr>
                                <td> Tổng đơn hàng </td>
                                <th> <?php echo number_format($total) . ' đ'; ?></th>
                            </tr>
                            <tr>
                                <td> Phí vận chuyển và ship </td>
                                <td> 30,000 đ</td>
                            </tr>
                            <tr>
                                <td> Thuế (10%) </td>
                                <th> <?php echo number_format($total * 0.1) . ' đ'; ?> </th>
                            </tr>
                            <tr class="total">
                                <td> Tổng thanh toán </td>
                                <th> <?php echo number_format($total * 1.1 + 30000) . ' đ'; ?> </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Sản phẩm liên quan -->
    <div class="grid grid-cols-12 gap-4 mt-8 mb-8">
        <div class="col-span-12">
            <div class="box p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-center text-2xl font-semibold mb-4">Sản phẩm khác</h3>
            </div>
        </div>

        <?php
        $get_products = "SELECT * FROM products ORDER BY RAND() LIMIT 0,3";
        $run_products = mysqli_query($conn, $get_products);

        while ($row_products = mysqli_fetch_array($run_products)) {
            $pro_id = $row_products['product_id'];
            $pro_title = $row_products['product_title'];
            $pro_price = $row_products['product_price'];
            $pro_img = $row_products['product_img'];
        ?>
            <div class="col-span-6 md:col-span-4 lg:col-span-4 xl:col-span-4">
                <div class="box p-4 bg-white rounded-lg shadow-md">
                    <a href="chitiet.php?pro_id=<?php echo $pro_id; ?>">
                        <img src="admin_area/product_images/<?php echo $pro_img; ?>" alt="<?php echo $pro_title; ?>" class="w-full h-48 object-cover mb-2 rounded-lg">
                        <h3 class="text-lg font-semibold text-center"><?php echo $pro_title; ?></h3>
                        <p class="text-center font-bold text-gray-700"><?php echo number_format($pro_price) . ' đ'; ?></p>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
include("includes/footer.php");
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function deleteCartItem(pro_id) {
        if (confirm('Bạn có chắc chắn muốn xoá sản phẩm này?')) {
            window.location.href = "delete_item.php?pro_id=" + pro_id;
        }
    }

    function updateQuantity(pro_id, new_qty) {
        window.location.href = "update_qty.php?pro_id=" + pro_id + "&qty=" + new_qty;
    }
</script>

</body>

</html>