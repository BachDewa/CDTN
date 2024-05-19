<?php
$active = 'Giỏ hàng';

include("includes/database.php");
include("includes/header.php");
?>

<?php
if (isset($_GET['pro_id'])) {
    $product_id = $_GET['pro_id'];

    $get_product = "select * from products where product_id='$product_id'";
    $run_product = mysqli_query($conn, $get_product);
    $row_product = mysqli_fetch_array($run_product);

    $p_cat_id = $row_product['p_cat_id'];
    $pro_title = $row_product['product_title'];
    $pro_price = $row_product['product_price'];
    $pro_desc = $row_product['product_desc'];
    $pro_img = $row_product['product_img'];

    $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";
    $run_p_cat = mysqli_query($conn, $get_p_cat);
    $row_p_cat = mysqli_fetch_array($run_p_cat);

    $p_cat_title = $row_p_cat['p_cat_title'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/output.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>My Website</title>
</head>

<body>
    <!-- Bắt đầu nội dung sản phẩm -->
    <div id="content" class="container mx-auto py-4">
        <div class="grid grid-cols-12">
            <ul class="col-span-12 flex breadcrumb">
                <!-- Thứ tự trang -->
                <li>
                    <a href="index.php" class="text-blue-500">Trang chủ</a>
                </li>
                <li>
                    <a href="cuahang.php" class="text-blue-500">Cửa hàng</a>
                </li>
                <li>
                    <a href="cuahang.php?p_cat=<?php echo $p_cat_id; ?>" class="text-blue-500"><?php echo $p_cat_title; ?></a>
                </li>
                <li class="text-gray-500">
                    <?php echo $pro_title; ?>
                </li>
            </ul>
        </div>

        <div class="grid grid-cols-12 gap-4">
            <!-- Phần Hiển thị ảnh sản phẩm (6 cột) -->
            <div class="col-span-6">
                <img src="admin_area/product_images/<?php echo $pro_img; ?>" alt="<?php echo $pro_title; ?>" class="w-full h-auto object-contain">
            </div>


            <!-- Phần Thông tin sản phẩm bên phải (6 cột) -->
            <div class="col-span-6">
                <div class="box p-8 bg-white rounded-lg shadow-md">
                    <h1 class="text-2xl font-semibold text-center mb-4"><?php echo $pro_title; ?></h1>

                    <form action="chitiet.php?add_cart=<?php echo $product_id; ?>" method="POST" class="space-y-4">
                        <div class="flex items-center">
                            <label for="product_qty" class="block text-sm font-medium text-gray-700 w-1/3">Số lượng</label>
                            <input type="number" id="product_qty" name="product_qty" value="1" min="1" class="w-2/3 border rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex items-center">
                            <label for="product_size" class="block text-sm font-medium text-gray-700 w-1/3">Kích cỡ</label>
                            <select name="product_size" id="product_size" class="w-2/3 border rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                <option disabled selected>Lựa chọn kích cỡ</option>
                                <option>Small</option>
                                <option>Medium</option>
                                <option>Large</option>
                            </select>
                        </div>

                        <?php add_cart(); ?>

                        <p class="text-xl font-semibold text-center mb-4"><?php echo $pro_price; ?> đ</p>

                        <div class="text-center mt-4"> <!-- Điều chỉnh margin-top tại đây -->
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-full">
                                <i class="fa fa-shopping-cart mr-2"></i> Thêm giỏ hàng
                            </button>
                        </div>
                    </form>

                    <div class="box mt-8" id="details">
                        <h4 class="text-lg font-semibold">Chi tiết sản phẩm</h4>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            <?php echo $pro_desc; ?>
                        </p>
                        <h4 class="text-lg font-semibold mt-4">Size</h4>
                        <ul class="list-disc list-inside">
                            <li>Small</li>
                            <li>Medium</li>
                            <li>Large</li>
                        </ul>
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

        <!-- Kết thúc nội dung sản phẩm -->



        <?php

        include("includes/footer.php");
        ?>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.nav-toggle').click(function() {
                    $('.panel-collapse,.collapse-data').slideToggle(700, function() {

                        if ($(this).css('display') == 'none') {
                            $(".hide-show").html('Mở');
                        } else {
                            $(".hide-show").html('Ẩn');
                        }

                    });
                });

                $(function() {
                    $.fn.extend({
                        filterTable: function() {
                            return this.each(function() {

                                $(this).on('keyup', function() {

                                    var $this = $(this),
                                        search = $this.val().toLowerCase(),
                                        target = $this.attr('data-filters'),
                                        handle = $(target),
                                        rows = handle.find('li a');

                                    if (search == '') {
                                        rows.show();
                                    } else {
                                        rows.each(function() {
                                            var $this = $(this);

                                            $this.text().toLowerCase()
                                                .indexOf(
                                                    search) === -1 ?
                                                $this.hide() : $this.show();
                                        });
                                    }
                                });
                            });
                        }
                    });
                    $('[data-action="filter"][id="dev-table-filter"]').filterTable();
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                function getProducts() {

                    var sPath = '';
                    var aInputs = $('li').find('.get_manufacturer');
                    var aKeys = Array();
                    var aValues = Array();

                    iKey = 0;

                    $.each(aInputs, function(key, oInput) {
                        if (oInput.checked) {
                            aKeys[iKey] = oInput.value;
                        }
                        iKey++;
                    });

                    if (aKeys.length > 0) {
                        var sPath = '';

                        for (var i = 0; i < aKeys.length; i++) {
                            sPath = sPath + 'man[]=' + aKeys[i] + '&';
                        }
                    }

                    var aInputs = Array();
                    var aInputs = $('li').find('.get_p_cat');
                    var aKeys = Array();
                    var aValues = Array();

                    iKey = 0;

                    $.each(aInputs, function(key, oInput) {
                        if (oInput.checked) {
                            aKeys[iKey] = oInput.value;
                        }
                        iKey++;
                    });

                    if (aKeys.length > 0) {
                        var sPath = '';

                        for (var i = 0; i < aKeys.length; i++) {
                            sPath = sPath + 'p_cat[]=' + aKeys[i] + '&';
                        }
                    }

                    var aInputs = Array();
                    var aInputs = $('li').find('.get_cat');
                    var aKeys = Array();
                    var aValues = Array();

                    iKey = 0;

                    $.each(aInputs, function(key, oInput) {
                        if (oInput.checked) {
                            aKeys[iKey] = oInput.value;
                        }
                        iKey++;
                    });

                    if (aKeys.length > 0) {
                        var sPath = '';

                        for (var i = 0; i < aKeys.length; i++) {
                            sPath = sPath + 'cat[]=' + aKeys[i] + '&';
                        }
                    }

                    $('#wait').html('<img src="images/load.gif"');

                    $.ajax({
                        url: "load.php",
                        method: "POST",

                        data: sPath + 'saction=getProducts',

                        success: function(data) {

                            $('#products').html('');
                            $('#products').html(data);
                            $('#wait').empty();
                        }
                    });

                    $.ajax({
                        url: "load.php",
                        method: "POST",

                        data: sPath + 'saction=getPaginator',

                        success: function(data) {

                            $('.pagination').html('');
                            $('.pagination').html(data);
                        }
                    });
                }

                $('.get_manufacturer').click(function() {
                    getProducts();
                });

                $('.get_p_cat').click(function() {
                    getProducts();
                });
                $('.get_cat').click(function() {
                    getProducts();
                });
            });
        </script>
</body>

</html>
</body>

</html>