<?php
session_start();
require_once "./functions/admin.php";
$title = "Order Management";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
$conn = db_connect();
$result = getAllOrders($conn); // Function to retrieve all orders
?>
<div class="mt-4">
    <h4 class="fw-bolder text-center">Book List</h4>
</div>
<center>
    <hr class="bg-warning" style="width:5em;height:3px;opacity:1">
</center>
<?php if(isset($_SESSION['order_success'])): ?>
    <div class="alert alert-success rounded-0">
        <?= $_SESSION['order_success'] ?>
    </div>
    <?php
    unset($_SESSION['order_success']);
endif;
?>
<div class="card rounded-0">
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Receiver name</th>
                    <th>Adress</th>
                    <th>Order Date</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php while($order = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td class="px-2 py-1 align-middle"><?php echo $order['order_id']; ?></td>
                        <td class="px-2 py-1 align-middle"><?php echo $order['user_id']; ?></td>
                        <td class="px-2 py-1 align-middle"><?php echo $order['ship_name']; ?></td>
                        <td class="px-2 py-1 align-middle"><?php echo $order['ship_address']; ?></td>
                        <td class="px-2 py-1 align-middle"><?php echo $order['date']; ?></td>
                        <td class="px-2 py-1 align-middle"><?php echo $order['amount']; ?></td>
                        <td class="px-2 py-1 align-middle text-center">
                            <div class="btn-group btn-group-sm">
                                <form action="order_details.php" method="get">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <button type="submit" class="btn btn-sm rounded-0 btn-primary" title="View Details"><i class="fa fa-eye"></i></button>
                                </form>
                                <form action="delete_order.php" method="get">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <button type="submit" class="btn btn-sm rounded-0 btn-danger" title="Delete Order" onclick="if(confirm('Are you sure to delete this order?') === false) event.preventDefault()"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
if(isset($conn)) {mysqli_close($conn);}
require_once "./template/footer.php";
?>
