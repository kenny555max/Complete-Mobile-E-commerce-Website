<?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Mobile Shopee</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/main.css">
    <?php
        session_start();
        include "config/__autoload.php";

        $product = new PRODUCT();
        $data = $product->getProduct();
        shuffle($data);
        
        $cart = new CART();
    ?>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Product</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i> <?php echo isset($_SESSION['id']) ? count($cart->getCart($_SESSION['id'])) : 0; 
                        ?></a>
                    </li>
                </ul>
                <div class="profile">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <?php if(!isset($_SESSION['id'])): ?>
                                <?php echo '
                                        <a class="nav-link" href="signup.php">SIGNUP</a>
                                        ';
                                ?>
                            <?php endif; ?>
                            <?php if(isset($_SESSION['id'])): ?>
                                <?php echo '
                                            <a class="nav-link d-flex mr-2" href="userprofile.php">
                                                <i class="fa fa-user mt-1 mr-2"></i>
                                                <h5>'.$_SESSION['email'].'</h5>
                                            </a>
                                        ';
                                ?>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php if(!isset($_SESSION['id'])): ?>
                                <?php echo '
                                            <a class="nav-link" href="login.php">LOGIN</a>
                                        ';
                                ?>
                            <?php endif; ?>
                            <?php if(isset($_SESSION['id'])): ?>
                                <?php echo '
                                            <a class="nav-link" href="logout.php">LOGOUT</a>
                                        ';
                                ?>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>