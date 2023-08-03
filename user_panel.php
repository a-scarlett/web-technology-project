<!DOCTYPE html>
<html>
<?php
session_start();
$title = "User Account Panel";
require_once "./template/header.php";
?>

<body>
<h2 class="mt-5">Welcome, <?php echo $_SESSION["username"]; ?>!</h2>

<!-- Account Settings -->
<h3 class="mt-4">Account Settings</h3>
<ul class="list-unstyled">
    <li class="my-2"><a href="user_edit_profile.php" class="nav-link btn">Profile Settings</a></li>
    <li class="my-2"><a href="user_delete_profile.php" class="nav-link btn">Delete profile</a></li>
</ul>

<!-- Order History -->
<h3 class="mt-4">Order History</h3>
<ul class="list-unstyled">
    <li class="my-2"><a href="user_order_history.php" class="nav-link btn">View Order History</a></li>
</ul>

</body>
<?php
require_once "./template/footer.php";
?>
</html>
