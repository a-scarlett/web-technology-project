<!DOCTYPE html>
<html>
<?php
session_start();
$title = "Order History";
require_once "./template/header.php";
require_once "./functions/database_functions.php";

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: user_login.php");
    exit;
}

// Retrieve the user's order history from the database
$user_id = $_SESSION["userid"];
$conn = db_connect();
$query = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY date DESC";
$result = mysqli_query($conn, $query);

?>

<body>
<h2>Order History</h2>
<?php if (mysqli_num_rows($result) > 0) { ?>
    <table class="table">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Total Price</th>
            <th>View Details</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo "$" . $row['amount']; ?></td>
                <td>
                    <a href="order_details.php?order_id=<?php echo $row['order_id']; ?>" class="btn btn-primary btn-sm">View Details</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>No orders found in the order history.</p>
<?php } ?>

</body>
<?php
mysqli_free_result($result);
mysqli_close($conn);
require_once "./template/footer.php";
?>
</html>
