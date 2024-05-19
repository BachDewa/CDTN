<?php
$active = 'Cửa hàng';
include("includes/header.php");
?>

<?php
if (isset($_GET['p_cat'])) {
    $p_cat_id = $_GET['p_cat'];

    $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";
    $run_p_cat = mysqli_query($conn, $get_p_cat);
    $row_p_cat = mysqli_fetch_array($run_p_cat);

    $p_cat_id = $row_p_cat['p_cat_id'];
    $p_cat_title = $row_p_cat['p_cat_title'];
    $p_cat_image = $row_p_cat['p_cat_image'];
}
?>

<div id="content" class="container mx-auto">
    <div class="grid grid-cols-12">
        <ul class="col-span-12 flex breadcrumb">
            <!-- Thứ tự trang -->
            <!-- <li>
                <a href="index.php" class="text-blue-500">Trang chủ</a>
            </li>
            <li class="text-gray-500">
                Cửa hàng
            </li>
            <?php if (isset($_GET['p_cat'])) : ?>
                <li class="text-gray-500">
                    <?php echo $p_cat_title; ?>
                </li>
            <?php endif; ?> -->
        </ul>
    </div>

    <div class="grid grid-cols-12 gap-4 my-2">
        <div class="col-span-12 lg:col-span-3">
            <?php include("includes/sidebar.php"); ?>
        </div>
        <div class="col-span-12 lg:col-span-9">
            <div id="products" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php
                if (isset($_GET['p_cat'])) {
                    getProducts_Cat($p_cat_id);
                } else {
                    getProducts();
                }
                ?>
            </div>

            <div class="flex justify-center mt-4">
                <ul class="pagination flex space-x-2">
                    <?php getPaginator(); ?>
                </ul>
            </div>
        </div>

    </div>
</div>

<?php include("includes/footer.php"); ?>

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

<script>
    $(document).ready(function() {
        $('.get_manufacturer, .get_p_cat, .get_cat').click(function() {
            getProducts();
        });

        function getProducts() {
            var sPath = '';

            var aInputs = $('.get_manufacturer, .get_p_cat, .get_cat');
            aInputs.each(function() {
                if (this.checked) {
                    sPath += $(this).attr('name') + '[]=' + $(this).val() + '&';
                }
            });

            $('#wait').html('<img src="images/load.gif"');

            $.ajax({
                url: "load.php",
                method: "POST",
                data: sPath + 'saction=getProducts',
                success: function(data) {
                    $('#products').html(data);
                    $('#wait').empty();
                }
            });

            $.ajax({
                url: "load.php",
                method: "POST",
                data: sPath + 'saction=getPaginator',
                success: function(data) {
                    $('.pagination').html(data);
                }
            });
        }

        $('.nav-toggle').click(function() {
            $('.panel-collapse, .collapse-data').slideToggle(700, function() {
                if ($(this).css('display') == 'none') {
                    $(".hide-show").html('Mở');
                } else {
                    $(".hide-show").html('Ẩn');
                }
            });
        });

        $('[data-action="filter"][id="dev-table-filter"]').on('keyup', function() {
            var search = $(this).val().toLowerCase();
            var target = $(this).attr('data-filters');
            var rows = $(target).find('li a');
            rows.each(function() {
                var text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(search) > -1);
            });
        });
    });
</script>

</body>

</html>