<?php
session_start();
require_once "./template/header.php";
require_once "./functions/database_functions.php";

if (isset($_GET['userid'])) {
    $user_id = $_GET['userid'];
} else {
    if (isset($_SESSION["userid"]) && !empty($_SESSION["userid"])) {
        $user_id = $_SESSION["userid"];
    } else {
        header("Location: user_login.php");
        exit;
    }
}

$conn = db_connect();
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

// Process form submissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Update profile details
    if (isset($_POST["update_profile"])) {
        $name = trim($_POST["name"]);
        $address = trim($_POST["address"]);
        $city = trim($_POST["city"]);
        $zip_code = trim($_POST["zip_code"]);
        $country = trim($_POST["country"]);

        // Validate the input fields (you can add more validation rules here)
        if (empty($name) || empty($address) || empty($city) || empty($zip_code) || empty($country)) {
            $update_error = "All fields are required";
        } else {
            // Update the user's profile in the database
            $query = "UPDATE users SET name = '$name', address = '$address', city = '$city', zip_code = '$zip_code', country = '$country' WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $update_success = "Profile updated successfully";
                $user_data["name"] = $name;
                $user_data["address"] = $address;
                $user_data["city"] = $city;
                $user_data["zip_code"] = $zip_code;
                $user_data["country"] = $country;
            } else {
                $update_error = "Error updating profile: " . mysqli_error($conn);
            }
        }
    }

    // Change password
    if (isset($_POST["change_password"])) {
        $current_password = trim($_POST["current_password"]);
        $new_password = trim($_POST["new_password"]);
        $confirm_password = trim($_POST["confirm_password"]);

        // Validate the input fields (you can add more validation rules here)
        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            $change_password_error = "All fields are required";
        } elseif ($new_password !== $confirm_password) {
            $change_password_error = "New password and confirm password do not match";
        } else {
            // Check if the current password matches the one in the database
            $hashed_password = $user_data["password"];
            if (password_verify($current_password, $hashed_password)) {
                // Update the password in the database
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE users SET password = '$hashed_new_password' WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $change_password_success = "Password changed successfully";
                } else {
                    $change_password_error = "Error changing password: " . mysqli_error($conn);
                }
            } else {
                $change_password_error = "Current password is incorrect";
            }
        }
    }

    // Change username
    if (isset($_POST["change_username"])) {
        $new_username = trim($_POST["new_username"]);

        // Validate the input fields (you can add more validation rules here)
        if (empty($new_username)) {
            $change_username_error = "Username cannot be empty";
        } else {
            // Check if the new username is available
            $query = "SELECT * FROM users WHERE username = '$new_username' AND user_id != '$user_id'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $change_username_error = "Username already exists. Please choose a different one.";
            } else {
                // Update the username in the database
                $query = "UPDATE users SET username = '$new_username' WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $change_username_success = "Username changed successfully";
                    $user_data["username"] = $new_username;
                } else {
                    $change_username_error = "Error changing username: " . mysqli_error($conn);
                }
            }
        }
    }

    // Change email
    if (isset($_POST["change_email"])) {
        $new_email = trim($_POST["new_email"]);

        // Validate the input fields (you can add more validation rules here)
        if (empty($new_email)) {
            $change_email_error = "Email cannot be empty";
        } else {
            // Check if the new email is available
            $query = "SELECT * FROM users WHERE email = '$new_email' AND user_id != '$user_id'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $change_email_error = "Email already exists. Please choose a different one.";
            } else {
                // Update the email in the database
                $query = "UPDATE users SET email = '$new_email' WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $change_email_success = "Email changed successfully";
                    $user_data["Email"] = $new_email;
                } else {
                    $change_email_error = "Error changing email: " . mysqli_error($conn);
                }
            }
        }
    }
}

if ($conn) {
    mysqli_close($conn);
}
?>

<!DOCTYPE html>

<style>
    .edit-profile-form {
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
    }
    input[type="submit"] {
        padding: 10px 20px;
        background-color: GoldenRod;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
</style>


<html>
</head>
<body>
<h2>User Account Management</h2>

<!-- Profile Update Form -->
<h4>Edit Profile</h4>
<form class="edit-profile-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $user_data["name"]; ?>" required><br>

    <label for="address">Address:</label>
    <input type="text" name="address" value="<?php echo $user_data["address"]; ?>" required><br>

    <label for="city">City:</label>
    <input type="text" name="city" value="<?php echo $user_data["city"]; ?>" required><br>

    <label for="zip_code">Zip Code:</label>
    <input type="text" name="zip_code" value="<?php echo $user_data["zip_code"]; ?>" required><br>

    <label for="country">Country:</label>
    <input type="text" name="country" value="<?php echo $user_data["country"]; ?>" required><br>

    <?php if (isset($update_error)) { ?>
        <p class="text-danger"><?php echo $update_error; ?></p>
    <?php } ?>

    <?php if (isset($update_success)) { ?>
        <p class="text-success"><?php echo $update_success; ?></p>
    <?php } ?>

    <input type="submit" name="update_profile" value="Update Profile">
</form>

<!-- Change Password Form -->
<h4>Change Password</h4>
<form class="edit-profile-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="current_password">Current Password:</label>
    <input type="password" name="current_password" required><br>

    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required><br>

    <?php if (isset($change_password_error)) { ?>
        <p class="text-danger"><?php echo $change_password_error; ?></p>
    <?php } ?>

    <?php if (isset($change_password_success)) { ?>
        <p class="text-success"><?php echo $change_password_success; ?></p>
    <?php } ?>

    <input type="submit" name="change_password" value="Change Password">
</form>

<!-- Change Username Form -->
<h4>Change Username</h4>
<form class="edit-profile-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="new_username">New Username:</label>
    <input type="text" name="new_username" value="<?php echo $user_data["username"]; ?>" required><br>

    <?php if (isset($change_username_error)) { ?>
        <p class="text-danger"><?php echo $change_username_error; ?></p>
    <?php } ?>

    <?php if (isset($change_username_success)) { ?>
        <p class="text-success"><?php echo $change_username_success; ?></p>
    <?php } ?>

    <input type="submit" name="change_username" value="Change Username">
</form>

<!-- Change Email Form -->
<h4>Change Email</h4>
<form class="edit-profile-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="new_email">New Email:</label>
    <input type="email" name="new_email" value="<?php echo $user_data["email"]; ?>" required><br>

    <?php if (isset($change_email_error)) { ?>
        <p class="text-danger"><?php echo $change_email_error; ?></p>
    <?php } ?>

    <?php if (isset($change_email_success)) { ?>
        <p class="text-success"><?php echo $change_email_success; ?></p>
    <?php } ?>

    <input type="submit" name="change_email" value="Change Email">
</form>
</body>
</html>
