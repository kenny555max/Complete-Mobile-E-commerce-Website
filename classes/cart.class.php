<?php

    class CART extends DBH {
        public function insertIntoCart($userid = null, $itemid = null, $table = "cart") {
            if ($this->conn !== null) {
                if (isset($userid) && isset($itemid)) {

                    $sql = sprintf("INSERT INTO %s(user_id, item_id) VALUES ('$userid', '$itemid')", $table);
                    $result = mysqli_query($this->conn, $sql);

                    if ($result) {
                        header("Location: ".$_SERVER['PHP_SELF']."?=itemSuccessfullyAddedToTheCart");
                    }
                }
            }
        }

        public function getCart($userid = null, $table = "cart") {
            if ($this->conn !== null) {
                if (isset($userid)) {
                    $sql = sprintf("SELECT * FROM %s WHERE user_id='%s'", $table, $userid);
                    $result = mysqli_query($this->conn, $sql);
                    $check = mysqli_num_rows($result);

                    $cart = [];

                    if ($check > 0) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $cart[] = $row;
                        }
                    }

                    return $cart;
                }
            }
        }

        public function getCartId($array = null, $key = "item_id", $table = "cart") {
            if ($this->conn !== null) {
                if ($array !== null) {
                    $cartId = array_map(function($value) use($key){
                        return $value[$key];
                    }, $array);

                    return $cartId;
                }
            }
        }

        public function deleteCartItem($userid = null, $itemid = null, $table = "cart") {
            if ($this->conn !== null) {
                if (isset($userid) && isset($itemid)) {
                    $sql = sprintf("DELETE FROM %s WHERE user_id='%s' AND item_id='%s'", $table, $userid, $itemid);
                    $result = mysqli_query($this->conn, $sql);

                    if ($result) {
                        header("Location: ".$_SERVER['PHP_SELF']."?deleteStatus=Successful");
                    }
                }
            }
        }

        public function sumTotal($subTotal = null) {
            if ($subTotal !== null) {
                $sum = 0;

                foreach ($subTotal as $item) {
                    $sum += floatval($item[0]);
                }

                return sprintf("%.2f", $sum);
            }
        }

        public function saveForLater($userid = null, $itemid = null, $saveTable = "wishlist", $fromTable = "cart") {
            if ($this->conn !== null) {
                if (isset($userid) && isset($itemid)) {
                    // multi query
                    $sql = sprintf("INSERT INTO %s SELECT * FROM %s WHERE user_id='%s' AND item_id='%s';", $saveTable, $fromTable, $userid, $itemid);
                    $sql .= sprintf("DELETE FROM %s WHERE user_id='%s' AND item_id='%s'", $fromTable, $userid, $itemid);
                    
                    $result = $this->conn->multi_query($sql);

                    if ($result) {
                        header("Location: ".$_SERVER['PHP_SELF']."?saveItemStatus=Successful");
                    }
                }
            }
        }
    }