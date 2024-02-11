<?php

class userView
{
    public function selectByID($auth)
    {
        $res=new Research($auth->getResID());
        $amount=AmountDue::selectByResID($res->getID());
        echo "<tr>";
        echo"<td scope='row'>".$auth->getID()."</td>";
        echo"<th >".$auth->getAuthorsRanking()."</th>";
        echo"<td>".$auth->getAuthName()."</td>";
        echo"<td>".$auth->getResID()."</td>";
        $jo = $auth->getJordanian() ? 'أردني' : 'غير أردني';

        echo"<td>".$jo."</td>";
        foreach ($amount as $k => $val) {
//            echo "<td>".$amount[$k]->getNumberOfAuthors()."</td>";
            echo "<td>".$amount[$k]->getAmount()."</td>";
            echo "<td>".$amount[$k]->getAmountPerResearcher()."</td>";

        }
        if ($res->getStatus() == 1 ||$res->getStatus() == 0 )
            echo "<td> لم يكتمل</td>";
        elseif ($res->getStatus() == 2)
            echo "<td>تم التقييم</td>";
        else
            echo "<td> تم الارسال</td>";
        echo"</tr>";
    }
    public function selectALl($auth){

        for ($i = 0; $i < count($auth); $i++) {

//        $res=new Research($auth[$i]->getResID());
                $res = new Research($_GET['id']);
                //        echo $auth[$i]->getAuthName() . "<br>";
                echo "<tr>";
//        echo "<td>" . $res->getId() . "</td>";
            echo "<td>" . $auth[$i][3] . "</td>"; //rank
                echo "<th scope='row'> " . $auth[$i][0] . "</th>";//Author ID
            echo "<td>" . $auth[$i][1] . "</td>";//name

            //    echo "<a href='userController.php?id=".$result[$i]->getResID()."'>".$result[$i]->getAuthorsRanking().":".$result[$i]->getResID()." : ".$result[$i]->getAuthName()."</a><br>";
//                echo "<td>" . $auth[$i][2] . "</td>";//res ID
//
//            echo "<td>" . $auth[$i]->getResID() . "</td>";
                if ($auth[$i][4])//jordanian
                    echo "<td >داخل الأردن</td>";
                else
                    echo "<td class='text-danger'>خارج الأردن</td>";

//        $completed = $res->getCompleted() ? 'yes' : 'no';
//            echo "<td class='text-primary'>" . $jo . "</td>";
//        echo "<td>" . $res->getTittle() . "</td>";
//            echo "<td>" . $res->getJournal() . "</td>";
//            echo "<td>" . $res->getISSN() . "</td>";
//            echo "<td>" . $res->getEISSN() . "</td>";
//            echo "<td>" . $res->getPublicationDate() . "</td>";
//            echo "<td>" . $res->getIS() . "</td>";
//            echo "<td>" . $res->getVL() . "</td>";
//            echo "<td><center>" . $res->getStatus() . "</center> </td>";
                echo "</tr>";

        }

//    echo "<tr ><td colspan='8'><center>total of research <b>".count($auth)."</b></center></td></tr>";
        echo "<tr ><td colspan='12'><center>عدد المؤلفين <b>" . count($auth). "</b> للبحث رقم <b>".$auth[0][2]."</b></center></td></tr>";
    }



