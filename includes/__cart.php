<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['deleteCart'])) {
            $cart->deleteCartItem($_POST['userid'], $_POST['itemid']);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['saveForLater'])) {
            $cart->saveForLater($_POST['userid'], $_POST['itemid']);
        }
    }
?>

    <!-- shopping-cart -->
    <div class="col-lg-12">
        <div class="container">
            <div class="title text-center p-4">
                <h3>Shopping Cart</h3>
            </div>

            <div class="row">
                <div class="col-lg-9">
                    <div class="cart-items">
                        <?php foreach($cart->getCart($_SESSION['id']) as $cartInfo): ?>
                            <?php $subTotal[] = array_map(function($itemCart){ ?>
                                <div class="item">
                                    <div class="row m-0">
                                        <div class="item_image d-flex justify-content-center align-items-center" style="width: 150px;height: 250px;">
                                            <img style="width: 100px;height: 200px;" src=<?php echo $itemCart['item_image'] ?? "img/nokia-5-black.png" ?> alt="item_image">
                                        </div>

                                        <div class="item_details d-flex w-50 flex-column justify-content-center">
                                            <h3 class="item_name"><?php echo $itemCart['item_name'] ?? "Samsung Galaxy 10s"; ?></h3>
                                            <small class="item_brand"><?php echo $itemCart['item_brand'] ?? "Samsung"; ?></small>

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
                                                <div class="row m-0">
                                                    <div class="item_number w-50 d-flex">
                                                        <button type="button" class="btn qtyBtn inc mr-1 rounded-0 btn-light" style="font-size: 1.2em;">
                                                            <i class="fa fa-angle-up"></i>
                                                        </button>
                                                        <input data-id="<?php echo $itemCart['item_id']?>" type="number" style="font-size: 1.2em;" value="1" class="form-control rounded-0 bg-light text-center qtyInput border-0 shadow-none">
                                                        <button style="font-size: 1.2em;" type="button" class="btn qtyBtn rounded-0 dec btn-light ml-1">
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                    </div>

                                                    <div class="option ml-2">
                                                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                                            <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?? 0 ?>">
                                                            <input type="hidden" name="itemid" value="<?php echo $itemCart['item_id'] ?? 0 ?>">
                                                            <button type="submit" name="deleteCart" class="btn border-0 font-weight-bolder text-danger bg-light" style="font-size: 1.3em;">Delete</button>
                                                        </form>
                                                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                                            <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?? 0 ?>">
                                                            <input type="hidden" name="itemid" value="<?php echo $itemCart['item_id'] ?? 0 ?>">
                                                            <button type="submit" class="btn border-0 font-weight-bolder text-info bg-light" name="saveForLater" style="font-size: 1.3em;">save for later</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item_price mt-4 text-danger font-weight-bolder" data-id="<?php echo $itemCart['item_id'] ?>">$<span class="price"><?php echo $itemCart['item_price'] ?? 152.00 ?></span></div>
                                    </div>
                                </div>
                                <?php return $itemCart['item_price']; ?>
                            <?php }, $product->getItem($cartInfo['item_id'])); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="top border p-2 border-light">
                        <p class="text-center d-flex text-success font-weight-bold">
                            <i class="fa fa-check"></i>
                            <small>Your order is eligible for FREE Delivery</small>
                        </p>
                    </div>
                    <div class="bottom text-center p-2 border border-light">
                        <div class="subtotal">Subtotal<span class="numOfItems">(<?php echo isset($_SESSION['id']) && isset($subTotal) ? count($cart->getCart($_SESSION['id'])) : 0 ?> item[s])</span><span class="deal_price text-danger">$<?php echo isset($subTotal) ? $cart->sumTotal($subTotal) : 0; ?></span></div>

                        <button type="button" class="btn btn-warning">Proceed To Buy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>