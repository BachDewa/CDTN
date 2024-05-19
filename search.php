<?php
$active = 'Cửa hàng';
include("includes/header.php");

?>

<?php

$search = $_GET['search'];

?>

<!--Bat dau content cua san pham-->
<div id="content" class="container mx-auto mt-6">
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <ul class="breadcrumb flex space-x-2 text-gray-700">
                <!--Thu tu trang-->
                <li>
                    <a href="index.php" class="text-blue-500 hover:underline">Trang chủ</a>
                </li>
                <li class="text-gray-500">
                    Tìm kiếm
                </li>
            </ul>
        </div>

        <div class="col-span-12 lg:col-span-3">
            <?php include("includes/sidebar.php"); ?>
        </div>

        <div class="col-span-12 lg:col-span-9">
            <div class="box border border-gray-300 p-4 mb-4">
                <?php
                echo "<h2 class='text-2xl font-bold'>Kết quả tìm kiếm</h2> <h1 class='text-xl mt-2'># $search</h1>";
                ?>
            </div>

            <div id="products" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php
                getProSearch($search);
                ?>
            </div>

            <div class="flex justify-center mt-4">
                <ul class="pagination flex space-x-2">
                    <?php getPaginator(); ?>
                </ul>
            </div>
        </div>

        <div id="wait" class="wait fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-8 bg-white border border-gray-300">
            <img src="images/load.gif" alt="Loading">
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

                                $this.text().toLowerCase().indexOf(
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
        getProducts($search);
    });

    $('.get_p_cat').click(function() {
        getProducts($search);
    });
    $('.get_cat').click(function() {
        getProducts($search);
    });
});
</script>
</body>

</html>