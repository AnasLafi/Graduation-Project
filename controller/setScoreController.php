<?php
//session_start();
//include "../model/AmountDue.php";
//include "../model/Research.php";
//include "../model/authors.php";
//include "../model/login.php";
//include "../model/scopus.php";
//include "../model/Ratings.php";
//print_r($_SESSION);
include "wordFile.php";
$searchAuth=Research::isFoundInTable($_SESSION['resID']);
if (!$searchAuth) {
    $findInScopus = new Scopus($_SESSION['ISSN']);
    $res = new Research($_SESSION['resID']);
//echo $findInScopus->getQuartile()."<br>".$findInScopus->isFound()."<br>";
//echo $res->getId()."<br>";
    $rating=new Ratings(0);
    $authors=Authors::selectRes($_SESSION['resID']);
    if ($findInScopus->isFound()){

        $rating->insert($res->getId(),$findInScopus->getQuartile(),$_SESSION['clarivate'],$_SESSION['pubmed'],$_SESSION['foreign'],$_SESSION['multi'],$_SESSION['uniName']);
    }
    else
        $rating->insert($res->getId(),"-",$_SESSION['clarivate'],$_SESSION['pubmed'],$_SESSION['foreign'],$_SESSION['multi'],$_SESSION['uniName']);


//insert amount to each resarcher
    $getRating=new Ratings($_SESSION['resID']);
    $amount=0;
    if ($getRating->getScopus()==="-"){
        $amount=0;
        $res->updateStatus($_SESSION['resID'],1);

    }
    elseif ($getRating->getScopus()==="0."){
        $amount=0;
        $res->updateStatus($_SESSION['resID'],1);

    }
    //باسم جامعة مؤتة و يوجد باحث اجنبي
    elseif ($getRating->getMultipleUniversities()==0&&$getRating->getForeignResearcher()==1 ){
        if ($getRating->getScopus()==="Q1"&& $getRating->getClarivate()==1)
            $amount=1200;

        elseif ($getRating->getScopus()==="Q1"&& $getRating->getClarivate()==0)
            $amount=(1200*80)/100;

        if ($getRating->getScopus()==="Q2"&& $getRating->getClarivate()==1)
            $amount=(1200*85)/100;
        elseif ($getRating->getScopus()==="Q2"&& $getRating->getClarivate()==0)
            $amount=(1200*70)/100;

        if ($getRating->getScopus()==="Q3"&& $getRating->getClarivate()==1)
            $amount=(1200*70)/100;
        elseif ($getRating->getScopus()==="Q3"&& $getRating->getClarivate()==0)
            $amount=(1200*50)/100;
        if ($getRating->getScopus()==="Q4"&& $getRating->getClarivate()==1)
            $amount=(1200*60)/100;
        elseif ($getRating->getScopus()==="Q4"&& $getRating->getClarivate()==0)
            $amount=(1200*10)/100;
            $res->updateStatus($_SESSION['resID'],2);
            

    }
    //باسم جامعة مؤتة والباحثين اردنيين
    elseif ($getRating->getMultipleUniversities()==0&&$getRating->getForeignResearcher()==0 ){
        if ($getRating->getScopus()==="Q1"&& $getRating->getClarivate()==1)
            $amount=1000;

        elseif ($getRating->getScopus()==="Q1"&& $getRating->getClarivate()==0)
            $amount=(1000*80)/100;

        if ($getRating->getScopus()==="Q2"&& $getRating->getClarivate()==1)
            $amount=(1000*85)/100;
        elseif ($getRating->getScopus()==="Q2"&& $getRating->getClarivate()==0)
            $amount=(1000*70)/100;

        if ($getRating->getScopus()==="Q3"&& $getRating->getClarivate()==1)
            $amount=(1000*70)/100;
        elseif ($getRating->getScopus()==="Q3"&& $getRating->getClarivate()==0)
            $amount=(1000*50)/100;
        if ($getRating->getScopus()==="Q4"&& $getRating->getClarivate()==1)
            $amount=(1000*60)/100;
        elseif ($getRating->getScopus()==="Q4"&& $getRating->getClarivate()==0)
            $amount=(1000*10)/100;
        $res->updateStatus($_SESSION['resID'],2);

    }
    //باسم جامعة اخرى و يوجد باحث اجنبي
    elseif ($getRating->getMultipleUniversities()==1&&$getRating->getForeignResearcher()==1 ){
        if ($getRating->getScopus()==="Q1"&& $getRating->getClarivate()==1)
            $amount=1200/2;

        elseif ($getRating->getScopus()==="Q1"&& $getRating->getClarivate()==0)
            $amount=((1200*80)/100)/2;

        if ($getRating->getScopus()==="Q2"&& $getRating->getClarivate()==1)
            $amount=((1200*85)/100)/2;
        elseif ($getRating->getScopus()==="Q2"&& $getRating->getClarivate()==0)
            $amount=((1200*70)/100)/2;

        if ($getRating->getScopus()==="Q3"&& $getRating->getClarivate()==1)
            $amount=((1200*70)/100)/2;
        elseif ($getRating->getScopus()==="Q3"&& $getRating->getClarivate()==0)
            $amount=((1200*50)/100)/2;
        if ($getRating->getScopus()==="Q4"&& $getRating->getClarivate()==1)
            $amount=((1200*60)/100)/2;
        elseif ($getRating->getScopus()==="Q4"&& $getRating->getClarivate()==0)
            $amount=((1200*10)/100)/2;
        $res->updateStatus($_SESSION['resID'],2);

    }
    //باسم جامعة اخرى و الباحثين اردنيين

    elseif ($getRating->getMultipleUniversities()==1&&$getRating->getForeignResearcher()==0 ){
        if ($getRating->getScopus()==="Q1"&& $getRating->getClarivate()==1)
            $amount=1000/2;

        elseif ($getRating->getScopus()==="Q1"&& $getRating->getClarivate()==0)
            $amount=((1000*80)/100)/2;

        if ($getRating->getScopus()==="Q2"&& $getRating->getClarivate()==1)
            $amount=((1000*85)/100)/2;
        elseif ($getRating->getScopus()==="Q2"&& $getRating->getClarivate()==0)
            $amount=((1000*70)/100)/2;

        if ($getRating->getScopus()==="Q3"&& $getRating->getClarivate()==1)
            $amount=((1000*70)/100)/2;
        elseif ($getRating->getScopus()==="Q3"&& $getRating->getClarivate()==0)
            $amount=((1000*50)/100)/2;
        if ($getRating->getScopus()==="Q4"&& $getRating->getClarivate()==1)
            $amount=((1000*60)/100)/2;
        elseif ($getRating->getScopus()==="Q4"&& $getRating->getClarivate()==0)
            $amount=((1000*10)/100)/2;
        $res->updateStatus($_SESSION['resID'],2);

    }


//echo $amount."<br>";
    $auth=Authors::selectByResID($_SESSION['resID']);
//echo count($auth)."<br>";
    $insertAmount=new AmountDue($_SESSION['resID']);
    $insertAmount->insert($_SESSION['resID'],count($auth),$amount,($amount/count($auth)));
    GenerateWordFile($res->getAuthID(),$res->getId());


}
else
    echo "found";

//
//echo count($authors);
//for ($i=0; $i <count($authors) ; $i++) {
//
//    echo $authors[$i]->getResID()."   ".$authors[$i]->getAuthorsRanking()." : ".$authors[$i]->getResID()." : ".$authors[$i]->getAuthName()."<br>";
//}
////            echo $findInScopus->isFound();





////include "excelProcess.php";
//include "../excelHandling/excelProcess.php";
////print_r($_SESSION);
//$d=$spreadsheet->getSheet(0)->toArray();
////echo count($d);
//$sheetData = $spreadsheet->getActiveSheet()->toArray();
//$quartile="";
//$sjr=0.0;
//for ($i=0; $i <count($d) ; $i++) {
//    for ($j=0; $j < count($d[$i]); $j++) {
////         echo $i." -> ".$d[$i][$j]." "	;
//        if ($d[$i][$j]===$_SESSION['journal']) {
//            $quartile=$d[$i][7];
//        }
//        else
//            $quartile="not";
//    }
//}
//
//
//
//
//
//
//?>