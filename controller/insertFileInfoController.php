<?php
session_start();

include "../model/AmountDue.php";
include "../model/Research.php";
include "../model/authors.php";
include "../model/login.php";
include "../model/scopus.php";
include "../model/Ratings.php";
$warning="";
if (isset($_POST['sub'])) {
    if (isset($_POST['pubmed'])) {
        $_SESSION['pubmed']  = $_POST['pubmed'];
    } else {
        $_SESSION['pubmed']  = $_POST['pubmed']=0;

    }
    if (isset($_POST['clarivate'])) {
        $_SESSION['clarivate']  = $_POST['clarivate'];
    } else {
        $_SESSION['clarivate']  = $_POST['clarivate']=0;

    }

    $_SESSION['multi'] = $_POST['multi'];
    $_SESSION['uniName'] = "";
//    $_SESSION['pubmed'] = $_POST['pubmed'];
//    $_SESSION['clarivate'] = $_POST['clarivate'];
    $_SESSION['foreign'] = "";
    if ($_POST['multi'] == 1) {
        $_SESSION['uniName'] = $_POST['uniName'];
    }
//    echo $_POST['tittle'];

//عشان امنع اضافة البحث اكثر من مرة لنفس الشخص
    $searchAboutTitle = Research::isFoundInTableByTitle($_SESSION['userid'],$_POST['tittle']);
    if (!$searchAboutTitle) {
        $res = new Research(0);
        $auth = new Authors(0);
//    $addUser=new User(0,0);
        try {
            if (count($_POST['authors']) == 1)
                $res->insert($_POST['tittle'], $_POST['journal'], $_SESSION['userid'], $_POST['authors'][0], $_POST['ISSN'], $_POST['EISSN'], $_POST['year'], $_POST['VL'], $_POST['IS'], 0);
            else
                $res->insert($_POST['tittle'], $_POST['journal'], $_SESSION['userid'], $_POST['authors'][$_POST['ItsMe'][0]], $_POST['ISSN'], $_POST['EISSN'], $_POST['year'], $_POST['VL'], $_POST['IS'], 0);


            $resObj = $res->selectBYTitle($_POST['tittle']);
            $_SESSION['journal'] = $_POST['journal'];
            $_SESSION['resID'] = $resObj->getId();

            $_SESSION['ISSN'] = $resObj->getISSN();
            if (count($_POST['authors']) == 1) {
                if ((int)$_POST['jordanian'][0] == 0)
                    $_SESSION['foreign'] = 1;
//            else
//                $_SESSION['foreign']=0;

                $auth->insert($_SESSION['userid'], 1, $_POST['authors'][0], $resObj->getId(), (int)$_POST['jordanian'][0]);
//            $addUser->insert($_POST['authorsID'][0],$_POST['authors'][0],$_POST['authorsID'][0],($_POST['authorsID'][0]."@mutah.edu.jo"),1);
            } elseif (count($_POST['authors']) > 1) {
                for ($i = 0; $i < count($_POST['authors']); $i++) {
                    if ($_POST['jordanian'][$i] == 0)
                        $_SESSION['foreign'] = 1;
//                else
//                    $_SESSION['foreign']=0;
                    if ($i == $_POST['ItsMe'][0])
                        $auth->insert($_SESSION['userid'], ($i + 1), $_POST['authors'][$i], $resObj->getId(), (int)$_POST['jordanian'][$i]);
                    else
                        $auth->insert((($_SESSION['userid'] + $i) * 250), ($i + 1), $_POST['authors'][$i], $resObj->getId(), (int)$_POST['jordanian'][$i]);

//                 $addUser->insert($_POST['authorsID'][$i],$_POST['authors'][$i],$_POST['authorsID'][$i],($_POST['authorsID'][$i]."@mutah.edu.jo"),1);
//                 echo $_POST['authorsID'][$i]." ";
                }
            }
            $ISSN = "";
            $splitISSNSESSION = str_split($_POST['ISSN'], 4);
            if (count($splitISSNSESSION) == 1) {
                $ISSN = $splitISSNSESSION[0];
                $_SESSION['ISSN'] = $ISSN;
            } elseif (count($splitISSNSESSION) == 2) {
                $ISSN = $splitISSNSESSION[0] . '-' . $splitISSNSESSION[1];
                $_SESSION['ISSN'] = $ISSN;
            } else
                $ISSN = "";
            include "../controller/setScoreController.php";
            header("Location: ../view/secondForm.php?userID=".$_SESSION['userid']);
//            header("Location: ../view/userProfile.php?id=".$_SESSION['userid']."&single=1");
//                exit();
//            if ($_POST['scopus'] == 1 && $_POST['pubmed'] == 0 && $_POST['clarivate'] == 0) {
//                header("Location: ../view/secondForm.php");
//                exit();
//
//            } elseif ($_POST['scopus'] == 1 && $_POST['pubmed'] == 1 && $_POST['clarivate'] == 1) {
//                header("Location: ../view/secondForm.php");
//                exit();
//            } elseif ($_POST['scopus'] == 0 && $_POST['pubmed'] == 1 && $_POST['clarivate'] == 0) {
//                echo "pubmed";
//            } elseif ($_POST['scopus'] == 0 && $_POST['pubmed'] == 0 && $_POST['clarivate'] == 1) {
//                echo "clrevate";
//            } elseif ($_POST['scopus'] == 0 && $_POST['pubmed'] == 0 && $_POST['clarivate'] == 0) {
//
//                echo "entre your journal Category";
//            } else
//                echo "a";


        } catch (Exception $e) {
//                    echo "<script>alert('تم رفع البحث مسبقا '".$_SESSION['resID'].");</script>";
            echo $e->getMessage();
//                    header("Location: logout.php");

        }
//    echo $_POST['scopus'];
//        header("Location: ../view/secondForm.php");


    }

//عشان امنع اضافة البحث اكثر من مرة لنفس الشخص

//___________________________________________________________________________________--
    else {

$_SESSION['warning']="تم رفع نفس البحث مسبقا ";

        echo '<script>

    location.replace("http://localhost/finalproject/view/MainPage.php?userID='.$_SESSION['userid'].'");
</script>';



//        header("Location: ../view/userProfile.php?id=" . $_SESSION['userid'] . "&single=1");
    }
//    echo "موجود قبل";
//___________________________________________________________________________________--
//عشان امنع اضافة البحث اكثر من مرة لنفس الشخص
}


//    echo $_SESSION['multi']."<br>".$_SESSION['unName'];
//}


    //    echo $_POST['tittle'] . "<br>";
//    echo $_POST['journal'] . "<br>";
//    echo $_POST['year'] . "<br>";
//    echo $_POST['ISSN'] . "<br>";
//    echo count($_POST['authors']);
//    foreach ($_POST['authors'] as $i)
//        echo $i."<br>";
//echo "<br>";
//    foreach ($_POST['authorsID'] as $i)
//        echo $i."<br>";
//    foreach ($_POST['jordanian'] as $i) {
//
//        echo $i . "<br>";
//    }
//print_r($_POST['jordanian']);

//print_r($_POST['ItsMe']);
//echo $_SESSION['foreign'];

?>