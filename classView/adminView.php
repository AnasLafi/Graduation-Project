<?php
include "../model/AmountDue.php";
include "../model/Ratings.php";
include "../model/authors.php";
include "../controller/wordFile.php";
//session_start();
//$_SESSION['adminID']=$_GET['adminID'];
//print_r($_SESSION);
class adminView
{
    function showAuthors($res){
        $auth = Authors::selectByResID($res->getID());
//            echo $res->getID();
        $view=new userView();
        if (count($auth)==1){
            $a=new Authors(0);
            $a->selectByAuthIDAndResID( $res->getAuthID(),$res->getID());


            echo "<tr>";
            echo "<td>" . $a->getAuthorsRanking() . "</td>";
            echo"<th scope='row'> ".$a->getID()."</th>";

            echo "<td>" . $a->getAuthName() . "</td>";

            if($a->getJordanian() )
                echo "<td >داخل الأردن</td>";
            else
                echo "<td class='text-danger'>خارج الأردن</td>";
            echo "</tr>";

        }
        else
            $view->selectAll($auth);
}
    function showMoreInfo($res){
//        echo"<td>".$res->getIS()."</td>";
//        echo"<td>".$res->getVL()."</td>";
        $rating=Ratings::selectByResID($res->getID());
        foreach ($rating as $k => $val) {
            if ($rating[$k]->getScopus() == '-')
                echo "<td>لم يصنف</td>";
            else
                echo "<td>". $rating[$k]->getScopus()."</td>";
            if ($rating[$k]->getClarivate() == 1)
                echo "<td>مصنف</td>";
            else
                echo "<td> لم يصنف</td>";
            if ($rating[$k]->getPubmed() == 1)
                echo "<td>مصنف</td>";
            else
                echo "<td> لم يصنف</td>";



        }
        $amount=AmountDue::selectByResID($res->getID());
        foreach ($amount as $k => $val) {
            echo"<td>"."<a href='../view/allUsers.php?id=".$res->getID()."'>".$amount[$k]->getNumberOfAuthors()."</a><br>"."</td>";
//                echo "<td>".$amount[$k]->getNumberOfAuthors()."</td>";
            echo "<td>".$amount[$k]->getAmount()."</td>";
            echo "<td>".$amount[$k]->getAmountPerResearcher()."</td>";

        }
//        if ($rating[$k]->getForeignResearcher() == 1)
//            echo"<td>خارج الأردن </td>";
//        else
//            echo"<td>داخل الأردن</td>";
        if ($rating[$k]->getMultipleUniversities() == 1)
            if (!empty($rating[$k]->getUniversityName()))
            echo"<td>".$rating[$k]->getUniversityName()." </td>";
        else
            echo"<td>جامعة أخرى </td>";

        else
            echo"<td>جامعة مؤتة </td>";



    }

