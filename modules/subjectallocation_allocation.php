<?php
include("allocation functions edit 05-07-2023.php");
include("allocation functions edit 05-07-2023 28-07-2023 6-17pm.php");

$_SESSION['itercount'] = 1;
?>
<html>

<head>
  <title>Subject Allocation</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div id="wrapper-div">
    <div id="logo-div"></div>

    <div id="nav-div">
      <button onclick="document.location='adminhome.php'">Home</button>
      <div id="header-banner-div">Subject Allocation</div>

      <div id="main-div" class="clearfix">

        <div id="bodyarea-div">
          <form action="subjectallocation_allocationpost.php" method="POST">
            <input type="submit" value="Next" name="seconditer">

          </form>

          <?php
          // First iteration

          $subcountquery = "select count(*) as count from subjects";
          $subcountres = mysqli_query($conn, $subcountquery);
          $subcountarray = mysqli_fetch_array($subcountres);
          $subcount = $subcountarray['count'];

          $selectedsubcountquery = "select count(distinct Course_code) as count from selected_subjects";
          $selectedsubcountres = mysqli_query($conn, $selectedsubcountquery);
          $selectedsubcountarray = mysqli_fetch_array($selectedsubcountres);
          $selectedsubcount = $selectedsubcountarray['count'];
          //echo $selectedsubcount;

          $delquery = "delete from tempallocation";
          $resu = mysqli_query($conn, $delquery);
          $query = "select * from faculty order by priority";
          $resu = mysqli_query($conn, $query);
          $i = 0;
          $j = 1000;

          $subarray = array();

          while ($row = mysqli_fetch_array($resu)) {
            $allocationcount = 0;
            ++$i;
            ++$j;
            $Fid = $row['Fid'];

            //echo $Fid;
            $theoryquery = "select * from faculty where Fid='$Fid'";
            $theoryres = mysqli_query($conn, $theoryquery);
            $theorycol = mysqli_fetch_array($theoryres);
            $theorynum = $theorycol['Theory'];
            //echo $theorynum;

            $subquery = "select * from selected_subjects where FID='$Fid' order by Pref";
            $subres = mysqli_query($conn, $subquery);


            while ($subcol = mysqli_fetch_array($subres)) {

              $sub = $subcol['Course_name'];
              $subid = $subcol['Course_code'];
              $subsem = $subcol['Semester'];
              $subprogram = $subcol['Program'];

              if (!(in_array(array($subid, $subprogram), $subarray)) && $allocationcount < 1) {
                //echo "1";
                array_push($subarray, array($subid, $subprogram));
                $inquery = "insert into tempallocation (FacultyID,CourseID,AllocationType,Semester,Program)
                 values('$Fid','$subid','Theory','$subsem','$subprogram')";
                $inqueryres = mysqli_query($conn, $inquery);
                $allocationcount++;
              }
            }
          }


          $_SESSION['subarray'] = $subarray;
          display();

          ?>


        </div>



      </div>

    </div>
    <div id="footer-div">Footer</div>
    </script>

</body>

</html>