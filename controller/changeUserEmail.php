<?php
//include "../model/login.php";
$Msg="";
$user=User::select($_GET['userID']);
//echo $_POST['oldPass']."<br>";
//print_r($res);
//    echo $user->getPass()."<br>";



if (!empty($_POST['email'])) {
    if ($_POST['email']==$user->get_email())
            $Msg=" البريد الالكتروني الجديد مطابق للبريد القديم ";
        else {
            $user = User::updateUserEmail($_GET['userID'], $_POST['email']);
            //here send email after update
            foreach($res as $key => $value){
                if ($value->getStatus()==3){

//                echo $value->getStatus();
                echo '<script>
var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    console.log( this.responseText);

                }
            }
            xmlhttp.open("GET","../controller/sendEmailWhenResearchHasBeenEvaluated.php?resID='.$value->getID().'&id='.$value->getAuthID().'",true);
            xmlhttp.send();
</script>';

                }
            }
            $Msg = "تم تحديث البريد الالكتروني";
            echo "<script>
//let countdown = 2;
//
//const intervalId = setInterval(function() {
//console.log(countdown);
//  countdown--;
//
//  if (countdown === 0) {
      location.replace('../view/userProfile.php?userID=".$_SESSION['userid']."');
//    console.log('Done!');
//    clearInterval(intervalId);
//  }
//}, 1000);
</script>";

        }

}
else
    $Msg= "البريد الالكتروني الجديد فارغ<br>";



//    echo $_POST['newPass']."<br>";
//    echo $_POST['confirmPass']."<br>";


echo $Msg;
