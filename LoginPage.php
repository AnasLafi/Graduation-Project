<?php
session_start();
//print_r($_SESSION);
include "controller/loginController.php";
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="public/images/mulogo.ico"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام البحث العلمي - جامعة مؤته</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</head>
<body style="background: url(public/images/mutahbg.jpg) no-repeat center center fixed; background-size: cover; ">

<!--------------------------------------------------------------Start--------------------------------------------------------------------->
<br>
<br>
<br>

<center>
    <div class="container p-2 " >
        <form class="align-self-center w-50 p-5" style="background-color: rgba(255, 255, 255, 0.5);" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
            <div class="align-self-center pb-3">
                <img src="public/images/mulogo.png" height="100"><br>
                <h1 class="h2" style="font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;font-weight: bolder">نـظــام الــبــحــث العــلــمــي</h1>
            </div>
            <div class="m-3">
                <label for="exampleInputID1" class="form-label" style="font-weight:bold;">رقم المستخدم</label>
                <input type="ID" style="font-weight: 500;" class="form-control text-center" name="id" id="exampleInputID1" aria-describedby="IDHelp" value="<?php if(!empty( $_REQUEST['id']))echo  $_REQUEST['id']; else echo "";?>">
            </div>
            <div class="m-3">
                <label for="exampleInputPassword1" class="form-label" style="font-weight:bold;">كلمة المرور</label>
                <input type="password" style="font-weight: 500;" class="form-control text-center" name="pass" id="exampleInputPassword1" value="<?php if(!empty( $_REQUEST['pass']))echo  $_REQUEST['pass']; else echo "";?>">

            </div>

            <button type="submit" class="btn btn-dark px-5 m-3" name="sub">الدخول</button>
            <br>
            <label style="font-size:small;font-weight: bolder;"> اذا كنت لا تملك حساب</label>
            <br>

<!--            <a href="view/signIn.php"><button  class="btn btn-danger px-5">التسجيل </button></a>-->
            <a href="view/signIn.php" class="btn btn-danger" role="button">التسجيل</a>
            <br>
            
            <?php if(!empty($errorMessage)) echo '<div class="alert alert-dark" role="alert">'.$errorMessage.'</div>';?>
            <a href="view/tutorial.html" class="btn btn-link" role="button"> دليل الاستخدام</a>
<!--                        <a href="view/tutorial.html" class="btn btn-dark px-3 m-3" role="button"> دليل الاستخدام</a>-->


        </form>
    </div>
</center>









<!--------------------------------------------------------------End--------------------------------------------------------------------->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>