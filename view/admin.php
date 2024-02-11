<?php
session_start();
include '../controller/showData.php';
session_unset();
$_SESSION['adminID']=$_GET['adminID'];
// print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Page</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" dir="rtl" style="font-weight:Bold ;">
    <div class="container-fluid mx-0">
      <img src="../public/images/navbarlogo.png ">
      <a class="navbar-brand" href="admin.php?adminID=<?php echo  $_SESSION['adminID'];?>">إدارة البحوث</a>
      <div class="">
        <a class="btn btn-dark" href="https://www.mutah.edu.jo/Home.aspx" target="_blank">موقع الجامعة</a>
      </div>
      <div>
        <a class="btn btn-dark" href="https://www.scopus.com" target="_blank">Scopus</a>
      </div>
      <div>
        <a class="btn btn-dark" href="https://pubmed.ncbi.nlm.nih.gov/" target="_blank">Pubmed</a>
      </div>
      <div class="">
        <a class="btn btn-dark" href="https://clarivate.com/" target="_blank">Clarivate</a>
      </div>
      <div class="align-content-end">
        <!-------
        <button class="btn btn-light" id="logout" style="font-weight:bold ;">تسجيل الخروج</button>
        ------->
        <a href="../controller/logout.php" class="btn btn-light" role="button">تسجيل الخروج</a>
      </div>
    </div>
  </nav>
  <!-- main -->
<div class="container" dir="rtl">
<h2 class="text-center mt-5">قائـــــمة الأبحــــاث </h2>
<div class="row mt-5">
    <div class="col-1">
        <br>
        <a href="../fileHandling/downloadScopusFile.php" class="btn btn-primary" role="button">scopus</a>
    </div>
<div class="col-2">
<form action="">
<div class="form-group text-right">
<label for="filterInput">الحالة :</label>
<select class="form-control form-control-sm"  name="users" onchange="showUser(this.value)">
    <option value="0">الكل</option>
    <option value="1" class="text-danger">لم يكتمل</option>
    <option value="2" class="text-primary">تم التقييم</option>
    <option value="3" class="text-success">تم الارسال</option>
</select>
</div>
</form>
</div>
<div class="col-3">
  <div class="form-group text-right">
    <label for="filterInput">البحث باستخدام رقم البحث :</label>
    <input type="text" class="form-control form-control-sm" id="filterInput" onkeyup="showResult(this.value) ">
    </div>
</div>

    <div class="col-3">
        <div class="form-group text-right">
            <label for="filterInput">البحث  باستخدام رقم الباحث  :</label>
            <input type="text" class="form-control form-control-sm" id="filterInput" onkeyup="showDateByAuthorID(this.value) ">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group text-right">
            <label for="filterInput">البحث باستخدام سنة النشر :</label>
<!--            <input type="text" class="form-control form-control-sm" id="filterInput" onkeyup="showDate(this.value) ">-->
            <select class="form-control form-control-sm"  name="years"  id="years" onchange="showDate(this.value)">
                <option value="0">الكل</option>
            </select>
        </div>
    </div>



</div>

<!-- table -->
<table class="table table-secondary mt-2 text-center" id="table">
<thead>
<tr>

<th scope="col">رقم البحث</th>
  <th scope="col">العنوان</th>
    <th scope="col">المجلة</th>
<!--  <th scope="col">عدد الباحثين</th>-->
    <th scope="col">الباحث</th>
  <th scope="col">رقم الباحث</th>
    <th scope="col">ISSN</th>
    <th scope="col">سنة النشر</th>
    <th scope="col"> scopus</th>
    <th scope="col"> Clarivate</th>
    <!--  <th scope="col">العدد</th>-->
<!--  <th scope="col">المجلد</th>-->
    <th scope="col">المبلغ الكامل </th>
    <th scope="col">المبلغ لكل فرد</th>

    <th scope="col">الحالة</th>

<!--  <th scope="col">إزالة البحث</th>-->
    <th scope="col">تعديل البحث</th>

</tr>
</thead>
<tbody id="txtHint" style="font-weight: bold;">
<?php
//echo count($res);
//if (!empty($res))
$user=User::select($_GET['adminID']);
$isFoundInTable=User::isFound($_GET['adminID']);
if($isFoundInTable){
if($user->get_role()==2)
$view->selectAll($res);
else
echo"<td colspan='13' style='color:red'><center>Error Admin ID not found</center></td>";

}
else
echo"<td colspan='13' style='color:red'><center>Error Admin ID not found</center></td>";

//$view->showMoreInfo($res);


//if (count($res)==0)
//    echo "";



?>

</tbody>
</table>

</div>
<!-- Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script>
    function showResult(str) {
        if (str.length==0) {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;

                }
            }
            xmlhttp.open("GET","../controller/showDataByResIDInAdminPage.php?q=0",true);
            xmlhttp.send();
        // window.location.reload();
        //     return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("txtHint").innerHTML = this.responseText;

            }
        }
        xmlhttp.open("GET","../controller/showDataByResIDInAdminPage.php?q="+str,true);
        xmlhttp.send();
    }
    function showDateByAuthorID(str) {
        if (str.length==0) {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;

                }
            }
            xmlhttp.open("GET","../controller/showDataByAuthorIDInAdminPage.php?q=0",true);
            xmlhttp.send();
            // window.location.reload();
            // return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("txtHint").innerHTML = this.responseText;

            }
        }
        xmlhttp.open("GET","../controller/showDataByAuthorIDInAdminPage.php?q="+str,true);
        xmlhttp.send();
    }
    function showDate(str) {
        if (str.length==0) {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;

                }
            }
            xmlhttp.open("GET","../controller/showDataByDateInAdminPage.php?q=0",true);
            xmlhttp.send();
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("txtHint").innerHTML = this.responseText;

            }
        }
        xmlhttp.open("GET","../controller/showDataByDateInAdminPage.php?q="+str,true);
        xmlhttp.send();
    }
    function showUser(str) {
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","../controller/showDataByStatusInAdminPage.php?q="+str,true);
            xmlhttp.send();
        }
    }

    function generateArrayOfYears()
    {
        // Get the select element
        var select = document.getElementById("years");

        // Get the current year
        var currentYear = new Date().getFullYear();

        // Generate a list of years starting from the current year and going back 10 years
        for (var i = 0; i <= 23; i++) {
            // Create a new option element
            var option = document.createElement("option");

            // Set the value and text of the option element to the current year
            option.value = currentYear - i;
            option.text = currentYear - i;

            // Add the option element to the select element
            select.add(option);
        }
    }
    generateArrayOfYears();

  function deleteRecord(event) {
    // Get the row that contains the button that was clicked
      var row = event.target.parentNode.parentNode;

    // Remove the row from the table
    row.parentNode.removeChild(row);
  }
</script>