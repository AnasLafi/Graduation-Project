<?php
//session_start();
include "model/login.php";
include "model/authors.php";
// include "../view/login.php";
include "classView/userView.php";
//include "../controller/showData.php";


$errorMessage="";
if (isset($_REQUEST['sub'])) {
    if (empty($_REQUEST['id'])&&empty($_REQUEST['pass'])){

        $errorMessage="يرجى ادخال رقم المستخدم و كلمة المرور";

    }
    elseif(empty($_REQUEST['id'])||empty($_REQUEST['pass']))
    {
        if(empty($_REQUEST['id']))
            $errorMessage="رقم المستخدم فارغ";
        elseif(empty($_REQUEST['pass']))
            $errorMessage="كلمة المرور فارغة";
    }

    elseif (filter_var($_REQUEST['id'], FILTER_VALIDATE_INT) ) {
        $user=new User($_REQUEST["id"],$_REQUEST["pass"]);

        if ($user->get_role()==1) {
            $_SESSION['userid']=$_REQUEST['id'];
            $_SESSION['journal']="";
            $_SESSION['resID']="";
//            print_r(  $user->checkIfFoundInResearchTable($_REQUEST['id']));
            if ($user->checkIfFoundInResearchTable($_REQUEST['id'])[0]){
//                if ($user->get_valid()){

//                $auth=Authors::selectByResID($user->checkIfFoundInResearchTable($_REQUEST['id'])[1]);
                header("Location: view/userProfile.php?userID=".$_REQUEST["id"]);

            }
            else
                header("Location: view/MainPage.php?userID=".$_REQUEST['id']);
//                header("Location: view/uploadPage.php");
        }
        elseif ($user->get_role()==2) {
            $_SESSION['adminID']=$_REQUEST['id'];
            header("Location: view/admin.php?adminID=".$_REQUEST['id']);
        }
        // header("Location: view/uploadPage.php");
        elseif (!$user->get_valid()&&User::checkIfFoundInLogInTable($_REQUEST["id"])==true) {
            $errorMessage="كلمة المرور غير صحيحة للحساب رقم  <b>".$_REQUEST["id"]."</b>";

        }
        elseif (User::checkIfFoundInLogInTable($_REQUEST["id"])==false) {
            $errorMessage="الحساب رقم <b>".$_REQUEST["id"]."</b> غير موجود يرجى إضافة حساب ";
        }
        // header("Location: view/login.php");
    } elseif(is_string($_REQUEST['id'])) {

            $errorMessage="user name must be number not string <b>".$_REQUEST['id']."</b>";
    }
}

//if (!empty($errorMessage)) {
//
//    $Message = "<p style='color: red;'>{$errorMessage}</p>";
//}

?>