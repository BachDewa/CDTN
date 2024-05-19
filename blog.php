<?php
$active = 'Blog';
include("includes/header.php");
?>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <div class="relative bg-cover bg-center rounded-lg overflow-hidden mb-8" style="background-image: url('images/bl1.jpg'); height: 400px;">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center">
                <h2 class="text-4xl font-bold text-white mb-4">Lợi Ích Của Dầu Gội Thảo Dược</h2>
                <p class="text-white mb-4 px-4">Dầu gội thảo dược không chỉ giúp làm sạch tóc mà còn cung cấp dưỡng chất tự nhiên, giúp tóc chắc khỏe...</p>
                <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">Read more</a>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Blog Post 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img src="images/b3.jpg" alt="Post Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Sử Dụng Mỹ Phẩm Như Thế Nào Để Hiệu Quả Nhất?</h3>
                    <p class="text-gray-700 mb-4">Việc sử dụng mỹ phẩm đúng cách không chỉ giúp bạn có làn da đẹp mà còn bảo vệ sức khỏe của bạn..</p>
                    <a href="#" class="bg-blue-600 px-4 py-2 rounded-full hover:bg-blue-700 transition">Read more</a>
                </div>
            </div>
            <!-- Blog Post 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img src="images/b2.jpg" alt="Post Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Top 5 Sản Phẩm DHC Không Thể Thiếu</h3>
                    <p class="text-gray-700 mb-4">DHC mang đến những sản phẩm chất lượng cao giúp bạn chăm sóc làn da và sức khỏe của mình mỗi ngày...</p>
                    <a href="#" class="bg-blue-600 px-4 py-2 rounded-full hover:bg-blue-700 transition">Read more</a>
                </div>
            </div>
            <!-- Blog Post 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img src="images/b4" alt="Post Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Cách Chọn Áo Thun Phù Hợp Với Dáng Người</h3>
                    <p class="text-gray-700 mb-4">Áo thun là trang phục không thể thiếu trong tủ đồ của bạn. Hãy cùng tìm hiểu cách chọn áo thun sao cho phù hợp nhất...</p>
                    <a href="#" class="bg-blue-600 px-4 py-2 rounded-full hover:bg-blue-700 transition">Read more</a>
                </div>
            </div>
            <!-- Add more blog posts as needed -->
        </div>
    </main>
</body>
<?php

include("includes/footer.php");
?>