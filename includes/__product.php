<?php
    $product = new PRODUCT();
    if (isset($_GET['itemId'])) {
        $dataProduct = $product->getItem($_GET['itemId']);
    }else{
        $dataProduct = $product->getItem(1);
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['cartBtn'])) {
            if (isset($_SESSION['id'])) {
                $cart->insertIntoCart($_POST['userid'], $_POST['itemid']);
            }else{
                echo "<div class='bg-danger text-white font-weight-bolder p-2'>You have to be loggedIn to add product to cart!</div>";
            }
        }
    }
?>

    <div class="col-lg-12 mt-4">
        <div class="container">
            <?php array_map(function($item){ ?>
                <div class="product-display">
                    <div class="row">
                        <div class="col-lg-6 p-0 d-flex justify-content-center">
                            <div class="left ">
                                <div class="product-image mb-4" style="width: 400px;height: 800px;">
                                    <img style="width: 100%;height: 100%;" src="<?php echo $item['item_image'] ?? "img/nokia-5-black.png" ?>" alt="">
                                </div>
        
                                <div class="handler d-flex">
                                    <button type="submit" name="buyBtn" class="btn font-weight-bolder mr-2 w-50 btn-info">Proceed To Buy</button>
                                    <form method="POST" class="w-50" action="<?php $_SERVER['PHP_SELF'] ?>">
                                        <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?? [] ?>">
                                        <input type="hidden" name="itemid" value="<?php echo $item['item_id'] ?? 0 ?>">
                                        <?php
                                            $cart = new CART();
                                            if (isset($_SESSION['id'])) {
                                                $in_cart = $cart->getCartId($cart->getCart($_SESSION['id']));
                                            }

                                            if (!in_array($item['item_id'], $in_cart ?? [])) {
                                                echo '<button type="submit" name="cartBtn" class="btn btn-warning w-100 font-weight-bolder">Add to Cart</button>';
                                            }else{
                                                echo '<button disabled="disabled" class="btn btn-success w-100 font-weight-bolder">In Cart</button>';
                                            }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 p-0 d-flex">
                            <div class="product-details">
                                <div class="phone-description">
                                    <h1><?php echo $item["item_name"] ?? "Samsun Galaxy 10"; ?></h1>
                                    <small>by <?php echo $item["item_brand"] ?? "Samsung"; ?></small>
                                    <div class="ratings">
                                        <ul class="d-flex text-warning list-unstyled">
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
                                        <a href="#">20,534 ratings | 1000+ answered questions</a>
                                    </div>
                                    <hr class="m-0">
                                    <div class="price">
                                        <h4>MRP <span>$ <del>162.00</del></span></h4>
                                        <p>Deal price <span>$</span><span><?php echo $item["item_price"] ?? 0; ?></span> <small>including of all taxes</small></p>
                                        <p>You save <span>$ <small>10.00</small></span></p>
                                    </div>
                                    <div class="delivery-icon d-flex">
                                        <div class="icon">
                                            <i class="fa fa-retweet"></i>
                                            <p>10 Days</p>
                                            <p>Replacement</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-truck"></i>
                                            <p>Daily Tuition</p>
                                            <p>Delivered</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-check"></i>
                                            <p>1 Year</p>
                                            <p>Warranty</p>
                                        </div>
                                    </div>
                                    <hr class="m-0">
                                    <p>Delivery by Mar 29-Apr 1</p>
                                    <p class="sold">Sold by <a href="#">Daily Electronics</a> (4.5 out of 5 | 15.435 ratings)</p>
                                    <div class="receiver d-flex">
                                        <i class="fa fa-map-marker mr-1 text-primary"></i>
                                        <p>Delivery to <?php echo isset($_SESSION['id']) ? $_SESSION['username'] : "User's Name" ?> * 4326757</p>
                                    </div>
                                    <div class="type-color d-flex">
                                        <p>color:</p>
                                        <ul class="d-flex justify-content-between">
                                            <li class="pink"></li>
                                            <li class="blue"></li>
                                            <li class="light-blue"></li>
                                        </ul>
                                        <form>
                                            <div class="row">
                                                <button data-id="pro3" type="button" class="bg-light btn inc"><i class="fa fa-angle-up"></i></button>
                                                <input data-id="pro3" type="num" value="1" class="border qty bg-light w-50">
                                                <button data-id="pro3" type="button" class="bg-light dec btn"><i class="fa fa-angle-down"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="size">
                                        <p>size:</p>
                                        <ul class="d-flex list-unstyled justify-content-between">
                                            <li class="border p-2">4GB RAM</li>
                                            <li class="border p-2">6GB RAM</li>
                                            <li class="border p-2">8GB RAM</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }, $dataProduct); ?>
        </div>
    </div>