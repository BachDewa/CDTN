<?php
$active = 'Trang chủ';
include("includes/header.php");
?>

  <!-- Slider -->
  <section class="my-8">
    <div class="container mx-auto relative">
        <div class="swiper-container">
            <div class="swiper-wrapper">

                <?php
                // Truy vấn cơ sở dữ liệu để lấy hình ảnh từ bảng 'slider'
                $get_slides = "SELECT * FROM slider ORDER BY slider_id DESC LIMIT 3"; // Lấy tối đa 3 slide
                $run_slider = mysqli_query($conn, $get_slides);

                // Duyệt qua các dòng dữ liệu và hiển thị trong carousel
                while ($row_slides = mysqli_fetch_array($run_slider)) {
                    $slide_name = $row_slides['slider_name'];
                    $slide_image = $row_slides['slider_image'];
                    $slide_url = $row_slides['slide_url'];

                    // Hiển thị mỗi hình ảnh trong một slide của Swiper
                    echo "
                    <div class='swiper-slide'>
                        <a href='$slide_url'>
                            <img src='admin_area/slides_images/$slide_image' alt='$slide_name' class='w-full h-auto object-cover'>
                        </a>
                    </div>
                    ";
                }
                ?>

            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Navigation Buttons -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>


  <!-- Policies -->
  <section class="bg-gray-100 py-12">
  <h2 class="text-3xl font-bold text-center mb-8">Category</h2>
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php
        $get_boxes = "SELECT * FROM boxes_section ORDER BY box_id DESC LIMIT 3";
        $run_boxes = mysqli_query($conn, $get_boxes);

        while ($run_boxes_section = mysqli_fetch_array($run_boxes)) {
            $box_title = $run_boxes_section['box_title'];
            $box_desc = $run_boxes_section['box_desc'];
        ?>
            <!-- Policy -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4"><?php echo $box_title; ?></h3>
                <p class="text-gray-700"><?php echo $box_desc; ?></p>
            </div>
        <?php
        }
        ?>
    </div>
</section>


  <!-- Category -->
  <section class="py-12">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-8">Category</h2>
            <div class="flex flex-wrap -mx-4">
                <!-- Large Category -->
                <div class="w-full md:w-1/2 lg:w-full px-4 mb-8">
                    <div class="relative bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="images/muc1.jpg" alt="Category 1" class="w-full h-64 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center p-6">
                            <h3 class="text-xl font-semibold text-white mb-2">Dầu gội</h3>
                            <p class="text-gray-200 mb-4"></p>
                            <a href="cuahang.php" class="inline-block bg-blue-500 text-white py-2 px-4 rounded">Xem ngay</a>
                        </div>
                    </div>
                </div>
                <!-- Small Category -->
                <div class="w-full md:w-1/2 lg:w-full flex flex-col space-y-8 md:space-y-0 md:space-x-8 md:flex-row px-4">
                    <div class="relative flex-1 bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="images/muc2.jpg" alt="Product 2" class="w-full h-64 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center p-6">
                            <h3 class="text-xl font-semibold text-white mb-2">Mỹ phẩm</h3>
                            <p class="text-gray-200 mb-4"></p>
                            <a href="cuahang.php" class="inline-block bg-blue-500 text-white py-2 px-4 rounded">Xem ngay</a>
                        </div>
                    </div>
                    <div class="relative flex-1 bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="images/muc3.jpg" alt="Product 3" class="w-full h-64 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center p-6">
                            <h3 class="text-xl font-semibold text-white mb-2">Thời trang</h3>
                            <p class="text-gray-200 mb-4"></p>
                            <a href="cuahang.php" class="inline-block bg-blue-500 text-white py-2 px-4 rounded">Xem ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hot Products Section -->
    <section class="py-12">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-8">Hot Products</h2>
            <div class="flex flex-wrap -mx-4">
                <?php
                getPro();
                ?>
            </div>
        </div>
    </section>

<?php

include("includes/footer.php");
?>
  

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper('.swiper-container', {
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
