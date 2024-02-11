<?php

require_once '../sendEmail/emailSettings.php';
require_once '../model/Research.php';
require_once '../model/AmountDue.php';
require_once '../model/Ratings.php';

require_once '../model/login.php';
//echo $value->getAuthID();

$id = intval($_GET['id']);
$resID = intval($_GET['resID']);
$adminID=intval($_GET['adminID']);
//echo $id."<br>";
//echo $resID."<br>";

$user=User::select($id);
//echo $user->get_email()."<br>";

$amount=new AmountDue($resID);
$res=new Research($resID);
$rating=new Ratings($resID);
//echo $res->getAuthID();

$mail->setFrom("mutah.research@gmail.com", "Mutah University");
$mail->addAddress($user->get_email());
$mail->Subject = 'حوافز البحث العلمي';
$Clarivate="";
if ($rating->getClarivate()==1)
    $Clarivate="<td>Yes</td>";
else
    $Clarivate="<td>No</td>";
$mail->Body = '    <html>
        <head>
            <title>HTML email</title>
        </head>

        <body dir="rtl">
            <h1>حوافز البحث العلمي </h1>
            <p>لقد تم تقييم البحث المقدم من قبل السيد '.$res->getAuthName().'</p>
            <table border="1">
                <tr>
                <th>ID</th>
                    <th>رقم البحث</th>
                    <th>الاسم</th>
                    <th>المجلة </th>
                    <th>العنوان</th>
                    <th>ISSN</th>
                     <th> المبلغ الكامل</th>
                      <th> المبلغ المستحق</th>
                     <th>عدد المؤلفين</th>
                    <th>scopus</th>
                    <th>Clarivate</th>
                </tr>
                <tr>
                <td>'.$res->getAuthID().'</td>
                <td>'.$res->getId().'</td>
                <td>'.$res->getAuthName().'</td>
                    <td>'.$res->getJournal().'</td>
                    <td>'.$res->getTittle().'</td>
                    <td>'.$res->getISSN().'</td>
                    <td>'.$amount->getAmount().'</td>
                    <td>'.$amount->getAmountPerResearcher().'</td>
                    <td>'.$amount->getNumberOfAuthors().'</td>
                    <td>'.$rating->getScopus().'</td>
                    '.$Clarivate.'
                </tr>
            </table>
        </body>
    </html>';
$mail->addAttachment('../public/docsFiles/' . $id . '-'.$res->getId().'.docx');
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->send();
//$myRes=new Research($_GET['resID']);
//$myRes->updateStatus(3);
$res->updateStatus($resID,3);
echo '<script>location.replace("http://localhost/finalproject/view/admin.php?adminID='.$adminID.'");</script>';

//echo $res->getStatus()."<br>";
//echo 'Message has been sent'.$_GET['resID'];
