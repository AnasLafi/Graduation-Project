<?php
// session_start();
function fileDumpInForm($newName)
{

    $lines_array = file($newName);

//if (isset($_GET["file"])){

//}
    $author = array();
// $SSN=array();
    $SSN = "";
    $tittle = $year = $journal =$vl=$is=$ISSN= "";
    if (!empty($lines_array)) {
        foreach ($lines_array as $k => $v) {

            if (strpos($v, "A1") !== false) {
                list(, $aut) = explode("-", $v);
                // If you don't want the space before the word bong, uncomment the following line.
                array_push($author, trim($aut));
            }
            if (strpos($v, "T1") !== false) {
                list(, $tittle) = explode("-", $v,2);
                // If you don't want the space before the word bong, uncomment the following line.


            }
            if (strpos($v, "Y1") !== false) {
                list(, $year) = explode("-", $v);
                // If you don't want the space before the word bong, uncomment the following line.
                $year = trim($year);
            }
            if (strpos($v, "VL") !== false) {
                list(, $vl) = explode("-", $v);
                // If you don't want the space before the word bong, uncomment the following line.
                $vl = trim($vl);
            }
            if (strpos($v, "IS") !== false) {
                list(, $is) = explode("-", $v);
                // If you don't want the space before the word bong, uncomment the following line.
                $is = trim($is);
            }
            if (strpos($v, "JO") !== false) {
                list(, $journal) = explode("-", $v);
                // If you don't want the space before the word bong, uncomment the following line.
                $journal = trim($journal);
            }
//    if(strpos($v, "SN") !== false) {
//        list(, $SSn,$Ssn) = explode("-", $v);
//        // If you don't want the space before the word bong, uncomment the following line.
////        $SSn = trim($SSn);
////        $Ssn = trim($Ssn);
//        $SSN=trim($SSn)."-".trim($Ssn);
//    }
            if (strpos($v, "SN") !== false) {
                list(, $SSn) = explode("-", $v, 2);
                // If you don't want the space before the word bong, uncomment the following line.
//        $SSn = trim($SSn);
//        $Ssn = trim($Ssn);

                $SSN = trim($SSn);
                $explode = explode('-', $SSN);
                if (count($explode) == 1)
                    $ISSN = $explode[0];
                elseif (count($explode) == 2)
                    $ISSN = $explode[0] . $explode[1];
                else
                    $ISSN = "";
//        echo $ISSN;
                // $SSN[0]=trim($SSn);
                // $SSN[1]=trim($Ssn);
            }
        }
    }
    return array($author,$tittle,$year,$journal,$ISSN,$vl,$is);
}
//fileDumpInForm(88);
//print_r(fileDumpInForm("../public/uploads/88.ris"));
// SSN <input type="text" name="SSN" value="<?php echo $SSN;"> in form.php

// echo implode("-",$SSN);
// $x=str_split($SSN,4);
// print_r($x);
// echo "<br>";
// echo $x[0]."-".$x[1]."<br>";
// $_SESSION["author"]=$author; 
// $_SESSION["tittle"]=$tittle;
// $_SESSION["SSN"]=$SSN;
// $_SESSION["year"]=$year;
// $_SESSION["journal"]=$journal;



// echo $tittle."<br>";
// echo "ssn".$SSN."<br>";
// echo "ssn ".$SSN."<br>";
// echo $year."<br>";
// echo $journal."<br>";

?>