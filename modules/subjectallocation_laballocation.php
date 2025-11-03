<?php

include('subjectallocation_laballocationfunctions.php');
firstiter();
function firstiter()
{
    global $conn; ?>
    <html>

    <head>
        <title>Lab Allocation</title>

        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <div id="wrapper-div">
            <div id="logo-div"></div>

            <div id="nav-div">
                <button onclick="document.location='adminhome.php'">Home</button>
                <div id="header-banner-div">Lab Allocation</div>
                <h3>Iteration 1</h3>

                <div id="main-div" class="clearfix">

                    <div id="bodyarea-div">
                        <form action="subjectallocation_laballocationpost.php" method="POST">
                            <input type="submit" value="Next" name="seconditer">

                        </form>
                        <?php
                        // First iteration

                        $year = 2023;

                        $labquery = "select * from labtheorymap order by No_of_faculty desc";
                        $labres = mysqli_query($conn, $labquery);


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

                        display();
                        ?>
                    </div>
                </div>

            </div>



    </body>

    </html>

<?php
}


?>