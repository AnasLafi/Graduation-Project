<?php
//include "../model/login.php";
    $Msg="";
$user=User::select($_GET['userID']);
//echo $_POST['oldPass']."<br>";

//    echo $user->getPass()."<br>";
if (!empty($_POST['oldPass'])) {
    if ($_POST['oldPass']==$user->getPass()){
        if (!empty($_POST['newPass'])&&!empty($_POST['confirmPass'])){
            if ( $_POST['newPass']==$_POST['confirmPass']) {
                $user = User::updateUserPassword($_GET['userID'], $_POST['newPass']);
                $Msg="تم تحديث كلمة السر";
            }

            else
                $Msg="كلمة المرور الجديدة ليست مطابقة للأخرى";

        }
        else
            $Msg= "كلمة السر الجديدة او تأكيد كلمة السر فارغة<br>";

    }
    else
        $Msg="كلمة المرور القديمة ليست صحيحة";
}
else
    $Msg= "كلمة السر القديمة فارغة<br>";



//    echo $_POST['newPass']."<br>";
//    echo $_POST['confirmPass']."<br>";


echo $Msg;
