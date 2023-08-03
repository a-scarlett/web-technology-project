<?php
session_start();

require_once "./template/header.php";
require_once "./functions/database_functions.php";

// Process form submission for profile deletion
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Delete profile
    if (isset($_POST["delete_profile"])) {
        $conn = db_connect();

        if (isset($_POST["userid"]) && !empty($_POST["userid"])) {
            // The "userid" is available in the $_POST array
            $user_id = $_POST["userid"];
        } else {
            if (isset($_SESSION["userid"]) && !empty($_SESSION["userid"])) {
                $user_id = $_SESSION["userid"];
            } else {
                header("Location: user_login.php");
            }
        }
        // Delete orders_items associated with the user
        $delete_order_items_query = "DELETE oi FROM order_items oi 
                                    INNER JOIN orders o ON oi.order_id = o.order_id 
                                    WHERE o.user_id = '$user_id'";
        $result_order_items = mysqli_query($conn, $delete_order_items_query);

        // Delete orders associated with the user
        $delete_orders_query = "DELETE FROM orders WHERE user_id = '$user_id'";
        $result_orders = mysqli_query($conn, $delete_orders_query);

        // Delete the user from users table
        $delete_user_query = "DELETE FROM users WHERE user_id = '$user_id'";
        $result_user = mysqli_query($conn, $delete_user_query);

        if ($result_user && $result_orders && $result_order_items) {
            // Account deletion successful
            session_unset();
            session_destroy();
            header("Location: index.php"); // Redirect to the homepage after account deletion
            exit;
        } else {
            $delete_error = "Error deleting the user account. Please try again later.";
        }

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Delete Profile</title>
    <!-- Add your CSS styles and meta tags here -->
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
<h2>User Delete Profile</h2>

<!-- Profile Deletion Form -->
<h4>Delete Profile</h4>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');">
    <?php if (isset($delete_error)) { ?>
        <p class="text-danger"><?php echo $delete_error; ?></p>
    <?php } ?>

    <input type="submit" name="delete_profile" value="Delete Profile">
</form>

</body>
</html>
