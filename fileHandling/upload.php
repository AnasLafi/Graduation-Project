
<?php
//session_start();
//if (isset($_POST["submit"])) {

    $target_dir = "../public/uploads/";
    $target_file = $_FILES["fileToUpload"]["name"];
    $uploadOk = 1;
    $extension= pathinfo($target_file,PATHINFO_EXTENSION);
    $rand=rand(0,1000);
//    $rename=$_SESSION['userid']."_".date("ymd").$rand;
    $rename=$_SESSION['userid'];
    $newName=$target_dir.$rename.".".$extension;
    // Check if file already exists
    if (file_exists($newName)) {
//        echo "Sorry, file already exists.<br>";
        $uploadOk = 1;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 40000 ) {
        echo "<h5 class='text-danger mx-5'> Sorry, your file is too large.</h5>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($extension!= "ris" ) {
        echo "<h5 class=' mx-5'>عذرا ، يسمح فقط لملفات <b>ris</b></h5>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<h5 class='mx-5'>عذرا ، لم يتم تحميل ملفك</h5>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newName)) {
            {
//                 echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
                 echo "<h5 class='text-success mx-5'>"."تم رفع الملف ".basename( $_FILES["fileToUpload"]["name"])."</h5>";
                // header("Location: http://localhost/uploadFilesAndGetContent/form.php?file=$newName");
                // header("Location: file.php?file=$newName");
                include "file.php";
                $result=fileDumpInForm($newName);
            }
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }


    }

//}
    ?>