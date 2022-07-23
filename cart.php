<?php
    // header
    include "includes/__header.php";

    if (isset($_SESSION['id'])) {
        count($cart->getCart($_SESSION['id'])) > 0 ? include "includes/__cart.php" : include "includes/__emptyCart.php";
    }else{
        include "includes/__emptyCart.php";
    }
    
    if (isset($_SESSION['id'])) {
        count($cart->getCart($_SESSION['id'], $table = "wishlist")) > 0 ? include "includes/__wishlist.php" : include "includes/__wishlistEmpty.php";
    }else{
        include "includes/__emptyCart.php";
    }

    // newphones
    include "includes/__newphones.php";

    // footer
    include "includes/__footer.php";
?>