<?php
include "../model/Research.php";
include "../classView/adminView.php";
session_start();
$q = intval($_GET['q']);

if ($q==0)
    $res=Research::selectAll();
else
$res=Research::selectByID($q);
$view=new adminView();
$view->selectAll($res);
//echo count($res);
//for ($i=0;$i<count($res);$i++)
//{
//echo "<tr><td>". $res[$i]->getId()."</td>";
//echo "<td>". $res[$i]->getTittle()."</td></tr>";
//}