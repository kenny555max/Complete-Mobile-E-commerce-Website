<?php
    session_start();
    include "../classes/dbh.class.php";

    $dbh = new DBH();

    if (isset($_POST['addComment'])) {
        $comment = mysqli_real_escape_string($dbh->conn, $_POST['comment']);

        $sql = "INSERT INTO comments (userid, comment, date) VALUES ('".$_SESSION['id']."', '$comment', NOW())";
        $result = mysqli_query($dbh->conn, $sql);

        if ($result) {
            $sqlSelect = "SELECT users.email, comments.comment, DATE_FORMAT(comments.date, '%Y-%m-%d') AS date FROM comments INNER JOIN users ON comments.userid=users.id WHERE userid='".$_SESSION['id']."' ORDER BY comments.id DESC LIMIT 1";
            $resultSelect = mysqli_query($dbh->conn, $sqlSelect);
            $check = mysqli_num_rows($resultSelect);

            $response = [];

            if ($check > 0) {
                if ($data = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {
                    $response[] = commentRow($data);
                }
            }

            echo json_encode($response);
        }
    }

    if (isset($_POST['getComment'])) {
        $start = mysqli_real_escape_string($dbh->conn, $_POST['start']);

        $sql = "SELECT users.email, comments.comment, DATE_FORMAT(comments.date, '%Y-%m-%d') AS date FROM comments INNER JOIN users ON comments.userid=users.id WHERE userid='".$_SESSION['id']."' ORDER BY comments.id DESC LIMIT $start, 20";
        $result = mysqli_query($dbh->conn, $sql);

        $response = [];

        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $response[] = commentRow($data);
            }
        }

        echo json_encode($response);
    }

    function commentRow($data) {
        return '<div class="usercomments">
                <h5 class="user"><span class="email">'.$data['email'].'</span><small> '.$data['date'].'</small></h5>
                <div class="comment">'.$data['comment'].'</div>
            </div><br>';
    }