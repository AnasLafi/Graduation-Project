<?php
include '../controller/insertFileInfoController.php';
// session_start();
//include '../fileHandling/file.php';
unset($_SESSION['adminID']);

$_SESSION['userid']=$_GET['userID'];
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
?>
<!doctype html>
<html lang="en" dir="rtl">
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="mulogo.ico"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>التـقـديم للأبــحاث - جامعة مؤته</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>



</head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-weight:Bold ;">
        <div class="container-fluid mx-0">
          <img src="../public/images/navbarlogo.png" class="">
          <a class="navbar-brand col-5" href="#">تــقديـم البحــث العــلــمــي</a>
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
              <a href="../view/userProfile.php?userID=<?php echo  $_GET['userID'];?>" class="btn btn-primary  ">الملف الشخصي</a>
            <a href="../controller/logout.php" class="btn btn-light" role="button">تسجيل الخروج</a>
          </div>
          

        </div>
      </nav>
      <!----------------Choose file code----------------->
      <form action=""  method="post" enctype="multipart/form-data">
        <div class="col-5 mx-5 py-5" style="background-color: #ffffff;">
          <label for="formFile" class="form-label mx-5 fw-bold">إضافة الملف الذي يحتوي على معلومات البحــث :</label>
          <div dir="ltr" class="input-group mx-5">
            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" aria-describedby="inputFile" aria-label="Upload">
<!--            <button class="btn btn-primary" type="button" name="submit">رفع الملف</button>-->
              <input type="submit" class="btn btn-primary" value="رفع الملف" name="submit">
          </div>
          
    <?php
    if (isset($_POST["submit"])) {
        include "../fileHandling/upload.php";


    }
    ?>
        </div>
      </form>
        <br>
      <!----------------Fill the form------------------->

        <form class="row g-3 col-8 mx-5 px-5" style="background-color: rgb(255, 255, 255);" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
          <h3>تفاصيل البحــث</h3>
          <div class="col-md-12">
            <label class="form-label">العنوان</label>
            <input type="text" class="form-control" name="tittle" required id="" value="<?php if(!empty($result[1]))echo $result[1]; else echo "";?>">
          </div>
          <div class="col-md-12">
            <label class="form-label">اسم المجلة</label>
            <input type="text" class="form-control" id="" name="journal" required value="<?php if(!empty($result[3]))echo $result[3]; else echo "";?>">
          </div>
          <!----------------------->
