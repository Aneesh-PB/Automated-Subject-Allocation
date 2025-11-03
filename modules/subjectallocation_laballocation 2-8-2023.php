<?php

include("config.php");
function display()
{
    global $conn;
    $itercount = 0;

    //global $itercount;
    //echo $itercount;
?>

    <h3>Iteration</h3>
    <table border="black" width=100% height=30%>
        <tr>

            <th>Priority</th>
            <th>Name</th>
            <th>Subject</th>
        </tr>

        <form action='subjectallocation_allocationpost.php' method='POST'>
            <?php
            //Display 

            $i = 1;

            $query = "select * from faculty order by priority";
            $resu = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($resu)) {
                $allocationcount = 0;

                $Fid = $row['Fid'];

                //echo $Fid;
                $theoryquery = "select * from faculty where Fid='$Fid'";
                $theoryres = mysqli_query($conn, $theoryquery);
                $theorycol = mysqli_fetch_array($theoryres);
                $theorynum = $theorycol['Lab'];
                //echo $theorynum;



                $allocatedquery = "select * from templaballocation where FacultyID='$Fid'";
                $allocatedres = mysqli_query($conn, $allocatedquery);
                $allocatedsub = mysqli_fetch_array($allocatedres);

                $alloccountquery = "select count(*) as count from templaballocation where FacultyID='$Fid'";
                $alloccountres = mysqli_query($conn, $alloccountquery);
                $alloccountcol = mysqli_fetch_array($alloccountres);
                $alloccount = $alloccountcol['count'];
                if (!$alloccount) {
                    $alloccount = 1;
                }



            ?>

                <tr>
                    <td rowspan="<?php echo $alloccount; ?>"><?php echo $row['Priority']; ?></td>
                    <td rowspan="<?php echo $alloccount; ?>"><?php echo $row['FName']; ?>
                        <?php if ($itercount > 4) { ?>
                            <input name="<?php echo $Fid; ?>" type='submit' value='Edit'>
                        <?php } ?>
                    </td>
                    <td><?php if ($allocatedsub) {
                            $allocatedsubcode = $allocatedsub['CourseID'];
                            $allocatedsubprogram = $allocatedsub['Program'];

                            $allocatedsubnamequery = "select * from subjects where CourseCode='$allocatedsubcode' and Program='$allocatedsubprogram'";

                            $allocatedsubnameres = mysqli_query($conn, $allocatedsubnamequery);
                            $allocatedsubnamecol = mysqli_fetch_array($allocatedsubnameres);
                            $allocatedsubname = $allocatedsubnamecol['CourseName'];
                            $allocatedsubsem = $allocatedsubnamecol['Semester'];
                            $allocatedsubprogram = $allocatedsubnamecol['Program'];
                            echo $allocatedsubcode . ' - ' . $allocatedsubname . ' - ' . $allocatedsubsem . ' - ' . $allocatedsubprogram;
                        } else {
                            echo "-";
                        } ?> </td>
                </tr>
                <script>
                    <?php
                    while ($allocatedsub = mysqli_fetch_array($allocatedres)) { ?>
                        document.write(`
             <tr>

             <td><?php if ($allocatedsub) {
                            $allocatedsubcode = $allocatedsub['CourseID'];
                            $allocatedsubprogram = $allocatedsub['Program'];
                            $allocatedsubnamequery = "select * from subjects where CourseCode='$allocatedsubcode' and Program='$allocatedsubprogram'";

                            $allocatedsubnameres = mysqli_query($conn, $allocatedsubnamequery);
                            $allocatedsubnamecol = mysqli_fetch_array($allocatedsubnameres);
                            $allocatedsubname = $allocatedsubnamecol['CourseName'];
                            $allocatedsubsem = $allocatedsubnamecol['Semester'];
                            $allocatedsubprogram = $allocatedsubnamecol['Program'];
                            echo $allocatedsubcode . ' - ' . $allocatedsubname . ' - ' . $allocatedsubsem . ' - ' . $allocatedsubprogram;
                        } else {
                            echo "-";
                        } ?>
          </td>
             </tr>`)

                    <?php } ?>
                </script>

            <?php }  ?>
        </form>

    </table>
    <br>
    <h3>Unallocated Subjects:</h3>
    <table border="black" width=100%>
        <tr>
            <th>S.No</th>
            <th>Sem</th>
            <th>Programme</th>
            <th>Course Code</th>
            <th>Course Name</th>
        </tr>

        <?php

        $unallocsubquery = "select * from subjects where (CourseCode,Program) not in (select CourseID,Program from templaballocation) and Type='LAB'and Semester in ('S1','S3','S5','S7','M1','M3')";
        $unallocsubres = mysqli_query($conn, $unallocsubquery);
        $unallocrows = mysqli_num_rows($unallocsubres)


        ?>


        <?php
        if ($unallocrows > 0) {
            while ($unallocsub = mysqli_fetch_array($unallocsubres)) {
        ?>
                <tr>
                    <td><?php echo $i;
                        $i++ ?></td>
                    <td><?php echo $unallocsub['Semester']; ?></td>
                    <td><?php echo $unallocsub['Program']; ?></td>
                    <td><?php echo $unallocsub['CourseCode']; ?></td>
                    <td><?php echo $unallocsub['CourseName']; ?></td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td style="text-align:center">-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        <?php } ?>
    </table>

<?php }




?>
<!DOCTYPE html>
<html>

<head>
    <title>Lab Allocation</title>
</head>