    function updateRating($res){
//        echo"<td>".$res->getIS()."</td>";
//        echo"<td>".$res->getVL()."</td>";

        echo '<form method="post" action="">';

        $rating=Ratings::selectByResID($res->getID());
        foreach ($rating as $k => $val) {
            echo '<td><select class="form-control form-control-sm"  name="scopus">';
            if ($rating[$k]->getScopus() == '-')
                echo '<option value="-">لم يصنف</option>';
            echo '<option value="Q1">Q1</option>';
            echo '<option value="Q2">Q2</option>';
            echo '<option value="Q3">Q3</option>';
            echo '<option value="Q4">Q4</option>';

//                echo "<td>". $rating[$k]->getScopus()."</td>";
            echo '</select></td>';
            echo '<td><select class="form-control form-control-sm"  name="clarivate">';

            if ($rating[$k]->getClarivate() == 0)
                echo '<option value="0">لم يصنف</option>';

                echo '<option value="1">مصنف</option>';
            echo '</select></td>';

            echo '<td><select class="form-control form-control-sm"  name="pubmed">';

            if ($rating[$k]->getPubmed() == 0)
                echo '<option value="0">لم يصنف</option>';

            echo '<option value="1">مصنف</option>';
            echo '</select></td>';


        }
        $amount=AmountDue::selectByResID($res->getID());
        foreach ($amount as $k => $val) {
            echo"<td>"."<a href='../view/allUsers.php?id=".$res->getID()."'>".$amount[$k]->getNumberOfAuthors()."</a><br>"."</td>";
//                echo "<td>".$amount[$k]->getNumberOfAuthors()."</td>";
//            echo "<td>".$amount[$k]->getAmount()."</td>";

            echo '<td><input type="text" name="amount" value="'.$amount[$k]->getAmount().'"></td>';
//            echo "<td>".$amount[$k]->getAmountPerResearcher()."</td>";
//            echo '<td><input type="text" name="amountPer" value="'.$amount[$k]->getAmountPerResearcher().'"></td>';


        }
        if ($rating[$k]->getForeignResearcher() == 1)
            echo"<td>خارج الأردن </td>";
        else
            echo"<td>داخل الأردن</td>";
        if ($rating[$k]->getMultipleUniversities() == 1)
            echo"<td>".$rating[$k]->getUniversityName()." </td>";
        else
            echo"<td>بأسم جامعة مؤتة </td>";
        echo' <td><input type="submit" name="evaluate" class="btn btn-danger" value="تقييم" "></td>';
        echo '</form>';
        if (isset($_POST['evaluate'])) {
//            include "../controller/updateResearchFromAdminPage.php";
//            echo $_POST['scopus']."<br>";
//            echo $_POST['clarivate']."<br>";
//            echo $_POST['pubmed']."<br>";
//            echo $_POST['amount']."<br>";
//            echo $_POST['amountPer']."<br>";
//            echo $amountPer;

//            echo ;
            $amountPer= $_POST['amount']/$amount[$k]->getNumberOfAuthors();
            $updateResRating=new Ratings($res->getID());
            $updateResRating->update($_POST['scopus'],$_POST['clarivate'],$_POST['pubmed']);
            $Amount=new AmountDue($res->getID());
            $Amount->update($_POST['amount'],$amountPer);
            $res->updateStatus($res->getID(),2);
            GenerateWordFile($res->getAuthID(),$res->getId());
            header("Location: admin.php?adminID=".$_SESSION['adminID']);
        }

    }
    function selectAll($res){



        foreach($res as $key => $value)
        {
                echo "<tr>";


//            echo $key."<br>";

//            print_r($rating);
//        echo"<th scope='row'>".$value->getID()."</th>";
                echo"<td>"."<a href='../view/showMoreInfo.php?id=".$value->getID()."&addition=1'>".$value->getID()."</a><br>"."</td>";
                echo"<td>".$value->getTittle()."</td>";
            echo"<td>".$value->getJournal()."</td>";

//        echo"<td>"."<a href='../view/allUsers.php?id=".$res[$i]->getID()."'>".count($auth)."</a><br>"."</td>";

                echo"<td>".$value->getAuthName()."</td>";
                echo"<td>".$value->getAuthID()."</td>";
                echo"<td>".$value->getISSN()."</td>";
                echo"<td>".$value->getPublicationDate()."</td>";
//                echo"<td>".$value->getIS()."</td>";
//                echo"<td>".$value->getVL()."</td>";

            $rating=Ratings::selectByResID($value->getID());
            foreach ($rating as $k => $val) {

                if ($rating[$k]->getScopus() == '-')
                    echo "<td>لم يصنف</td>";
                else
                    echo "<td>". $rating[$k]->getScopus()."</td>";
                if ($rating[$k]->getClarivate() == 1)
                    echo "<td>مصنف</td>";
                else
                    echo "<td> لم يصنف</td>";
//                if ($rating[$k]->getPubmed() == 1)
//                    echo "<td>مصنف</td>";
//                else
//                    echo "<td> لم يصنف</td>";

            }
            $amount=AmountDue::selectByResID($value->getID());
            foreach ($amount as $k => $val) {
//            echo "<td>".$amount[$k]->getNumberOfAuthors()."</td>";
                echo "<td>".$amount[$k]->getAmount()."</td>";
                echo "<td>".$amount[$k]->getAmountPerResearcher()."</td>";

            }

//            $result=Authors::selectByResID($value->getID());
//            echo "<td>".count($result)."</td>";



                if ($value->getStatus() == 1 ||$value->getStatus() == 0 )
                    echo "<td class='text-danger'> لم يكتمل</td>";
                elseif ($value->getStatus() == 2)
                    echo "<td class='text-primary'>تم التقييم</td>";
                else
                    echo "<td class='text-success'>تم الارسال</td>";


           //delete each research from db
//            echo '<td><a href="../controller/DeleteResearchFromAdminPage.php?resID='.$value->getID().'&id='.$value->getAuthID().'&adminID='.$_SESSION['adminID'].'" class="btn btn-danger" role="button">حذف </a></td>';




                if ($value->getStatus() == 1||$value->getStatus() == 0) {

                    echo '<td><a href="../view/manualRating.php?id='.$value->getID().'&addition=1" class="btn btn-danger" role="button">تقييم </a></td>';
//                    echo '<form method="get" action="">
//<td><input type="hidden" class="btn btn-danger" name="resID" value="' . $value->getID() . '" onclick="" />
//<input type="submit" name="update" class="btn btn-danger" value="تعديل" id="update" onclick="updateRes(this.value)">
//
//</form> </td>';
//                    if (isset($_GET['update'])) {
//                        include "../controller/updateResearchFromAdminPage.php";
//
//                    }
                }
            elseif($value->getStatus() == 2){
                echo '<td><a href="../controller/sendEmailWhenResearchHasBeenEvaluated.php?resID='.$value->getID().'&id='.$value->getAuthID().'&adminID='.$_SESSION['adminID'].'" class="btn btn-primary" role="button">ارسال</a></td>';
//                echo '<form method="get" action="">
//                <td>
//                <input type="hidden" class="btn btn-danger" name="resID" value="' . $value->getID() . '" onclick="" />
//                <input type="hidden" class="btn btn-danger" name="ID" value="' . $value->getAuthID() . '" onclick="" />
//                <input type="submit" name="sendEmail" class="btn btn-primary" value="ارسال">
//                </form>
//                </td>';
//                if (isset($_GET['sendEmail'])) {
//                    include "../controller/sendEmailWhenResearchHasBeenEvaluated.php";
////                            echo $key."<br>";
//
//                }

            }
                elseif($value->getStatus() == 3){
//                        echo '<td><a href="../view/showMoreInfo.php?id='.$value->getID().'&addition=1" class="btn btn-success" role="button">'.$value->getID().'</a></td>';
                    echo '<td><a href="../view/showMoreInfo.php?id='.$value->getID().'&addition=1" class="btn btn-success" role="button">عرض</a></td>';


                }
        echo"</tr>";
        }
        echo "<tr ><td colspan='13'><center>total of research <b>".count((array)$res)."</b></center></td></tr>";


//            for ($i=0; $i <count($res) ; $i++) {
////        $auth=Authors::selectByResID($res[$i]->getID());
//
//        echo "<tr>";
//        echo"<th scope='row'>".$res[$i]->getID()."</th>";
//        echo"<td>".$res[$i]->getTittle()."</td>";
////        echo"<td>"."<a href='../view/allUsers.php?id=".$res[$i]->getID()."'>".count($auth)."</a><br>"."</td>";
//                echo"<td>".$res[$i]->getAuthName()."(".$res[$i]->getAuthID().")"."</td>";
//                echo"<td>".$res[$i]->getISSN()."</td>";
//       echo"<td>".$res[$i]->getEISSN()."</td>";
//        echo"<td>".$res[$i]->getPublicationDate()."</td>";
//        echo"<td>".$res[$i]->getIS()."</td>";
//        echo"<td>".$res[$i]->getVL()."</td>";
//                if ($res[$i]->getStatus()==2)
//                    echo"<td>اكتمل</td>";
//                else
//                    echo"<td> لم يكتمل</td>";
////        echo "<td><button type='submit' class='btn btn-ligh' name='update'>".$res[$i]->getID()."</button></td>";
//                echo '<input type="hidden" name="id" id="ID" value="'.$res[$i]->getID().'">';
////                echo '<td>  <input type="submit"  id="submit" name="delete" class="btn-sm btn-danger" value="delete" onclick="deleteRecord(event)" ></td>';
//                echo '<form method="get" action="">
//<td><input type="hidden" class="btn btn-danger" name="resID" value="'.$res[$i]->getID().'" onclick="deleteRecord(event)" />
//<input type="submit" name="submit" class="btn btn-danger">
//</form> </td>';
//                if (isset($_GET['submit'])){
//                    include "../controller/DeleteResearchFromAdminPage.php";
//
//
//                }
//        echo"</tr>";
//
////                echo "<td><button type='mit' class='btn btn-ligh' name='update'>"."<a href='userView.php?id=".$res[$i]->getID()."&single=0' id='link'>".$res[$i]->getID()."</a><br>"."</button></td>";        echo"</tr>";
//
//
//    }
////     echo "<tr ><td colspan='10'><center>total of research <b>".count($res)."</b></center></td></tr>";

    }
}
?>