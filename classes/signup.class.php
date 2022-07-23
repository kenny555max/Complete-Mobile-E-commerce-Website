<?php

    class SIGNUP extends DBH {
        public function insertUserData($param = null, $table = "users") {
            if ($this->conn !== null) {
                if ($param !== null) {
                    $columns = "`".implode("`,`", array_keys($param))."`";
                    $values = "'".implode("','", array_values($param))."'";

                    $sql = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);
                    $result = mysqli_query($this->conn, $sql);

                    if ($result) {
                        header("Location: signup.php?=registerationSuccessful");
                    }
                }
            }
        }

        public function checkUser($email, $table = "users") {
            if ($this->conn !== null) {
                if (isset($email)) {
                    $sql = sprintf("SELECT email FROM %s WHERE email='%s'", $table, $email);
                    $result = mysqli_query($this->conn, $sql);
                    $check = mysqli_num_rows($result);

                    if ($check > 0) {
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }
    }