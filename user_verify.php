<?php

session_start();
session_destroy();
session_start();

// Check if the form is submitted
if (!isset($_POST["login"])) {
    echo "Something wrong! Check again!";
    exit;
}

require_once "./functions/database_functions.php";
$conn = db_connect();

// Validate and sanitize the user input
$username = trim($_POST["username"]);
$password = trim($_POST["password"]);

if ($username == "" || $password == "") {
    echo "Username or Password is empty!";
    exit;
}

$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Prepare the SQL query to retrieve user data based on the provided username
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    // User exists, verify the password
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row["password"];

    if (password_verify($password, $hashed_password)) {
        // password matches, user is logged in
        $_SESSION["username"] = $username;
        $_SESSION["userid"] = $row["user_id"];
        $_SESSION["loggedin"] = true;

        // Redirect to the user's dashboard or any other page after successful login
        header("Location: user_panel.php");
        exit;
    } else {
        // Invalid password
        echo "Invalid password. Please try again.";
    }
} else {
    // User does not exist
    echo "User not found. Please check your username or register for a new account.";
}

// Close the database connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>
