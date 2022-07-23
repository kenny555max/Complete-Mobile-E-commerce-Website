<?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['newphones-button'])) {
            if (isset($_SESSION['id'])) {
                $cart->insertIntoCart($_POST['userid'], $_POST['itemid']);
            }else{
                echo "<div class='bg-danger text-white font-weight-bolder p-2'>You have to be loggedIn to add product to cart!</div>";
            }
        }
    }
?>

    <section class="new-phones">
        <div class="container">
            <h5>New Phones</h5>
            <div class="phones owl-carousel">
                <?php array_map(function($item){ ?>
                    <li class="item bg-light py-4">
                        <a href="product.php?itemId=<?php echo $item['item_id']?>"><img src="<?php echo $item['item_image'] ?? "img/nokia-5-copper.png" ?>" alt=""></a>
                        <div class="product_brand"><?php echo $item['item_brand'] ?? "Samsung" ?></div>
                        <div class="product_name"><?php echo $item['item_name'] ?? "Samsung Galaxy 10s" ?></div>
                        <ul>
                            <li>
                                <i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star-half-full"></i>
                            </li>
                        </ul>
                        <div class="product_price">$<span><?php echo $item['item_price'] ?? 120 ?></span></div>
                        <div class="add-to-cart">
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?? 0 ?>">
                                <input type="hidden" name="itemid" value="<?php echo $item['item_id'] ?? 0 ?>">
                                <?php
                                    $cart = new CART();
                                    if (isset($_SESSION['id'])) {
                                        $in_cart = $cart->getCartId($cart->getCart($_SESSION['id']));
                                    }

                                    if (!in_array($item['item_id'], $in_cart ?? [])) {
                                        echo '<button type="submit" name="newphones-button" class="btn btn-warning">Add to Cart</button>';
                                    }else{
                                        echo '<button disabled="disabled" class="btn btn-success">In Cart</button>';
                                    }
                                ?>
                            </form>
                        </div>
                    </li>
                <?php }, $data); ?>
            </div>
        </div>
    </section>