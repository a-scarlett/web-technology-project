<!DOCTYPE html>
<html>
<?php
session_start();
$title = "User Login";
require_once "./template/header.php";
?>

<body>
<div class="row justify-content-center my-5">
    <div class="col-lg-4 col-md-6 col-sm-10 col-xs-12">
        <div class="card rounded-0 shadow">
            <div class="card-header">
                <div class="card-title text-center h4 fw-bolder">User Login</div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <?php if(isset($_SESSION['err_login'])): ?>
                        <div class="alert alert-danger rounded-0">
                            <?= $_SESSION['err_login'] ?>
                        </div>
                        <?php
                        unset($_SESSION['err_login']);
                    endif;
                    ?>
                    <form class="form-horizontal" method="post" action="user_verify.php">
                        <div class="mb-3">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" name="username" class="form-control rounded-0" required maxlength="18">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" name="password" class="form-control rounded-0" required>
                        </div>
                        <div class="mb-3 d-grid">
                            <input type="submit" name="login" class="btn btn-primary rounded-0" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once "./template/footer.php";
?>
</body>
</html>
