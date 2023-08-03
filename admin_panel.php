<!DOCTYPE html>
<html>
<?php
session_start();
$title = "Admin Panel";
require_once "./functions/admin.php";
require_once "./template/header.php";
?>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<h2 class="mt-5">Welcome, <?php echo $_SESSION["username"]; ?>!</h2>

<!-- Order History -->
<h3 class="mt-4">Order History</h3>
<ul class="list-unstyled">
    <li class="my-2"><a href="admin_admin_orders.php" class="nav-link btn">View Order History</a></li>
</ul>

<!-- Product Management -->
<h3 class="mt-4">Product Management</h3>
<ul class="list-unstyled">
    <li class="my-2"><a href="admin_admin_book.php" class="nav-link btn">Books</a></li>
    <li class="my-2"><a href="admin_add_book.php" class="nav-link btn">Add New Book</a></li>
</ul>

<!-- User Management -->
<h3 class="mt-4">User Management</h3>
<ul class="list-unstyled">
    <li class="my-2"><a href="admin_admin_users.php" class="nav-link btn">Users</a></li>
    <li class="my-2"><a href="user_registration.php" class="nav-link btn">Add New User</a></li>
</ul>
</body>

<?php
require_once "./template/footer.php";
?>

</html>
