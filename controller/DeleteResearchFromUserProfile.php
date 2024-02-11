<?php
include "../model/authors.php";
include "../model/AmountDue.php";
include "../model/Research.php";
include "../model/Ratings.php";

$resID = intval($_GET['resID']);
$id = intval($_GET['id']);
try {
    $auth = Authors::Delete ($resID);
    $amount =  AmountDue::Delete($resID);
    $rating = Ratings::Delete($resID);

    $res=new Research ($resID);
    $res->DeleteRes();

    error_reporting(E_ERROR | E_PARSE);
    unlink("../public/uploads/".$id.'.ris');
    unlink("../public/docsFiles/" . $id . "-".$resID.".docx");
    echo '<script>location.replace("http://localhost/finalproject/view/userProfile.php?userID='.$id.'");</script>';

//    $page = $_SERVER['PHP_SELF'];
//    $sec = "0";
//    header("Refresh: $sec; url=$page");
}catch(Exception $e) {
    echo $e->getMessage();
//    header("Location: logout.php");

}
//finally {
////    $res=Research::Delete($_GET['resID']);
//    $res=new Research($_GET['resID']);
//    $res->DeleteRes();
////    echo $res->getAuthID();
////    unlink($res->getAuthID().".txt");
////    $status=unlink("../public/uploads/".$res->getAuthID().'.ris');
//    unlink("../public/uploads/".$res->getAuthID().'.ris');
////    if($status){
////        echo "File deleted successfully";
////    }else{
////        echo "Sorry!";
////    }
//    $page = $_SERVER['PHP_SELF'];
//$sec = "10";
//header("Refresh: $sec; url=$page");
//
//}






//$resID = intval($_GET['q']);



?>


