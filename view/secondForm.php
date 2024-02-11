<?php
//include '../excelHandling/excelProcess.php';
//include '../excelHandling/so.php';
//include '../excelHandling/so.php';


session_start();
//
unset($_SESSION['warning']);
$_SESSION['userid']=$_GET['userID'];
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
/*if ($_POST['multi']==0){
    echo $_POST['uniName'];
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../public/mulogo.ico"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>التـقـديم للأبــحاث - جامعة مؤته</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>



</head>
<body >
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-weight:Bold ;" dir="rtl">
    <div class="container-fluid mx-0">
        <img src="../public/images/navbarlogo.png" class="">
        <a class="navbar-brand col-5" href="#">تــقديـم البحــث العــلــمــي</a>
        <div class="">
            <a class="btn btn-dark" href="https://www.mutah.edu.jo/Home.aspx" target="_blank">موقع الجامعة</a>
        </div>
        <div>
            <a class="btn btn-dark" href="https://www.scopus.com" target="_blank">Scopus</a>
        </div>
        <div>
            <a class="btn btn-dark" href="https://pubmed.ncbi.nlm.nih.gov/" target="_blank">Pubmed</a>
        </div>
        <div class="">
            <a class="btn btn-dark" href="https://clarivate.com/" target="_blank">Clarivate</a>
        </div>
        <div class="align-content-end">
            <a href="../controller/logout.php" class="btn btn-primary px-5 ">تسجيل الخروج</a>

            <!-------
            <button class="btn btn-light" id="logout" style="font-weight:bold ;">تسجيل الخروج</button>
            ------->
            <!--            <a href="../controller/logout.php" class="btn btn-light" role="button">تسجيل الخروج</a>-->
        </div>


    </div>
</nav>
<center class="my-5">
    <img src="../public/images/thanks.png">


    <!--    <h1>quartile = --><?php // echo $quartile;?><!--</h1>-->
    <h1 class="m-3">تم إرسال طلبك بنجاح , شكراً لوقتك</h1>
    <h3 class="my-5">الرجاء الإنتظار لمعاينة طلبك</h3>
    <a href="../view/userProfile.php?userID=<?php echo  $_SESSION['userid'];?>" class="btn btn-primary px-5 ">الملف الشخصي</a>
    <a href="../view/MainPage.php?userID=<?php echo $_SESSION['userid'];?>" class="btn btn-primary px-5 ">إضافة بحث</a>



</center>
<!--<h1>--><?php //print_r($_SESSION);?><!--</h1>-->


</body>
</html>
