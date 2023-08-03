<!DOCTYPE html>
<html>
<?php
session_start();
$title = "User Registration";
require_once "./template/header.php";
?>

<div class="row justify-content-center my-5">
    <div class="col-lg-4 col-md-6 col-sm-10 col-xs-12">
        <div class="card rounded-0 shadow">
            <div class="card-header">
                <div class="card-title text-center h4 fw-bolder">User Registration Form</div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" name="username" class="form-control rounded-0" required maxlength="18">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" name="email" class="form-control rounded-0" required maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" name="password" class="form-control rounded-0" required minlength="6" maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" name="name" class="form-control rounded-0" required maxlength="100">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="control-label">Address</label>
                            <input type="text" name="address" class="form-control rounded-0" required maxlength="200">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="control-label">City</label>
                            <input type="text" name="city" class="form-control rounded-0" required maxlength="100">
                        </div>
                        <div class="mb-3">
                            <label for="zip_code" class="control-label">Zip Code</label>
                            <input type="text" name="zip_code" class="form-control rounded-0" required maxlength="20">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="control-label">Country</label>
                            <input type="text" name="country" class="form-control rounded-0" required maxlength="100">
                        </div>
                        <div class="mb-3 d-grid">
                            <input type="submit" name="submit" class="btn btn-primary rounded-0" value="Register">
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
</html>
