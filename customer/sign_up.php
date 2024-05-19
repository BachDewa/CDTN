<?php
include("includes/database.php");
session_start();

$email = $_POST['email'];
$pass = $_POST['password'];
$name = $_POST['name'];
$date = $_POST['date'];
$number = $_POST['number'];
$address = $_POST['address'];

$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

$query = "SELECT * FROM customers WHERE customer_email='$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(['success' => false, 'message' => 'Email already exists']);
} else {
    $insert = "INSERT INTO customers(customer_name, customer_email, customer_pass, customer_contact, customer_address) VALUES ('$name', '$email', '$hashed_password', '$number', '$address')";
    $insert_result = mysqli_query($conn, $insert);
    
    if ($insert_result) {
        $_SESSION['customer_email'] = $email;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registration failed']);
    }
}
?>
