<?php
include "../controller/insertUsers.php";
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="mulogo.ico"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام البحث العلمي - جامعة مؤته</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIrbVsLSE38QQA5v5+gK6k/UzO0bpvHTcU6W8Bm3LRJ1jEb1po6LHW8Qx/oR+L/Q==" crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</head>
<body style="background: url(../public/images/mutahbg.jpg) no-repeat center center fixed; background-size: cover; ">

<!--------------------------------------------------------------Start--------------------------------------------------------------------->
<!--<br>-->
<!--<br>-->
<!--<br>-->
<!--<a href="../LoginPage.php">log in page</a>-->
<center>
    <div class="container p-5 " >
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" class="align-self-center w-50 p-5" style="background-color: rgba(255, 255, 255, 0.5);">
            <div class="align-self-center pb-3">
                <img src="../public/images/mutahlogo.png "height="100"><br>
                <h1  style="font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;font-weight: bolder">Sign Up</h1>
            </div>
            <div class="m-2">
                <label for="id" class="form-label" style="font-weight:bold;">ID</label>
                <input type="ID" style="font-weight: 500;" class="form-control text-center" name="ID" id="ID" aria-describedby="IDHelp" required value="<?php if(!empty( $_POST['ID']))echo  $_POST['ID']; else echo "";?>">
            </div>
            <div class="m-2">
                <label for="name" class="form-label" style="font-weight:bold;">Name</label>
                <input type="Name" style="font-weight: 500;" class="form-control text-center" name="userName" id="name" required value="<?php if(!empty( $_POST['userName']))echo  $_POST['userName']; else echo "";?>">
            </div>

            <div class="m-2">
                <label for="password" class="form-label" style="font-weight:bold;">Password</label>
                <input type="Password" style="font-weight: 500;" class="form-control text-center" id="password" name="userPass" required value="<?php if(!empty( $_POST['userPass']))echo  $_POST['userPass']; else echo "";?>">
            </div>

            <div class="m-2">
                <label for="email" class="form-label" style="font-weight:bold;">Email</label>
                <input type="email" style="font-weight: 500;" class="form-control text-center" id="email" name="userEmail" value="<?php if(!empty( $_POST['userEmail']))echo  $_POST['userEmail']; else echo "";?>" required>
            </div>


            <input type="submit" name="sub" value="submit" class="btn btn-primary px-5">

            <br>

            <?php if(!empty($errorMsg)) echo '<div class="alert alert-danger" role="alert">'.$errorMsg.'</div>';?>
        </form>
    </div>
</center>







<!--<script >-->
<!--    // document.getElementById("name").onkeyup = function() {-->
<!--        // let name = document.getElementById("name");-->
<!--        let email = document.getElementById("email");-->
<!--        email.value ="@gmail.com";-->
<!---->
<!---->
<!---->
<!--</script>-->

<!--------------------------------------------------------------End--------------------------------------------------------------------->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>