<?php
//$result[0] number of authors
//print_r($result[0]);
//echo count($result[0]);
if (empty($result[0])||count($result[0])==1)
{
    ?>
            <div class="col-10">
            <label class="form-label"><?php  echo "الباحث 1";?></label>
            <input type="text" class="form-control" id="inputAuthor" name='authors[]' value='<?php  if(!empty($result[0][0]))echo $result[0][0]; else echo "";  ?>' required>
            </div>
            <div class="col-md-2">
                <label class="form-label">الجامعة</label>
                <select class="form-select" name="jordanian[]" id="jordanian">
                    <option value="1">داخل الاردن</option>
                    <option value="1">جامعة مؤتة</option>
                    <option value="0">خارج الاردن</option>
                </select>
            </div>


<?php
            } elseif (count($result[0])>1){
    for ($i=0;$i<count($result[0]);$i++){
    ?>
          <div class="col-8">
            <label class="form-label"><?php  echo "الباحث ".($i+1);?></label>
            <input type="text" class="form-control" id="inputAuthor" name='authors[]' required value='<?php echo $result[0][$i];?>'>
          </div>
          <div class="col-md-2">
            <label class="form-label">الجامعة</label>
            <select class="form-select" name="jordanian[]" id="jordanian">

                <option value="1">داخل الاردن</option>
                <option value="1">جامعة مؤتة</option>
                <option value="0">خارج الاردن</option>

            </select>
          </div>
        <div class="col-2">
            <?php
            if ($i==0)
            echo '<label class="form-label"> من انت </label>';
            ?>

            <br>
            <input type='radio' class="form-check-input mt-3" style="margin-right: 7%;" name='ItsMe[]'  value='<?php echo $i;?>' <?php if ($i==0) echo "checked";?>>
        </div>


        <?php
    }
}
            ?>
          <!----------------------->
    <br>
          <div class="col-md-3">
            <label class="form-label">ISSN</label>
            <input type="text" class="form-control" id="" name="ISSN" required value="<?php
            if(!empty($result[4]))echo $result[4]; else echo "0";?>">
          </div>
          <div class="col-md-3">
            <label class="form-label">EISSN</label>
            <input type="text" class="form-control" id="" name="EISSN">
          </div>
          <div class="col-md-2">
            <label  class="form-label">سنة النشر</label>
            <input type="number" id="" class="form-control" name="year" required value="<?php if(!empty($result[2]))echo $result[2]; else echo "";?>">
          </div>
          <div class="col-md-2">
            <label class="form-label">المجلد</label>
            <input type="text" class="form-control" id="" name="VL" value="<?php
            if(!empty($result[4]))echo $result[5]; else echo "";?>">
          </div>
          <div class="col-md-2">
            <label class="form-label">العدد</label>
            <input type="text" class="form-control" id="" name="IS" value="<?php
            if(!empty($result[4]))echo $result[6]; else echo "";?>">
          </div>
          <div class="col-6 mx-2 p-4" style="font-weight:bold ; background-color: rgb(255, 255, 255);border-style: dotted; border-color: rgb(255, 255, 255);">
            <p>* اختيار نوع التقييم :</p>
         
              <input class="form-check-input m-2"  type="checkbox" role="switch" name='scopus' value='1' checked>
              <label class="form-check-label">Scopus</label><br>
              <input class="form-check-input m-2" type="checkbox" role="switch" name='pubmed' value='1'>
              <label class="form-check-label">Pubmed</label><br>
              <input class="form-check-input m-2" type="checkbox" role="switch" name='clarivate' value='1'>
              <label class="form-check-label">Clarivate</label>
          </div>
          <div class="col-5 mx-2 p-4" style="font-weight:bold ; background-color: rgb(255, 255, 255);border-style: dotted; border-color: rgb(255, 255, 255);">
            <p>*هل تريد التقديم بإسم جامعة مؤته؟ </p>
              <input type="radio" name="multi" value="0" checked  onclick="myFunction()">
              <label>نعم</label>
              <input type="radio" name="multi" value="1" id="myCheck" onclick="myFunction()">
              <label>لا</label><br>
            <input style="display:none" class="form-control my-2" type="text" name="uniName" id="text" placeholder="اكتب اسم الجامعة" >
          </div>
          <center>
            <div class="col-12">
              <button type="submit" name="sub" class="btn btn-primary ">رفع المعلومات</button>
            </div>
          </center>
          
                    <!--Java Script-->
            <?php

            if (isset($_SESSION['warning'])) {
//                $_SESSION['userid']=$_GET['userID'];

                echo '<div class="warning-card" style=" border: 1px solid red;background-color: #ffcccc;padding: 10px;">
    <p id="warning"><center>' . $_SESSION['warning'] . ' (' . $_SESSION['userid']. ')</center></p></div>';
            }?>
        </form>


<footer class="bd-footer py-4 py-md-5 mt-5 bg-dark ">
  <div class="container py-4 py-md-5  px-md-3 ">
    <div class="row" style="color: #ffff;">
      <div class="col">
        <p class="small mb-0">جميع الحقوق محفوظة لجامعة مؤتة  &copy; <span id="year"></span></p>

    </div>
    <div class="col">
        <p id="date"></p>

    </div>
    <div class="col">
        <p id="clock" ></p>
  </div>

  </div>
    </div>

</footer>


      
      


    
 <!--------------------------------------------------------------End--------------------------------------------------------------------->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
 <script>





        function showDate() {
         var currentDate = new Date();
         var year = currentDate.getFullYear();
         var month = currentDate.getMonth() + 1; // January is 0, so add 1 to the month
         var day = currentDate.getDate();

         // Add a leading zero to the month and day if they are single digits
         if (month < 10) {
             month = "0" + month;
         }
         if (day < 10) {
             day = "0" + day;
         }

         // Concatenate the year, month, and day into a single string
         var dateString = year + "-" + month + "-" + day;

         // Update the date on the webpage
         document.getElementById("date").innerHTML = dateString;
     }

     // Call the showDate function
     showDate();
        function showYear()
        {
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            document.getElementById("year").innerHTML = year;
        }
        showYear();
        function showTime() {
            var d = new Date();

            var options = {
                timeZone: "Asia/kuwait",
                hour: "numeric",
                minute: "numeric",
                second: "numeric"
            };

            var timeString = new Intl.DateTimeFormat("en-US", options).format(d);

            document.getElementById("clock").textContent = timeString;
        }

        // Update the time every second
        setInterval(showTime, 1000);
        showTime();
     function myFunction() {
          // Get the checkbox
          var checkBox = document.getElementById("myCheck");
          // Get the output text
          var text = document.getElementById("text");
 
          // If the checkbox is checked, display the output text
          if (checkBox.checked == true){
              text.style.display = "block";
          } else {
              text.style.display = "none";
          }
      }
 </script>
</body>
</html>