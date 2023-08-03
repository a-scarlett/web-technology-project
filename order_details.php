<!DOCTYPE html>
<html>
<?php
session_start();
$title = "Order Details";
require_once "./template/header.php";
require_once "./functions/database_functions.php";

if (!isset($_GET['order_id'])) {
    header("Location: user_order_history.php");
    exit;
}

// Retrieve the order details from the database based on the order ID
$order_id = $_GET['order_id'];
$conn = db_connect();
$query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    header("Location: user_order_history.php");
    exit;
}

$row = mysqli_fetch_assoc($result);

// Get the order items from the database
$query_items = "SELECT * FROM order_items WHERE order_id = '$order_id'";
$result_items = mysqli_query($conn, $query_items);

?>

<body>
<h2>Order Details</h2>
<h4>Order ID: <?php echo $row['order_id']; ?></h4>
<h4>Order Date: <?php echo $row['date']; ?></h4>
<h4>Total Price: <?php echo "$" . $row['amount']; ?></h4>

<?php if (mysqli_num_rows($result_items) > 0) { ?>
    <table class="table">
        <thead>
        <tr>
            <th>ISBN</th>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($item = mysqli_fetch_assoc($result_items)) {
            $book =  mysqli_fetch_assoc(getBookByIsbn($conn, $item['book_isbn']));
            ?>
            <tr>
                <td><?php echo $item['book_isbn']; ?></td>
                <td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
                <td><?php echo "$" . $item['item_price']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo "$" . $item['item_price'] * $item['quantity']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>No items found in the order.</p>
<?php } ?>

</body>
<?php
mysqli_free_result($result);
mysqli_free_result($result_items);
mysqli_close($conn);
require_once "./template/footer.php";
?>
</html>
