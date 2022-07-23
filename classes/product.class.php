<?php

    class PRODUCT extends DBH {
        public function getProduct($table = "products") {
            if ($this->conn !== null) {
                $sql = sprintf("SELECT * FROM %s", $table);
                $result = mysqli_query($this->conn, $sql);

                $productArray = [];

                if ($result) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $productArray[] = $row;
                    }
                }

                return $productArray;
            }
        }
        
        public function getItem($item_id = null, $table = "products") {
            if ($this->conn !== null) {
                if (isset($item_id)) {
                    $sql = sprintf("SELECT * FROM %s WHERE item_id='%s'", $table, $item_id);
                    $result = mysqli_query($this->conn, $sql);
    
                    $itemArray = [];
    
                    if ($result) {
                        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $itemArray[] = $row;
                        }
                    }
    
                    return $itemArray;
                }
            }
        }
    }