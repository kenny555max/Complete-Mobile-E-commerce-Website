<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['special-price-button'])) {
            if (isset($_SESSION['id'])) {
                $cart->insertIntoCart($_POST['userid'], $_POST['itemid']);
            }else{
                echo "<div class='bg-danger text-white font-weight-bolder p-2'>You have to be loggedIn to add product to cart!</div>";
            }
        }
    }
?>

    <section class="special_price">
        <div class="container">
            <h4>Special Price</h4>
            <div class="products_type portfolio-filter">
                <ul class="filtered d-flex list-unstyled" id="filtered">
                    <li class="active ml-3 btn bg-light" data-filter="All Brand">All Brand</li>
                    <li class="active ml-3 btn bg-light" data-filter="Samsung">Samsung</li>
                    <li class="active ml-3 btn bg-light" data-filter="Apple">Apple</li>
                    <li class="active ml-3 btn bg-light" data-filter="Redmi">Redmi</li>
                </ul>

                <div class='filterItem p-4'>
                    <input type="text" id="filterInputs" class="form-control filterInputs bg-light font-weight-bolder" placeholder="Filter Products">
                </div>
            </div>
            <div class="special_products all-portfolios">
                <?php array_map(function($item){ ?>
                    <li class="item border border-warning py-4">
                        <a href="product.php?itemId=<?php echo $item['item_id']?>"><img src="<?php echo $item['item_image'] ?? "img/nokia-5-copper.png" ?>" alt=""></a>
                        <div class="product_brand"><?php echo $item['item_brand'] ?? "Samsung" ?></div>
                        <div class="product_name"><?php echo $item['item_name'] ?? "Samsun Galxy 10s" ?></div>
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
                            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                                <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?? [] ?>">
                                <input type="hidden" name="itemid" value="<?php echo $item['item_id'] ?? 0 ?>">
                                <?php
                                    $cart = new CART();
                                    if (isset($_SESSION['id'])) {
                                        $in_cart = $cart->getCartId($cart->getCart($_SESSION['id']));
                                    }

                                    if (!in_array($item['item_id'], $in_cart ?? [])) {
                                        echo '<button type="submit" name="special-price-button" class="btn btn-warning">Add to Cart</button>';
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