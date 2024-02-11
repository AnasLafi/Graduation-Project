
<?php
session_start();
include "../controller/showData.php";
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>المؤلفين</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" dir="rtl" style="font-weight:Bold ;">
    <div class="container-fluid mx-0">
        <img src="../public/images/navbarlogo.png">
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

    <h4 class="text-center mt-5">معلومات اضافية </h4>
    <h5 class="text-center mt-5">المؤلفين  </h5>

    <!-- table -->
    <table class="table table-secondary mt-2 text-center" id="table">
        <thead >
        <tr>
            <th scope="col">الترتيب</th>
            <th scope="col">الرقم</th>
            <th scope="col">الاسم</th>
            <th scope="col"> الجامعة داخل او خارج الاردن</th>


        </tr>
        </thead>
        <tbody>
        <?php
         $view->selectAll($auth);
        ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>








