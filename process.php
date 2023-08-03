<?php
session_start();

$_SESSION['err'] = 1;
foreach ($_POST as $key => $value) {
    if (trim($value) == '') {
        $_SESSION['err'] = 0;
        break;
    }
}

if ($_SESSION['err'] == 0) {
    header("Location: purchase.php");
} else {
    unset($_SESSION['err']);
}

require_once "./functions/database_functions.php";
// Print out header here
$title = "Purchase Process";
require "./template/header.php";
// Connect to the database
$conn = db_connect();
extract($_SESSION['ship']);

// Validate post data
$card_number = $_POST['card_number'];
$card_PID = $_POST['card_PID'];
$card_expire = strtotime($_POST['card_expire']);
$card_owner = $_POST['card_owner'];

// Get user details from the database
$user_id = $_SESSION["userid"];
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

// Get the user's address details
$name = $user_data['name'];
$address = $user_data['address'];
$city = $user_data['city'];
$zip_code = $user_data['zip_code'];
$country = $user_data['country'];

$date = date("Y-m-d H:i:s");


echo $user_id ." " .$_SESSION['total_price'] . " " . $date . " " . $name . " " . $address . " " . $city . " " . $zip_code . " " . $country;
insertIntoOrder($conn, $user_id, $_SESSION['total_price'], $date, $name, $address, $city, $zip_code, $country);

// Take order_id from order to insert order items
$order_id = getorder_id($conn, $user_id);

foreach ($_SESSION['cart'] as $isbn => $qty) {
    $bookprice = getbookprice($isbn);
    $query = "INSERT INTO order_items (order_id, book_isbn, item_price, quantity) 
              VALUES ('$order_id', '$isbn', '$bookprice', '$qty')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Insert value false!" . mysqli_error($conn);
        exit;
    }
}

// Clear the session data
session_unset();
header("Location:index.php");
?>

<div class="alert alert-success rounded-0 my-4">Your order has been processed successfully. We'll be reaching out to confirm your order. Thanks!</div>

<?php
if (isset($conn)) {
    mysqli_close($conn);
}
require_once "./template/footer.php";
?>
