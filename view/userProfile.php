<?php
session_start();
session_unset();
include '../controller/showData.php';

$_SESSION['userid']=$_GET['userID'];
//echo $_SESSION['userid'];
// print_r($_SESSION);

$isFoundInTable=User::isFound($_GET['userID']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>User Profile</title>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-weight:Bold ;" dir="rtl">
    <div class="container-fluid mx-0">
        <img src="../public/images/navbarlogo.png" class="">
        <a href="../view/userProfile.php?userID=<?php echo  $_SESSION['userid'];?>" class="navbar-brand col-1">الملــف الشــخــصــي</a>

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
            <!-------
            <button class="btn btn-light" id="logout" style="font-weight:bold ;">تسجيل الخروج</button>
            ------->
            <a href="../controller/logout.php" class="btn btn-light" role="button">تسجيل الخروج</a>
        </div>


    </div>
</nav>

<!-- Main content -->
<div class="col-10 container rounded bg-light mt-5 mb-5 ">
    <div class="row" >
        <div class="col-md-3 border-right" >
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php echo $user->get_name();?></span><span class="text-black-50"><?php echo $user->get_email();?></span><span> </span></div>
            <?php
            if($isFoundInTable){
            if($user->get_role()==1){

            ?>
            <div class=" text-center ">
                <a href="../view/MainPage.php?userID=<?php echo $_GET['userID'];?>" class="btn btn-primary profile-button px-3 ">إضافة بحث</a>

            </div>
            <?php
            }
            }
            ?>
        </div>
        <div class="col-md-4 border-right text-right  "  dir="rtl">
            <div class="p-3 py-5" >
                <div class="d-flex justify-content-between align-items-center mb-3 ">
                    <h4 class="text-right ">المعلومات الشخصية</h4>
                </div>
                <div class="row mt-2" >
                    <div class="col-md-12"><label class="labels">الاسم</label><input type="text" class="form-control" disabled dir="ltr" value="<?php echo $user->get_name();?>"></div>
                    <div class="col-md-12 mt-2"><label class="labels">رقم المستخدم</label><input type="text" disabled class="form-control"  dir="ltr" value="<?php echo $user->get_id();?>"></div>
                    <div class="col-md-12 mt-2"><label class="labels">البريد الالكتروني</label><input type="text" disabled class="form-control" dir="ltr" value="<?php echo $user->get_email();?>"></div>
                </div>
                <br>
                <hr class="bg-dark">
                <form action="" method="post">
                <div class="row mt-3">

                    <div class="col-md-12 mt-2 text-md-center"><h3><u>تغيير كلمة السر</u></h3> </div>
                    <div class="col-md-12 mt-2"><label class="labels">كلمة السر القديمة</label><input type="text" class="form-control"  name="oldPass" value="<?php if(!empty( $_REQUEST['oldPass']))echo  $_REQUEST['oldPass']; else echo "";?>"></div>
                    <div class="col-md-12 mt-2"><label class="labels">كلمة السر الجديدة</label><input type="text" class="form-control" name="newPass" value="<?php if(!empty( $_REQUEST['newPass']))echo  $_REQUEST['newPass']; else echo "";?>"></div>
                    <div class="col-md-12 mt-2"><label class="labels">تأكيد كلمة السر</label><input type="text" class="form-control" name="confirmPass" value="<?php if(!empty( $_REQUEST['confirmPass']))echo  $_REQUEST['confirmPass']; else echo "";?>"></div>
                    <div class="mt-3 text-center " style="margin-right: 40%;"><input type="submit" name="submitPassword" class="btn btn-primary profile-button px-3" value="حفظ"></div>

                </div>
                </form>
                <?php
                if (isset($_POST['submitPassword'])){
                    include "../controller/changeUserPassword.php";
                }
                ?>
                <br>
                <hr class="bg-dark">
                <form action="" method="post">

                <div class="row mt-3">

                    <div class="col-md-12 mt-2 text-md-center"><h3><u>تغيير البريد الالكتروني</u></h3> </div>
                    <div class="col-md-12 mt-2"><label class="labels">البريد الالكتروني الجديد</label><input type="email" class="form-control" name="email" value="<?php if(!empty( $_REQUEST['email']))echo  $_REQUEST['email']; else echo "";?>"></div>
                    <div class="mt-3 text-center " style="margin-right: 40%;"><input type="submit" name="submitEmail" class="btn btn-primary profile-button px-3" value="حفظ"></div>

                </div>
                </form>
                <?php
                if (isset($_POST['submitEmail'])){
                    include "../controller/changeUserEmail.php";

                }
                ?>



                <!-- <div class="row mt-3 mt-2">

                </div> -->

            </div>
        </div>
        <div class="col-md-5 text-right"  dir="rtl" style="width: 30rem;">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center"><h4>أبحاثي</h4></div><br>

                <?php



                if($isFoundInTable){
                    if($user->get_role()==1)
                        $view->selectAllResearchForUserProfile($res);

                    else
                        echo"<center><p style='color: red;'>Error Admin ID not found</p></center>";

                }
                else
                    echo"<center><p style='color: red;'>Error Admin ID not found</p></center>";
//


                ?>





                <br>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>