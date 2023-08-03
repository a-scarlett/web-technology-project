<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .navbar-brand {
            margin-right: 20px;
        }
        .search-form {
            margin-top: 10px;
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/styles.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="./bootstrap/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.bundle.min.js"></script>

    <style>
        .navbar-brand {
            margin-right: 20px;
        }
    </style>
</head>

<body>
<div class="clear-fix pt-5 pb-3"></div>
<nav class="navbar navbar-expand-lg navbar-expand-md navbar-light bg-warning bg-gradient fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="template/logo.png" alt="The Bookworm." height="40">
        </a>
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link btn btn-outline-primary" href="Books.php">Books</a>
            </li>
        </ul>

        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link btn btn-outline-primary" href="genre_list.php">Categories</a>
            </li>
        </ul>

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse justify-content-center" id="topNav">
            <form class="navbar-form" role="search" action="search.php" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="q" id="search-input" required>
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="collapse navbar-collapse" id="topNav">
            <ul class="nav navbar-nav ms-auto">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                    <li class="nav-item"><a class="nav-link" href="user_panel.php"><span class="fa fa-user"></span> Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="user_logout.php"><span class="fa fa-sign-out-alt"></span> Logout</a></li>
                    <!-- Cart section -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="fa fa-shopping-cart"></i> Cart
                            </a>
                        </li>
                    </ul>
                <?php else : ?>
                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) : ?>
                        <li class="nav-item"><a class="nav-link" href="admin_admin_users.php"><span class="fa fa-users"></span> User Management</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_admin_book.php"><span class="fa fa-file-alt"></span> Book Management</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_admin_orders.php"><span class="fa fa-shopping-cart"></span> Order Management</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_panel.php"><span class="fa fa-user"></span> Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="user_logout.php"><span class="fa fa-sign-out-alt"></span> Logout</a></li>
                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link" href="user_registration.php"><span class="fa fa-user-plus"></span> Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="user_login.php"><span class="fa fa-sign-in-alt"></span> Login</a></li>
                    <?php endif;?>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>

<div class="container" id="main">
