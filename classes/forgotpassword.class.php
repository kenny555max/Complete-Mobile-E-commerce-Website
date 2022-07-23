<?php

    class FORGOTPASSWORD extends DBH {
        public function changePassword($email = null, $password = null, $table = "users") {
            if ($this->conn !== null) {
                if (isset($email) && isset($password)) {
                    $sql = sprintf("SELECT email FROM %s WHERE email='%s'", $table, $email);
                    $result = $this->conn->query($sql);
                    $check = mysqli_num_rows($result);

                    if ($check > 0) {
                        $sqlUpdate = sprintf("UPDATE %s SET password='%s' WHERE email='%s'", $table, $password, $email);
                        $resultUpdate = $this->conn->query($sqlUpdate);

                        if ($resultUpdate) {
                            header("Location: login.php?=passwordSuccessfullyChanged!");
                        }
                    }else{
                        echo "<p class='bg-danger font-weight-bolder text-white p-2'>This user does not exist in our database!. Kindly enter a valid email.</p>";
                    }
                }
            }
        }
    }