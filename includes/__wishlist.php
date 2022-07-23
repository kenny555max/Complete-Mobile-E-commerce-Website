<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['deleteWishlist'])) {
            $cart->deleteCartItem($_POST['userid'], $_POST['itemid'], $table = "wishlist");
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['addBackToCart'])) {
            $cart->saveForLater($_POST['userid'], $_POST['itemid'], $saveTable = "cart", $fromTable = "wishlist");
        }
    }
?>

    <!-- wishlist -->
    <div class="col-lg-12">
        <div class="container">
            <div class="title text-center p-4">
                <h3>Wishlist</h3>
            </div>

            <div class="row">
                <div class="col-lg-9">
                    <div class="wishlist-items">
                        <?php foreach($cart->getCart($_SESSION['id'], $table = "wishlist") as $itemWish): ?>
                            <?php foreach($product->getItem($itemWish['item_id']) as $itemCart): ?>
                                <div class="item">
                                    <div class="row m-0">
                                        <div class="item_image d-flex justify-content-center align-items-center" style="width: 150px;height: 250px;">
                                            <img style="width: 100px;height: 200px;" src="<?php echo $itemCart['item_image'] ?>" alt="item_image">
                                        </div>

                                        <div class="item_details w-75 d-flex flex-column justify-content-center">
                                            <h3 class="item_name"><?php echo $itemCart['item_name'] ?></h3>
                                            <small class="item_brand"><?php echo $itemCart['item_brand'] ?></small>

                                            <div class="ratings">
                                                <div class="row m-0">
                                                    <ul class="list-unstyled d-flex mr-2 p-0 text-warning">
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

                                                    <div class="rating-score">
                                                        <a href="#">20534 ratings</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="update">
                                                <div class="option ml-2">
                                                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                                        <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?? 0 ?>">
                                                        <input type="hidden" name="itemid" value="<?php echo $itemCart['item_id'] ?? 0 ?>">
                                                        <button type="submit" name="deleteWishlist" class="btn border-0 font-weight-bolder text-danger bg-light" style="font-size: 1.3em;">Delete</button>
                                                    </form>
                                                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                                        <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?? 0 ?>">
                                                        <input type="hidden" name="itemid" value="<?php echo $itemCart['item_id'] ?? 0 ?>">
                                                        <button type="submit" name="addBackToCart" class="btn border-0 font-weight-bolder text-info bg-light" style="font-size: 1.3em;">Add To Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item_price mt-4 text-danger font-weight-bolder">$<span>150</span></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
        </div>
    </div>