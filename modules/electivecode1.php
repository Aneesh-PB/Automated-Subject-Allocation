<?php
include("config.php");

$selectedProgram = '';
$selectedSemester = '';
$courses = array();
$selectedCourses = array();

if (isset($_POST['submit'])) {
    $selectedProgram = $_POST['Program'];
    $selectedSemester = $_POST['Semester'];

    // Fetch CourseTypeID from the Course table
    $courseQuery = mysqli_query($conn, "SELECT CourseTypeID FROM Course WHERE ProgrammeID = '$selectedProgram' AND CourseSem = '$selectedSemester';");

    while ($courseRow = mysqli_fetch_assoc($courseQuery)) {
        $selectedCourseTypeID = $courseRow['CourseTypeID'];

        // Fetch CourseTypeName from the CourseType table
        $courseTypeQuery = mysqli_query($conn, "SELECT CourseTypeName FROM CourseType WHERE CourseTypeID = '$selectedCourseTypeID';");
        while ($courseTypeRow = mysqli_fetch_assoc($courseTypeQuery)) {
            $selectedCourseTypeName = $courseTypeRow['CourseTypeName'];
            $courses[] = $selectedCourseTypeName;
        }
    }
}

// Process the final submit button
if (isset($_POST['submitElectiveData']) && isset($_POST['includeCheckbox'])) {
    $selectedElectiveData = $_POST['includeCheckbox'];

    // Ensure there are selected courses
    if (!empty($selectedElectiveData)) {
        foreach ($selectedElectiveData as $courseTypeID) {
            // Fetch data from the CourseType table
            $courseTypeQuery = mysqli_query($conn, "SELECT * FROM CourseType WHERE CourseTypeID = '$courseTypeID';");
            $courseTypeData = mysqli_fetch_assoc($courseTypeQuery);

            // Fetch data from the Course table
            $courseQuery = mysqli_query($conn, "SELECT * FROM Course WHERE CourseTypeID = '$courseTypeID';");
            $courseData = mysqli_fetch_assoc($courseQuery);

            // Insert data into the "elective" table
            $insertQuery = "INSERT INTO elective (ElectiveCourseID, CourseID, ProgrammeID, Description, EffectiveDate, Semester) VALUES ";
            $insertQuery .= "('{$courseTypeData['CourseTypeID']}', '{$courseData['CourseID']}', '$selectedProgram', '{$courseTypeData['Description']}', '{$courseTypeData['EffectiveDate']}', '$selectedSemester');";

            mysqli_query($conn, $insertQuery);
        }

        // Display a success message
        echo "<p>Selected courses have been inserted into the 'elective' table successfully!</p>";
    } else {
        // Display an error message if no courses were selected
        echo "<p>Error: No courses were selected to be inserted into the 'elective' table.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Layout 1</title>

    <style type="text/css">
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: Arial;
            font-size: 16px;
        }

        /* Add your CSS styles here */
        #main-div {
            width: 100%;
            margin-bottom: 10px;
        }

        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }

        #wrapper-div {
            width: 80%;
            margin: auto;
        }

        input[type=text] {
            width: 100%;
            padding: 16px 8px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type=submit] {
            background-color: #8ebf42;
            color: white;
            padding: 5px 20px;
            margin: 10px 0;
            border: none;
        }

        select {
            width: 80%;
            padding: 5px;
        }

        h1 {
            text-align: center;
            font-size: 18;
        }

        button:hover {
            opacity: 0.8;
        }

        .container {
            display: flex;
        }

        .column {
            flex: 1;
            padding: 20px;
        }
        .CourseCl tr th
        {
            text-align:left !important;
            padding:10px;
            background: #D3D3D3;
        }
        .CourseCl tr td
        {
            padding:10px;
            border-bottom:#d3d3d3 1px solid
        }
    </style>
</head>
<body>
<div id="wrapper-div">
    <div id="main-div" class="clearfix">
        <form action="" method="POST">
            <div class="container">
                <div class="column">
                    <label for="Program">Choose a Program:</label>
                    <select id="Program" name="Program">
                        <option value="">Select Program</option>
                        <?php
                        // Fetch programs from the "Programme" table
                        $programQuery = mysqli_query($conn, "SELECT ProgrammeId, ProgrammeName FROM Programme;");
                        while ($programRow = mysqli_fetch_assoc($programQuery)) {
                            $programId = $programRow['ProgrammeId'];
                            $programName = $programRow['ProgrammeName'];
                            $selected = ($selectedProgram === $programId) ? 'selected' : '';
                            echo "<option value='$programId' $selected>$programName</option>";
                            
                        }
                        ?>
                    </select>
                </div>
                <div class="column">
                    <label for="Semester">Choose Semester:</label>
                    <select id="Semester" name="Semester">
                        <option value="">Select Semester</option>
                        <option value="1" <?php if ($selectedSemester === '1') echo 'selected'; ?>>Semester 1</option>
                        <option value="2" <?php if ($selectedSemester === '2') echo 'selected'; ?>>Semester 2</option>
                        <option value="3" <?php if ($selectedSemester === '3') echo 'selected'; ?>>Semester 3</option>
                        <option value="4" <?php if ($selectedSemester === '4') echo 'selected'; ?>>Semester 4</option>
                        <option value="5" <?php if ($selectedSemester === '5') echo 'selected'; ?>>Semester 5</option>
                        <option value="6" <?php if ($selectedSemester === '6') echo 'selected'; ?>>Semester 6</option>
                    </select>
                </div>
            </div>
            <input type="submit" name="submit">
        </form>
        <div>
            <form action="" method="POST">
                <div class="container">
                    <div class="column">
                        <label for="Elective">Choose Elective:</label>
                        <select name="SelectedElective">
                            <?php
                            if (isset($courses)) {
                                foreach ($courses as $course) {
                                    echo "<option value='$course'>$course</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="submit" name="submitElective" value="Submit Elective">
            </form>
        </div>
        <div>
            <?php
            if (isset($_POST['submitElective']) && isset($_POST['SelectedElective'])) {
                $selectedElective = $_POST['SelectedElective'];

                // Fetch CourseName, CourseCode, and CourseTypeID from the Course table based on the selected Elective (CourseTypeName)
                $courseTypeQuery = mysqli_query($conn, "SELECT CourseTypeID FROM CourseType WHERE CourseTypeName = '$selectedElective';");
                if (mysqli_num_rows($courseTypeQuery) > 0) {
                    $courseTypeRow = mysqli_fetch_assoc($courseTypeQuery);
                    $selectedCourseTypeID = $courseTypeRow['CourseTypeID'];

                    $courseQuery = mysqli_query($conn, "SELECT CourseName, CourseCode FROM Course WHERE CourseTypeID = '$selectedCourseTypeID';");

                    echo '<form action="" method="POST">';
                    echo '<table width="80%" class="CourseCl"><tr><th>Sl No</th><th>Course Name</th><th>Course Code</th><th></th></tr>';
                    $count = 1;
                    while ($courseRow = mysqli_fetch_assoc($courseQuery)) {
                        $courseName = $courseRow['CourseName'];
                        $courseCode = $courseRow['CourseCode'];

                        // Display the fetched data along with the checkbox
                        echo '<tr>';
                        echo "<td>$count</td>";
                        echo "<td>$courseName</td>";
                        echo "<td>$courseCode</td>";
                        echo '<td><input type="checkbox" name="includeCheckbox[]" value="' . $selectedCourseTypeID . '"></td>';
                        echo '</tr>';
                        $count++;
                    }
                    echo '</table>';
                    echo '<input type="submit" name="submitElectiveData" value="Submit">';
                    echo '</form>';
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
