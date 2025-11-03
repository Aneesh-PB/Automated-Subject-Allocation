<?php
include('config.php');
//include('subjectallocation_theorylabform.php');
if (isset($_POST['submit'])) {
  $subcode = $_POST['code'];

  $labcoursequery = "select * from course where CourseType='LAB' and CourseSem in ('S1','S3','S5','S7','M1','M3') order by CourseSem";
  $resu = mysqli_query($conn, $labcoursequery);
  $i = 1;
  foreach ($subcode as $index => $courseid) {
    echo $courseid;



    $nooffaculty = $_POST[$i++];

    $row = mysqli_fetch_array($resu);
    $labcoursecode = $row['CourseCode'];
    $labcoursesem = $row['CourseSem'];
    $labcourseprogram = $row['Program'];
    $insertquery = "insert into labtheorymap (LabCourseCode,TheoryCourseCode,CourseSem,Program,No_of_faculty) values ('$labcoursecode','$courseid','$labcoursesem','$labcourseprogram','$nooffaculty')";
    $insertqueryres = mysqli_query($conn, $insertquery);
    //  

  }
  echo "<script>document.body.innerHTML='';</script>"; ?>
  <html>

  <head>
    <title>Lab-Theory Mapping</title>
  </head>

  <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
    <div id="wrapper-div">
      <div id="logo-div"></div>

      <div id="nav-div">
        <button onclick="document.location='adminhome.php'">Home</button>


        <div id="header-banner-div">Lab-Theory Mapping</div>

        <div id="main-div" class="clearfix">

          <div id="bodyarea-div\">
            <form action="" method="POST">



              <table border="black" width=100% height=30%>
                <tr>

                  <th>S.No</th>
                  <th>Lab Subject</th>
                  <th>Theory Subject</th>
                </tr>

                <?php

                //Display 

                $i = 1;

                $labcoursequery = "select t.TheoryCourseCode,course.CourseName as theory,c.Program,course.CourseSem,t.LabCourseCode,c.CourseName as lab from labtheorymap t inner join course on t.theoryCourseCode=course.CourseCode inner join course c on t.labcoursecode=c.CourseCode where t.CourseSem in ('S1','S3','S5','S7','M1','M3') and t.Program=c.Program and t.Program=course.Program order by t.CourseSem;";
                $resu = mysqli_query($conn, $labcoursequery);

                while ($row = mysqli_fetch_array($resu)) {
                  $allocationcount = 0;


                ?>

                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['LabCourseCode'] . ' - ' . $row['lab'] . ' - ' . $row['CourseSem'] . ' - ' . $row['Program']; ?></td>
                    <td><?php echo $row['TheoryCourseCode'] . ' - ' . $row['theory'] . ' - ' . $row['CourseSem'] . ' - ' . $row['Program']; ?></td>
                  </tr>
                <?php
                } ?>
              </table>

            </form>

          </div>

        </div>

      </div>
      <div id="footer-div">Footer</div>


  </body>

  </html>
<?php } ?>