<?php

    if (isset($_POST['fileBtn'])) {
        $file = $_FILES['file'];

        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        // file ext
        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));
        

        $arrayType = array("jpeg", "jpg", "png");

        if (in_array($fileActualExt, $arrayType)) {
            if ($fileError === 0) {
                if ($fileSize < 2000000) {
                    $fileLocation = "uploads/profile".$_SESSION['id']."*";
                    $fileInfo = glob($fileLocation);

                    if (count($fileInfo) > 0) {
                        unlink($fileInfo[0]);
                    }

                    $fileNewLocation = "uploads/profile".$_SESSION['id'].".".$fileActualExt;
                    move_uploaded_file($fileTmpName, $fileNewLocation);

                    $sql = "UPDATE profileimage SET status=0 WHERE userid=".$_SESSION['id']."";
                    $result = mysqli_query($dbh->conn, $sql);

                    if ($result) {
                        header("Location: userprofile.php?=profileImageUploadedSuccessfully");
                    }
                }
            }else{
                echo "An error occured while uploading the file!";
            }
        }else{
            echo "You cannot upload this type of file!";
        }
    }



    if (isset($_POST['deleteBtn'])) {
        $fileLocation = "uploads/profile".$_SESSION['id']."*";
        $fileInfo = glob($fileLocation);
        
        if (count($fileInfo) > 0) {
            unlink($fileInfo[0]);
            
            $sql = "UPDATE profileimage SET status=1 WHERE userid=".$_SESSION['id']."";
            $result = mysqli_query($dbh->conn, $sql);
    
            if ($result) {
                header("Location: userprofile.php?profileImageStatus=Deleted!");
            }
        }
    }