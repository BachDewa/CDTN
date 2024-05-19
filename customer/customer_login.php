<?php
include("includes/database.php");
session_start();

$customer_email = $_POST['email'];
$customer_pass = $_POST['password'];

$query = "SELECT * FROM customers WHERE customer_email='$customer_email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $customer = mysqli_fetch_assoc($result);
    if (password_verify($customer_pass, $customer['customer_pass'])) {
        $_SESSION['customer_email'] = $customer_email;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
}
?>
