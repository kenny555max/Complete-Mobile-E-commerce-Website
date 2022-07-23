<?php

    class LOGIN extends DBH {
        public function checkUser($email = null, $password = null, $table = "users") {
            if ($this->conn !== null) {
                if (isset($email)) {
                    $sql = sprintf("SELECT * FROM %s WHERE email='%s'", $table, $email);
                    $result = mysqli_query($this->conn, $sql);
                    $check = mysqli_num_rows($result);
                    
                    if ($check > 0) {
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $hash = $row['password'];
                        
                        if (password_verify($password, $hash)) {
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['email'] = $row['email'];

                            header("Location: index.php?=loginSUccessfully");
                        }else{
                            echo "Incorrect password!";
                        }
                    }else{
                        echo "User data does not exist in our database!";
                    }
                }
            }
        }
    }