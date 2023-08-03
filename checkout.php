<?php
session_start();
require_once "./functions/database_functions.php";
// print out header here
$title = "Checking out";
require "./template/header.php";

// Check if the shopping cart has items
if (!isset($_SESSION['cart']) || !array_count_values($_SESSION['cart'])) {
    header("Location: books.php");
    exit;
}

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: user_login.php");
    exit;
}

// Retrieve the user's details from the database
$conn = db_connect();
$user_id = $_SESSION["userid"];
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);
// the shopping cart needs sessions, to start one
/*
    Array of session(
        cart => array (
            book_isbn (get from $_GET['book_isbn']) => number of books
        ),
        items => 0,
        total_price => '0.00'
    )
*/

?>
    <h4 class="fw-bolder text-center">Checkout</h4>
    <center>
        <hr class="bg-warning" style="width:5em;height:3px;opacity:1">
    </center>
<?php
if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
    ?>
    <div class="card rounded-0 shadow mb-3">
        <div class="card-body">
            <div class="container-fluid">
                <table class="table">
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    foreach($_SESSION['cart'] as $isbn => $qty){
                        $conn = db_connect();
                        $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
                        ?>
                        <tr>
                            <td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
                            <td><?php echo "$" . $book['book_price']; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo "$" . $qty * $book['book_price']; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th><?php echo $_SESSION['total_items']; ?></th>
                        <th><?php echo "$" . $_SESSION['total_price']; ?></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 col-sm-10 col-xs-12">
            <div class="card rounded-0 shadow">
                <div class="card-header">
                    <div class="card-title h6 fw-bold">Please Fill the following form</div>
                </div>
                <div class="card-body container-fluid">
                    <form method="post" action="purchase.php" class="form-horizontal">
                        <?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
                            <p class="text-danger">All fields have to be filled</p>
                        <?php } ?>
                        <div class="mb-3">
                            <label class="control-label">Name</label>
                            <input type="text" name="name" class="form-control rounded-0" value="<?php echo $user_data['name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="control-label">Address</label>
                            <input type="text" name="address" class="form-control rounded-0" value="<?php echo $user_data['address']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="control-label">City</label>
                            <input type="text" name="city" class="form-control rounded-0" value="<?php echo $user_data['city']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="control-label">Zip Code</label>
                            <input type="text" name="zip_code" class="form-control rounded-0" value="<?php echo $user_data['zip_code']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="control-label">Country</label>
                            <input type="text" name="country" class="form-control rounded-0" value="<?php echo $user_data['country']; ?>">
                        </div>
                        <div class="mb-3 d-grid">
                            <input type="submit" name="confirm" value="Confirm" class="btn btn-primary rounded-0">
                        </div>
            </div>
        </div>
    </div>

    <?php
} else {
    echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
}
if(isset($conn)){ mysqli_close($conn); }
require_once "./template/footer.php";
?>