<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="wrapper-div">
        <div id="logo-div"></div>

        <div id="nav-div">
            <button onclick="document.location='adminhome.php'">Home</button>


            <div id="header-banner-div">Lab Allocation</div>

            <div id="main-div" class="clearfix">

                <div id="bodyarea-div">
                    <form action="" method="POST">
                        <input type="submit" value="submit" name="submit">

                    </form>



                    <?php
                    // First iteration




                    // $labnumquery="select * from faculty where Fid='$Fid'";
                    // $labnumres=mysqli_query($conn,$labquery);
                    // $labnumcol=mysqli_fetch_array($labres);
                    // $labnum=$labcol['Lab'];
                    //echo $labnum;
                    $year = 2023;

                    $labquery = "select * from labtheorymap order by No_of_faculty desc";
                    $labres = mysqli_query($conn, $labquery);
                    // $labcol=mysqli_fetch_array($labres);
                    // $lab=$labcol[''];
                    //echo $labnum;

                    $delquery = "delete from templaballocation";
                    $resu = mysqli_query($conn, $delquery);

                    while ($labrow = mysqli_fetch_array($labres)) {

                        $labcode = $labrow['LabCourseCode'];
                        $theorycode = $labrow['TheoryCourseCode'];
                        $labsem = $labrow['CourseSem'];
                        $labprogram = $labrow['Program'];

                        $theoryfacultyquery = "select * from tempallocation where CourseID='$theorycode' and Program='$labprogram'";
                        $theoryfacultyres = mysqli_query($conn, $theoryfacultyquery);
                        $theoryfaculty = mysqli_fetch_array($theoryfacultyres);
                        if (mysqli_num_rows($theoryfacultyres) > 0) {
                            //echo $theoryfaculty['FacultyID'];
                            $Fid = $theoryfaculty['FacultyID'];

                            $inquery = "insert into templaballocation (FacultyID,Incharge,CourseID,AllocationType,Semester,Program,Year) values('$Fid','Yes','$labcode','LAB','$labsem','$labprogram',2023)";
                            $inqueryres = mysqli_query($conn, $inquery);
                        }
                    }
                    $labquery = "select * from labtheorymap order by No_of_faculty desc";
                    $labres = mysqli_query($conn, $labquery);
                    $prevyear = $year - 1;

                    while ($labrow = mysqli_fetch_array($labres)) {

                        $labcode = $labrow['LabCourseCode'];
                        $theorycode = $labrow['TheoryCourseCode'];
                        $labsem = $labrow['CourseSem'];
                        $labprogram = $labrow['Program'];

                        $prevlabfacquery = "select * from laballocation where Year='$prevyear' and CourseID='$labcode' and FacultyID not in (select FacultyID from templaballocation)";
                        $prevlabfacres = mysqli_query($conn, $prevlabfacquery);
                        $prevlabfaculty = mysqli_fetch_array($prevlabfacres);
                        if (mysqli_num_rows($prevlabfacres) > 0) {
                            //echo $prevlabfaculty['FacultyID'];
                            $Fid = $prevlabfaculty['FacultyID'];

                            $inquery = "insert into templaballocation (FacultyID,Incharge,CourseID,AllocationType,Semester,Program,Year) values('$Fid','No','$labcode','LAB','$labsem','$labprogram',2023)";
                            $inqueryres = mysqli_query($conn, $inquery);
                        }
                    }

                    $labquery = "select * from labtheorymap order by No_of_faculty desc";
                    $labres = mysqli_query($conn, $labquery);
                    $prevyear = $year - 1;

                    while ($labrow = mysqli_fetch_array($labres)) {

                        $labcode = $labrow['LabCourseCode'];
                        $theorycode = $labrow['TheoryCourseCode'];
                        $labsem = $labrow['CourseSem'];
                        $labprogram = $labrow['Program'];
                        $labfacultycount = $labrow['No_of_faculty'];

                        $labcountquery = "select count(*) as count from templaballocation where CourseID='$labcode'";
                        $labcountres = mysqli_query($conn, $labcountquery);
                        $labcount = mysqli_fetch_array($labcountres);
                        //echo ' ' . $labcount['count'] . ' - ' . $labcode;
                        if ($labcount['count'] < $labfacultycount) {

                            $randfacultyquery = "select * from faculty where Fid not in (select FacultyID from templaballocation where CourseID='$labcode') order by rand()";
                            $randfacultyres = mysqli_query($conn, $randfacultyquery);



                            while ($randfacultyrow = mysqli_fetch_array($randfacultyres)) {
                                $labcountquery = "select count(*) as count from templaballocation where CourseID='$labcode'";
                                $labcountres = mysqli_query($conn, $labcountquery);
                                $labcount = mysqli_fetch_array($labcountres);

                                $randfacultylabcount = $randfacultyrow['Lab'];
                                $randfacultyid = $randfacultyrow['Fid'];
                                $randfacultycountquery = "select count(*) as count from templaballocation where FacultyID='$randfacultyid'";
                                $randfacultycountres = mysqli_query($conn, $randfacultycountquery);
                                $randfacultycount = mysqli_fetch_array($randfacultycountres);
                                $randfacultyallocatedlabcount = $randfacultycount['count'];

                                if ($randfacultyallocatedlabcount < $randfacultylabcount && $labcount['count'] < $labfacultycount) {

                                    $inquery = "insert into templaballocation (FacultyID,Incharge,CourseID,AllocationType,Semester,Program,Year) values('$randfacultyid','No','$labcode','LAB','$labsem','$labprogram',2023)";
                                    $inqueryres = mysqli_query($conn, $inquery);
                                }
                            }
                        }
                    }







                    display();

                    ?>


                </div>



            </div>

        </div>
        <div id="footer-div">Footer</div>
        </script>

</body>

</html>