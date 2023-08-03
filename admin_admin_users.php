<?php
session_start();
require_once "./functions/admin.php";
$title = "User Management";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
$conn = db_connect();
$result = getAllUsers($conn); // Function to retrieve all users
?>
<div class="mt-4">
    <h4 class="fw-bolder text-center"> Book List</h4>
</div>
<center>
    <hr class="bg-warning" style="width:5em;height:3px;opacity:1">
</center>
<?php if(isset($_SESSION['user_success'])): ?>
    <div class="alert alert-success rounded-0">
        <?= $_SESSION['user_success'] ?>
    </div>
    <?php
    unset($_SESSION['user_success']);
endif;
?>
<div class="card rounded-0">
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Country</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php while($user = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td class="px-2 py-1 align-middle"><?php echo $user['user_id']; ?></td>
                        <td class="px-2 py-1 align-middle"><?php echo $user['username']; ?></td>
                        <td class="px-2 py-1 align-middle"><?php echo $user['email']; ?></td>
                        <td class="px-2 py-1 align-middle"><?php echo $user['name']; ?></td>
                        <td class="px-2 py-1 align-middle"><?php echo $user['country']; ?></td>
                        <td class="px-2 py-1 align-middle text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="user_edit_profile.php?userid=<?php echo $user['user_id']; ?>" class="btn btn-sm rounded-0 btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="user_delete_profile.php?userid=<?php echo $user['user_id']; ?>" class="btn btn-sm rounded-0 btn-danger" title="Delete" onclick="if(confirm('Are you sure to delete this user?') === false) event.preventDefault()"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="text-center">
                <a href="user_registration.php" class="btn btn-primary rounded-0">Add User</a>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($conn)) {mysqli_close($conn);}
require_once "./template/footer.php";
?>
