<?php
    include "includes/__header.php";
    $dbh = new DBH();
    include "controller/profile.inc.php";

    $sql = "SELECT * FROM comments WHERE userid=".$_SESSION['id']."";
    $result = mysqli_query($dbh->conn, $sql);
    $numOfComments = mysqli_num_rows($result);
?>

    <div class="col-lg-12 mt-4">
        <div class="container">
            <div class="col-lg-7">
                <div class="profile d-flex justify-content-between shadow-lg p-4">
                    <?php

                        $sql = "SELECT * FROM profileimage WHERE userid=".$_SESSION['id']."";
                        $result = mysqli_query($dbh->conn, $sql);
                        $check = mysqli_num_rows($result);

                        if ($check > 0) {
                            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                if ($row['status'] == 0) {
                                    $fileLocation = "uploads/profile".$_SESSION['id']."*";
                                    $fileInfo = glob($fileLocation);
                                    $fileExt = explode(".", $fileInfo[0]);
                                    $fileActualExt = strtolower(end($fileExt));
                                    
                                    echo '<div class="profileimg">
                                            <img style="height: 200px;width: 200px;" src="uploads/profile'.$_SESSION['id'].'.'.$fileActualExt.'?'.mt_rand().'" alt="profile-image">
                                        </div>';
                                }else{
                                    echo '<div class="profileimg">
                                            <img style="height: 200px;width: 200px;" src="uploads/default.png" alt="profile-image">
                                        </div>';             
                                }
                            }
                        }else{
                            $sqlInsert = "INSERT INTO profileimage (userid, status) VALUES (".$_SESSION['id'].", 1)";
                            $resultInsert = mysqli_query($dbh->conn, $sqlInsert);
                        }
                    ?>
    
                    <div class="profileDetails">
                        <h5><?php echo $_SESSION['username']; ?></h5>
                        <h5><?php echo $_SESSION['email']; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="container">
            <div class="col-lg-7 mt-4">
                <div class="uploadimage">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" class="d-flex" enctype="multipart/form-data" method="POST">
                        <input type="file" name="file" class="form-control">
                        <button type="submit" class="btn btn-primary" name="fileBtn">UPLOAD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 mb-4">
        <div class="container">
            <div class="col-lg-7 mt-4">
                <div class="deleteimage">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <button type="submit" class="btn btn-warning font-weight-bolder" name="deleteBtn">DELETE PROFILEIMAGE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 mt-4 mb-4">
        <div class="container">
            <div class="col-lg-7">
                <h4 class="text-primary font-weight-light">LEAVE US A COMMENT</h4>

                <div class="comment text-right">
                    <form action="">
                        <textarea name="comment" id="commentBox" placeholder="comment................." class="form-control mb-2" id="" rows="4"></textarea>
                        <button type="button" class="btn btn-primary" id="commentBtn">Add Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 mt-4 mb-4">
        <div class="container">
            <div class="col-lg-7">
                <h4 class="text-primary numComments font-weight-bolder"><span class="numOfComments"><?php echo $numOfComments; ?></span> Comments</h4>

                <div class="comments">

                </div>
            </div>
        </div>
    </div>

<?php
    include "includes/__footer.php";
?>