<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['top-sale-button'])) {
            if (isset($_SESSION['id'])) {
                $cart->insertIntoCart($_POST['userid'], $_POST['itemid']);
            }else{
                echo "<div class='bg-danger text-white font-weight-bolder p-2'>You have to be loggedIn to add product to cart!</div>";
            }
        }
    }

    if (isset($_SESSION['id'])) {
        $in_cart = $cart->getCartId($cart->getCart($_SESSION['id']));
    }
?>
    <section class="top-sale">
        <div class="container">
            <h4>Top Sale</h4>
            <div class="products owl-carousel">
                <?php foreach($data as $item): ?>
                    <li class="bg-light">
                        <a href="product.php?itemId=<?php echo $item['item_id']?>"><img src="<?php echo $item['item_image'] ?? "item_image" ?>" alt=""></a>
                        <div class="product_brand"><?php echo $item['item_brand'] ?? "item_brand" ?></div>
                        <div class="product_name"><?php echo $item['item_name'] ?? "item_name" ?></div>
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
                        <div class="product_price">$<span><?php echo $item['item_price'] ?? "item_price" ?></span></div>
                        <div class="add-to-cart">
                            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                                <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?? [] ?>">
                                <input type="hidden" name="itemid" value="<?php echo $item['item_id'] ?? [] ?>">
                                <?php if (!in_array($item['item_id'], $in_cart ?? [])): ?>
                                    <?php echo '<button type="submit" name="top-sale-button" class="btn btn-warning">Add to Cart</button>'
                                    ?>
                                <?php endif; ?>
                                <?php if (in_array($item['item_id'], $in_cart ?? [])): ?>
                                    <?php echo '<button disabled="disabled" class="btn btn-success">In Cart</button>'
                                    ?>
                                <?php endif; ?>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </div>
        </div>
    </section>