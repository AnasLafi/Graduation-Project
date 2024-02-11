<?php

include '../model/Research.php';
include '../model/login.php';
include "../classView/adminView.php";
include "../classView/userView.php";
//admin page
if (isset($_GET['adminID'])) {
    
    $res=Research::selectAll();
//    $res=new Research(555);
    $view=new adminView();

}
//more info in admin page for each research
//if (isset($_GET['id'],$_GET['addition'])){
//echo "anas lafi";
//}

//allUsers Page
if (isset($_GET['id'])){
    $auth = Authors::selectByResID($_GET['id']);
    $view=new userView();
}
//user profile
if (isset($_GET['userID'])){
    $user= User::select($_GET['userID']);

    $res=Research::selectAllResWhereHaveSameAuthor($_GET['userID']);
    $view=new userView();
}
//profile
//if (isset($_GET['id'],$_GET['single'])){
//
//
////    if ($_GET['single']==1){
//////        $user= User::select($_GET['id']);
////
////        $res=Research::selectAllResWhereHaveSameAuthor($_GET['id']);
////        $view=new userView();
////
//////        $view=new adminView();
////    }
//    if ($_GET['single']==0){
////        $auth=Authors::selectByResID($_GET['id']);
//        $auth=Authors::selectByName($_GET['id']);
//        $view=new userView();
//
//
//    }
//}