    function selectAllResearchForUserProfile($res){
//        echo"Author ID ".$res[0]->getAuthID();



        if (count($res)!=0){
//            $Auth = Authors::selectByResID(775);
//            print_r($Auth);
            foreach($res as $key => $value)
             {

                 $auth = Authors::selectByResID($value->getID());

                 echo '<div class="card" >
                    <div class="card-body">';

                 echo '<h5 class="card-title ">بحث '. ($key+1).' <br> </h5>';
                 echo '<h6 class="text-left"><b>Title :</b>'.$value->getTittle().' ('.$value->getPublicationDate().')</h6>';
                 echo '<h6 class="text-left"><b>Journal : </b>'.$value->getJournal().'</h6>';
                 $rating=Ratings::selectByResID($value->getID());
                 foreach ($rating as $x => $y) {
//                     echo $amount[$k]->getNumberOfAuthors();
                     if ($rating[$x]->getScopus()==='-')
                         echo '<h6 dir="rtl"><b>تصنيف Scopus : </b> غير مصنف </h6>';
                         else
                     echo '<h6 dir="rtl"><b>تصنيف Scopus : </b> <span dir="rtl">'.$rating[$x]->getScopus().'</span></h6>';
                     if ($rating[$x]->getClarivate()==1)
                         echo '<h6 dir="rtl"><b>تصنيف Clarivate : </b> مصنف</h6>';
                     else
                         echo '<h6 dir="rtl"><b>تصنيف Clarivate : </b>غير مصنف</h6>';
                 }
                    //اسم الباحث
//                    echo '<h6 style="text-align: center"><b>اسم الباحث :</b></h6>';
//                    echo '<h6 style="text-align: center">'.$value->getAuthName().'</h6>';

                 echo'<table class="table-responsive table bg-light">
                        
                            <thead class="thead-dark">
                            <tr>
                            <tr>
                                <th>رقم البحث</th>
                                <th>عدد المؤلفين</th>
                                <th>ترتيب المؤلف</th>
                                ';
                        if (count($auth)==1)
                            echo '<th>المبلغ المستحق</th>';
                        else {
                            echo '<th>المبلغ الكلي</th>';
                            echo '<th>المبلغ المستحق</th>';
                        }

                 echo ' 
                        
                         <th>حالة الطلب</th>                               
                         </tr>
                        </thead>';
                 echo '<tbody>';
                 echo "<tr>";

                 echo"<td>".$value->getID()."</td>";
//                 echo"<td>"."<a href='../view/updateResearch.php?resID=".$value->getID()."'>".$value->getID()."</a><br>"."</td>";
                 echo "<td>".count($auth)."</td>";

//                     echo "<td>".$auth[$key][3]."</td>";
//                echo "<pre>";
//                print_r($auth);
//                echo "</pre>";
                    if (count($auth)!=1) {
                        for ($i=0;$i<count($auth);$i++){
                        if ($auth[$i][0] == $value->getAuthID()) {
//                            echo $auth[$i][0] ." == ". $value->getAuthID();
                            //ترتيب المؤلف
                            echo "<td>" . $auth[$i][3] . "</td>";
                        }

                        }

                    }
                     else
                         echo "<td>1</td>";


//            echo"<td>".$value->getAuthName()."</td>";

                 //getAuthorsRanking

//                 $a=new Authors(0);
//                 $a->selectByAuthIDAndResID( $value->getAuthID(),$value->getID());
//                 echo "<td>" . $a->getAuthorsRanking() . "</td>";

                 $amount=AmountDue::selectByResID($value->getID());
                if (count($auth)==1)
                    echo "<td>".$amount[0]->getAmountPerResearcher()."</td>";
                    else {
                        foreach ($amount as $k => $val) {
//                     echo $amount[$k]->getNumberOfAuthors();
                            echo "<td>" . $amount[$k]->getAmount() . "</td>";
                            echo "<td>" . $amount[$k]->getAmountPerResearcher() . "</td>";
                        }
                    }

                 if ($value->getStatus() == 1 ||$value->getStatus() == 0 )
                     echo "<td class='text-danger'> لم يكتمل</td>";
                 elseif ($value->getStatus() == 2)
                     echo "<td class='text-primary'>تم التقييم</td>";
                 else
                     echo "<td class='text-success'>تم الارسال</td>";

                 echo"</tr>";

                 echo '</tbody>';

                 echo '</table>';

                if ($value->getStatus() == 1 ||$value->getStatus() == 0 ||$value->getStatus() == 2)
                    echo '<div class="text-center"><a href="../controller/DeleteResearchFromUserProfile.php?resID='.$value->getID().'&id='.$value->getAuthID().'" class="btn btn-danger " role="button">إلغاء الطلب </a></div>';
                    echo "<br>";
                echo '<div class="text-center"><a href="../fileHandling/downloadWordFileForEachResearch.php?id='.$value->getAuthID().'&resID='.$value->getID().'" class="btn btn-info " role="button">تحميل ملف word </a></div>';

                echo'</div>
                </div>';

                 /*
                    echo "<tr>";
                 $a=new Authors(0);
                 $a->selectByAuthIDAndResID( $value->getAuthID(),$value->getID());

                 //getAuthorsRanking
                    echo "</tr>";



                 echo '</tbody>';
                 echo '<thead class="thead-dark">';
                 echo "<tr>";
                 echo "<th>ترتيب الباحث</th>";
                 echo "</tr>";
                 echo "</thead>";
                 echo '<tbody>';
                 echo "<tr>";
                 echo "<td>" . $a->getAuthorsRanking() . "</td>";
                 echo "</tr>";
                 echo '</tbody>';*/


//        echo"<th scope='row'>".$value->getID()."</th>";


                 //            $auth=Authors::selectByAuthIDAndResID($value->getAuthID(),$value->getID());
//            foreach ($auth as $k => $val) {
//                echo "<td>".$auth[$k]->getAuthorsRanking()."</td>";
//                echo "<td>".$auth[$k]->getResID()."</td>";
//            }



             }
//             echo "<center>عدد الابحاث <b>".count((array)$res)."</b></center>";
             echo '<div class="justify-content-between align-items-center text-center mt-4"><h4>عدد الابحاث <b>'.count((array)$res).'</b></h4></div><br>';
         }
         else
         {
            echo '<div class="justify-content-between align-items-center text-center mt-4"><h2>لم يتم إضافة ابحاث</h2></div><br>';
         }




    }
}