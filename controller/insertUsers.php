<?php
include "../model/login.php";
$errorMsg="";
if (isset($_POST['sub'])){
    $checkIfFound=User::checkIfFoundInLogInTable($_POST['ID']);
//    echo $checkIfFound;
if (filter_var($_POST['ID'], FILTER_VALIDATE_INT) ) {
    if (!$checkIfFound) {
        $newUser = new User(0, 0);
        $newUser->insert($_POST['ID'], $_POST['userName'], $_POST['userPass'], $_POST['userEmail'], 1);
//        $errorMsg="الرجاء انتظر <span id='counter'></span> ثواني ثم تستطيع عمل تسجيل دخول";
        echo "<script>
//let countdown = 3;
//
//const intervalId = setInterval(function() {
//  document.getElementById('counter').textContent = countdown;
//console.log(countdown);
//  countdown--;
//
//  if (countdown === 0) {
      location.replace('http://localhost/finalproject/LoginPage.php');
//    console.log('Done!');
//    clearInterval(intervalId);
//  }
//}, 1000);
</script>";
    }
    else
        $errorMsg ="الحساب رقم <b>".$_POST['ID']." </b>موجود  ";
}
elseif(is_string($_POST['ID']))
    $errorMsg="user name must be number not string <b>".$_POST['ID']."</b>";

//     header("Location: ../LoginPage.php");

//    echo $errorMsg;
}
