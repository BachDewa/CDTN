<?php

session_start();

include("includes/database.php");
include("functions/functions.php");

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cô gái tóc mây</title>
  <link href="style/output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    .bg-nav {
      background-image: url('images/bg.jpg');
    }

    .bg-fo {
      background-image: url('images/bgf.jpg');
    }

    .absolute-close {
      position: absolute;
      top: 0;
      right: 0;
      margin: 0.75rem;
      font-size: 1.5rem;
      color: #4b5563;
      cursor: pointer;
    }

    .absolute-close:hover {
      color: #1a202c;
    }
  </style>
</head>

<body>
  <div class="bg-nav bg-cover bg-center">
    <!-- Navbar -->
    <nav class=" p-4">
      <div class="container mx-auto flex flex-col items-center relative">
        <!-- Top Right Links -->
        <div class="absolute top-0 right-0 mt-4 mr-4 flex space-x-4">
          <!-- <a href="#" class="hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
          </a>
          <a href="../giohang.php" class="hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
          </a>
          User icon
          <a href="#" id="userIcon" class="hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
          </a> -->
          <ul class="menu flex justify-end items-center space-x-4">
            <?php if (!isset($_SESSION['customer_email'])) : ?>
              <!-- Nếu chưa đăng nhập -->
              <li>
                <button type="button" class="btn text-white bg-blue-500 hover:bg-blue-600 rounded-md py-2 px-4" onclick="openSignUpFrame()">Đăng Ký</button>
              </li>
              <li>
                <button type="button" class="btn btn-primary bg-gray-700 hover:bg-gray-600 rounded-md py-2 px-4" onclick="openLoginFrame()">Đăng Nhập</button>
              </li>
            <?php else : ?>
              <!-- Nếu đã đăng nhập -->
              <li>
                <a href="./customer/my_account.php" id="welcome" class="btn btn-success btn-sm">Chào mừng: <?php echo $_SESSION['customer_email']; ?></a>
              </li>
              <li>
                <a href="logout.php" class="btn btn-danger btn-sm">Đăng xuất</a>
              </li>
            <?php endif; ?>
          </ul>

          <!-- Dropdown content (hidden by default) -->
          <div id="userDropdown" class="hidden absolute right-0 mt-12 w-48 bg-white rounded-md shadow-md z-10">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Đăng nhập</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Đăng ký</a>
          </div>
        </div>
        <!-- Logo -->
        <a href="../index.php" class="flex items-center">
          <img src="images/logo3.jpg" alt="Logo" class="w-28 h-auto">
        </a>
        <!-- Navigation Links -->
        <ul class="flex space-x-8 mb-4">
          <li><a href="../index.php" class="hover:text-white">Trang chủ</a></li>
          <li><a href="../cuahang.php" class="hover:text-white">Shop</a></li>
          <li><a href="../giohang.php" class="hover:text-white">Giỏ hàng</a></li>
          <li><a href="../lienhe.php" class="hover:text-white">Liên hệ</a></li>
          <li><a href="../blog.php" class="hover:text-white">Blog</a></li>
        </ul>
        <!-- Search Bar -->
        <div class="w-full max-w-md flex items-center bg-white rounded">
          <input type="text" placeholder="Search..." class="w-full p-2 bg-white focus:outline-none focus:ring-2 focus:ring-white">
          <button class="p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />
            </svg>
          </button>
        </div>
      </div>
    </nav>
  </div>


  <!-- Login frame -->
  <div id="loginframe" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-8 rounded shadow-md w-96">
      <h2 class="text-2xl font-bold mb-4">Member Login</h2>
      <input id="email" type="text" class="w-full border-gray-300 rounded-md mb-4 p-2" placeholder="Email" name="email" required>
      <input id="password" type="password" class="w-full border-gray-300 rounded-md mb-4 p-2" placeholder="Password" name="password" required>
      <p id="login-alert" class="text-red-500 mb-4"></p>
      <button id="btn_login" type="button" class="w-full bg-blue-500 text-white rounded-md py-2 hover:bg-blue-600">Login</button>
      <p class="text-center mt-4"><a href="#" onclick="openSignUpFrame()">Create Account</a></p>
      <button type="button" class="absolute top-0 right-0 mt-4 mr-4 text-xl text-gray-600 hover:text-gray-800" onclick="closeLoginFrame()">&times;</button>
    </div>
  </div>

  <!-- Sign up frame -->
  <div id="signupframe" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-8 rounded shadow-md w-96">
      <h2 class="text-2xl font-bold mb-4">Đăng ký</h2>
      <input id="sign-up-email" type="text" class="w-full border-gray-300 rounded-md mb-4 p-2" placeholder="Email" name="email" required>
      <input id="sign-up-password" type="password" class="w-full border-gray-300 rounded-md mb-4 p-2" placeholder="Password" name="password" required>
      <input id="sign-up-confirm-password" type="password" class="w-full border-gray-300 rounded-md mb-4 p-2" placeholder="Confirm Password" name="cpassword" required>
      <input id="sign-up-name" type="text" class="w-full border-gray-300 rounded-md mb-4 p-2" placeholder="Name" name="name" required>
      <input id="sign-up-date" type="text" class="w-full border-gray-300 rounded-md mb-4 p-2" placeholder="Date of Birth" name="date" required>
      <input id="sign-up-number" type="text" class="w-full border-gray-300 rounded-md mb-4 p-2" placeholder="Phone Number" name="number" required>
      <input id="sign-up-address" type="text" class="w-full border-gray-300 rounded-md mb-4 p-2" placeholder="Address" name="address" required>
      <p id="signup-alert" class="text-red-500 mb-4"></p>
      <button id="button-sign-up" type="button" class="w-full bg-blue-500 text-white rounded-md py-2 hover:bg-blue-600">Sign Up</button>
      <button type="button" class="absolute top-0 right-0 mt-4 mr-4 text-xl text-gray-600 hover:text-gray-800" onclick="closeSignUpFrame()">&times;</button>
    </div>
  </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    // Hiển thị Khung Đăng ký
    function openSignUpFrame() {
      document.getElementById('loginframe').classList.add('hidden');
      document.getElementById('signupframe').classList.remove('hidden');
    }

    // Hiển thị Khung Đăng nhập
    function openLoginFrame() {
      document.getElementById('signupframe').classList.add('hidden');
      document.getElementById('loginframe').classList.remove('hidden');
    }

    // Ẩn Khung Đăng nhập
    function closeLoginFrame() {
      document.getElementById('loginframe').classList.add('hidden');
    }

    // Ẩn Khung Đăng ký
    function closeSignUpFrame() {
      document.getElementById('signupframe').classList.add('hidden');
    }

    $(document).ready(function() {
      // Toggle dropdown when clicking on user icon
      $('#userIcon').click(function() {
        $('#userDropdown').toggleClass('hidden'); // Toggle hidden class using Tailwind CSS
        // Hide login and signup frames when user dropdown is shown
        $('#loginframe').addClass('hidden');
        $('#signupframe').addClass('hidden');
      });

      // Hide dropdown when clicking outside of it
      $(document).click(function(event) {
        if (!$(event.target).closest('#userDropdown').length && !$(event.target).is('#userIcon')) {
          $('#userDropdown').addClass('hidden'); // Hide dropdown using Tailwind CSS
        }
      });

      // Show login frame when clicking "Đăng nhập" in the dropdown
      $('#userDropdown a:contains("Đăng Nhập")').click(function() {
        $('#loginframe').removeClass('hidden'); // Show login frame using Tailwind CSS
        $('#signupframe').addClass('hidden');
        $('#userDropdown').addClass('hidden');
      });

      // Show signup frame when clicking "Đăng ký" in the dropdown
      $('#userDropdown a:contains("Đăng Ký")').click(function() {
        $('#signupframe').removeClass('hidden'); // Show signup frame using Tailwind CSS
        $('#loginframe').addClass('hidden');
        $('#userDropdown').addClass('hidden');
      });
    });



    $(document).ready(function() {

      // Login event
      $(document).on('click', '#btn_login', function() {
        var email = $("#email").val();
        var password = $("#password").val();
        const data = {
          'email': email,
          'password': password
        };

        $.ajax({
          type: "POST",
          url: "customer/customer_login.php",
          data: data,
          dataType: 'json'
        }).done(function(res) {
          if (res.success) {
            $("#loginframe").addClass("hidden");
            $(".menu").empty();
            var welcome = "<li><a href='./customer/my_account.php' class='btn btn-sm btn-success'>Chào mừng: " + email + "</a></li>";
            $(".menu").html(welcome);
            var logout = "<li><a href='logout.php'>Đăng xuất</a></li>";
            $(".menu").append(logout);
          } else {
            $("#login-alert").text(res.message);
            $("#login-alert").addClass("bg-danger");
          }
        }).fail(function() {
          alert("Lỗi");
        });
      });

      // Sign up button event
      $(document).on('click', '#button-sign-up', function() {
        var email = $("#sign-up-email").val();
        var password = $("#sign-up-password").val();
        var name = $("#sign-up-name").val();
        var date = $("#sign-up-date").val();
        var number = $("#sign-up-number").val();
        var address = $("#sign-up-address").val();
        const data = {
          'email': email,
          'password': password,
          'name': name,
          'date': date,
          'number': number,
          'address': address
        };

        $.ajax({
          type: 'POST',
          url: "customer/sign_up.php",
          data: data,
          dataType: 'json'
        }).done(function(res) {
          if (res.success) {
            var s = " <li><a href='logout.php'>Đăng xuất</a></li>";
            $(".menu").empty().html(s);
            $("#signupframe").addClass("hidden");
            $("#welcome").html("Chào mừng: " + email);
          } else {
            $("#signup-alert").html(res.message);
          }
        }).fail(function() {
          alert("Lỗi");
        });
      });

      // Check password match on blur
      $("#sign-up-confirm-password").blur(function() {
        var pass = $("#sign-up-password").val();
        var cpass = $("#sign-up-confirm-password").val();
        if (pass != cpass) {
          $("#check").text("Không trùng khớp").addClass("bg-danger");
        } else {
          $("#check").text("Trùng khớp").removeClass("bg-danger").addClass("bg-success");
        }
      });

    });
  </script>

</body>

</html>
<?php

if (isset($_REQUEST['ok'])) {
  $search = addslashes($_GET['search']);
}

?>