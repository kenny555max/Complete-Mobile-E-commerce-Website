<?php

    $email = "";
    $error = array();

    $dbh = new DBH();
    $login = new LOGIN();

    if (isset($_POST['loginBtn'])) {
        $email = mysqli_real_escape_string($dbh->conn, $_POST['email']);
        $password = mysqli_real_escape_string($dbh->conn, $_POST['password']);

        if (empty($email)) {
            $error['email'] = "Email Required!";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Invalid email address!";
        }
        if (empty($password)) {
            $error['password'] = "Passord Required!";
        }else{
            $login->checkUser($email, $password);
        }
    }