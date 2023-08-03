<?php
session_start();
require_once "./functions/database_functions.php";

// Check if the order_id parameter is set in the URL
if (!isset($_GET['order_id'])) {
    header("Location: user_order_history.php");
    exit;
}

$order_id = $_GET['order_id'];
$conn = db_connect();

// Check if the order exists and belongs to the logged-in user
$query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    // If the order does not exist or does not belong to the user, redirect to user_order_history.php
    header("Location: user_order_history.php");
    exit;
}

// Delete the order from the orders table
$delete_order_query = "DELETE FROM orders WHERE order_id = '$order_id'";
$delete_order_result = mysqli_query($conn, $delete_order_query);

// Delete the order items from the order_items table
$delete_order_items_query = "DELETE FROM order_items WHERE order_id = '$order_id'";
$delete_order_items_result = mysqli_query($conn, $delete_order_items_query);

if ($delete_order_result && $delete_order_items_result) {
    $_SESSION['order_success'] = "Order deleted successfully";
} else {
    $_SESSION['order_error'] = "Error deleting order";
}

mysqli_close($conn);

// Redirect back to the previous page
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    // If the previous page is not available, redirect to user_order_history.php as a fallback
    header("Location: index.php");
}

exit;
?>
