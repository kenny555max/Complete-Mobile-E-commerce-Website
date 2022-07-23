<?php

    $username = "";
    $email = "";
    $error = array();

    $dbh = new DBH();
    $signup = new SIGNUP();

    if (isset($_POST['signupBtn'])) {
        $username = mysqli_real_escape_string($dbh->conn, $_POST['username']);
        $email = mysqli_real_escape_string($dbh->conn, $_POST['email']);
        $password = mysqli_real_escape_string($dbh->conn, $_POST['password']);

        if (empty($username)) {
            $error['username'] = "Username Required!";
        }   
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Invalid email address!";
        }
        if (empty($email)) {
            $error['email'] = "Email Required!";
        }
        if (empty($password)) {
            $error['password'] = "Password Required!";
        }else{
            if ($signup->checkUser($email)) {
                $error['email'] = "User already ecist in our database!. Kindly enter another email";
            }else{
                if (count($error) === 0) {
                    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $param = array(
                        "username" => $username,
                        "email" => $email,
                        "password" => $encryptedPassword
                    );
    
                    $signup->insertUserData($param);
                }
            }
        }
    }