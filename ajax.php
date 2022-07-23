<?php

    include_once "config/__autoload.php";

    $product = new PRODUCT();

    if (isset($_POST['itemId'])) {
        $result = $product->getItem($_POST['itemId']);
        echo json_encode($result);
    }