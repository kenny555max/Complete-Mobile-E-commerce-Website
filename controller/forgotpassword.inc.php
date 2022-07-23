<?php

    $email = "";
    $error = array();

    $dbh = new DBH();
    $forgotpassword = new FORGOTPASSWORD();

    if (isset($_POST['changePasswordBtn'])) {
        $email = mysqli_real_escape_string($dbh->conn, $_POST['email']);
        $password = mysqli_real_escape_string($dbh->conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($dbh->conn, $_POST['cpassword']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Invalid email address!";
        }
        if (empty($email)) {
            $error['email'] = "Email Required!";
        }
        if (empty($password)) {
            $error['password'] = "Password Required!";
        }
        if ($password !== $cpassword) {
            $error['password'] = "The two password does not match!";
        }

        if (count($error) === 0) {
            $encryptPassword = password_hash($password, PASSWORD_BCRYPT);
            $forgotpassword->changePassword($email, $encryptPassword);
        }
    }