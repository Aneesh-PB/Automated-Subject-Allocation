<?php
// Connect to the database (Replace 'your_database_name', 'your_username', and 'your_password' with appropriate values)
include('config.php');
session_start();
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Query the database to retrieve program names from the Program table
$programQuery = "SELECT ProgramID FROM Program";
$programResult = mysqli_query($conn, $programQuery);

$programOptions = '';

if (mysqli_num_rows($programResult) > 0) {
    // Generate the program options for the dropdown
    while ($row = mysqli_fetch_assoc($programResult)) {
        $programID = $row['ProgramID'];
        $selected = isset($_POST['programSelect']) && $_POST['programSelect'] == $programID ? "selected" : "";
        $programOptions .= "<option value='$programID' $selected>$programID</option>";
    }
}
// Query the database to retrieve semester values from the subjects table
$semesterQuery = "SELECT DISTINCT semester FROM subjects ORDER BY
    CASE
      WHEN semester = 'S1' THEN 1
      WHEN semester = 'S2' THEN 2
      WHEN semester = 'S3' THEN 3
      WHEN semester = 'S4' THEN 4
      WHEN semester = 'S5' THEN 5
      WHEN semester = 'S6' THEN 6
      WHEN semester = 'S7' THEN 7
      WHEN semester = 'S8' THEN 8
      WHEN semester = 'M1' THEN 9
      WHEN semester = 'M2' THEN 10
      WHEN semester = 'M3' THEN 11
      WHEN semester = 'M4' THEN 12
    END";
$semesterResult = mysqli_query($conn, $semesterQuery);

$semesterOptions = '';

if (mysqli_num_rows($semesterResult) > 0) {
    // Generate the semester options for the dropdown
    while ($row = mysqli_fetch_assoc($semesterResult)) {
        $semesterValue = $row['semester'];
        $selected = isset($_POST['semesterSelect']) && $_POST['semesterSelect'] == $semesterValue ? "selected" : "";
        $semesterOptions .= "<option value='$semesterValue' $selected>$semesterValue</option>";
    }
}
// Query the database to retrieve course types from the subjects table
$courseTypeQuery = "SELECT DISTINCT type FROM subjects";
$courseTypeResult = mysqli_query($conn, $courseTypeQuery);

$courseTypeOptions = '';

if (mysqli_num_rows($courseTypeResult) > 0) {
    // Generate the course type options for the dropdown
    while ($row = mysqli_fetch_assoc($courseTypeResult)) {
        $courseType = $row['type'];
        $selected = isset($_POST['courseTypeSelect']) && $_POST['courseTypeSelect'] == $courseType ? "selected" : "";
        $courseTypeOptions .= "<option value='$courseType' $selected>$courseType</option>";
    }
}

// Query the database to retrieve faculty names from the Faculty table
$facultyQuery = "SELECT FName FROM Faculty";
$facultyResult = mysqli_query($conn, $facultyQuery);

$facultyOptions = '';

if (mysqli_num_rows($facultyResult) > 0) {
    // Generate the faculty options for the dropdown
    while ($row = mysqli_fetch_assoc($facultyResult)) {

        $facultyName = $row['FName'];
        $facultyOptions .= "<option value='$facultyName'>$facultyName</option>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Subject Allocation</title>
    <link rel="stylesheet" href="styles.css">

</head>
<h1>
    COURSE SHARING
</h1>

<body>


    <form method="POST" action="">
        <label for="programSelect">Program select:</label>
        <select name="programSelect" id="programSelect">
            <?php echo $programOptions; ?>
        </select>

        <br><br>

        <label for="semesterSelect">Semester:</label>
        <select name="semesterSelect" id="semesterSelect">
            <?php echo $semesterOptions; ?>
        </select>

        <br><br>

        <label for="courseTypeSelect">Course Type:</label>
        <select name="courseTypeSelect" id="courseTypeSelect">
            <?php echo $courseTypeOptions; ?>
        </select>

        <br><br>

        <input type="submit" name="submit" value="Submit">

    </form>




</body>


<?php


// Handle form submission
if (isset($_POST['submit'])) {
    $selectedProgram = $_POST['programSelect'];
    $selectedSemester = $_POST['semesterSelect'];
    $selectedCourseType = $_POST['courseTypeSelect'];

    $_SESSION['programSelect'] = $_POST['programSelect'];
    $_SESSION['semesterSelect'] = $_POST['semesterSelect'];
    $_SESSION['courseTypeSelect'] = $_POST['courseTypeSelect'];

    $selectedFaculties = isset($_POST['faculties']) ? $_POST['faculties'] : array();

    // Query the database to retrieve the course code, course name, and faculty name based on the selected program, semester, and course type
    $courseQuery = "SELECT coursecode, coursename FROM subjects WHERE programID = '$selectedProgram' AND semester = '$selectedSemester' AND type = '$selectedCourseType'";
    $courseResult = mysqli_query($conn, $courseQuery);

    if (mysqli_num_rows($courseResult) > 0) {
        // Display the table with the retrieved data
        echo "<h2>Course Details</h2>";
        echo "<table>";
        echo "<tr><th>Course Code</th><th>Course Name</th>";

        if ($selectedCourseType == 'CORE') {
            echo "<th>Faculty 1</th><th>Faculty 2</th>";
        } elseif ($selectedCourseType == 'LAB') {
            echo "<th>Faculty 1</th><th>Faculty 2</th><th>Faculty 3</th><th>Faculty 4</th>";
        }

        echo "</tr>"; ?>
        <form method='POST' action=''>
            <?php
            while ($row = mysqli_fetch_assoc($courseResult)) {
                $courseCode = $row['coursecode'];
                $courseName = $row['coursename'];

                echo "<tr><td>$courseCode</td><td>$courseName</td>";

                if ($selectedCourseType == 'CORE') {
                    echo "<td><select name='faculty1[]' id='faculty1[]'>$facultyOptions</select></td><td><select name='faculty2[]' id='faculty2[]'>$facultyOptions</select></td>";
                } elseif ($selectedCourseType == 'LAB') {
                    echo "<td><select  name='faculty1[]' id='faculty1[]'>$facultyOptions</select></td><td><select name='faculty2[]' id='faculty2[]'>$facultyOptions</select></td>
                    <td><select name='faculty3[]' id='faculty3[]'>$facultyOptions</select></td><td><select name='faculty4[]' id='faculty4[]'>$facultyOptions</select></td>";
                }

                echo "</tr>";
            }

            echo "</table>";
            ?>

            <input type='submit' name='submitCourse' value='Submit Course Details' style='width: 200px;'>
        </form>

<?php
    }
}
//  else {
//     echo "No courses found for the selected program and semester.";
// }
if (isset($_POST['submitCourse'])) {
    // echo "!!!";
    //Insert the data into the coursesharing table
    $faculty1 = $_POST['faculty1'];
    $faculty2 = $_POST['faculty2'];

    // echo $faculty1;
    $selectedProgram = $_SESSION['programSelect'];
    $selectedSemester = $_SESSION['semesterSelect'];
    $selectedCourseType = $_SESSION['courseTypeSelect'];
    $courseQuery = "SELECT coursecode, coursename FROM subjects WHERE programID = '$selectedProgram' AND semester = '$selectedSemester' AND type = '$selectedCourseType'";
    $courseResult = mysqli_query($conn, $courseQuery);
    foreach ($faculty1 as $index => $courseid) {
        $row = mysqli_fetch_assoc($courseResult);
        $coursecode = $row['coursecode'];


        $insertQuery = "INSERT INTO coursesharing (CourseCode, ProgramID, Fid) 
        VALUES ('$coursecode','$selectedProgram','$courseid')";
        mysqli_query($conn, $insertQuery);
    }
    $courseQuery = "SELECT coursecode, coursename FROM subjects WHERE programID = '$selectedProgram' AND semester = '$selectedSemester' AND type = '$selectedCourseType'";
    $courseResult = mysqli_query($conn, $courseQuery);
    foreach ($faculty2 as $index => $courseid) {
        $row = mysqli_fetch_assoc($courseResult);
        $coursecode = $row['coursecode'];

        $insertQuery = "INSERT INTO coursesharing (CourseCode, ProgramID, Fid) 
        VALUES ('$coursecode','$selectedProgram','$courseid')";
        mysqli_query($conn, $insertQuery);
    }

    if ($selectedCourseType == "LAB") {
        $courseQuery = "SELECT coursecode, coursename FROM subjects WHERE programID = '$selectedProgram' AND semester = '$selectedSemester' AND type = '$selectedCourseType'";
        $courseResult = mysqli_query($conn, $courseQuery);
        foreach ($faculty3 as $index => $courseid) {
            $row = mysqli_fetch_assoc($courseResult);
            $coursecode = $row['coursecode'];


            $insertQuery = "INSERT INTO coursesharing (CourseCode, ProgramID, Fid) 
        VALUES ('$coursecode','$selectedProgram','$courseid')";
            mysqli_query($conn, $insertQuery);
        }
        $courseQuery = "SELECT coursecode, coursename FROM subjects WHERE programID = '$selectedProgram' AND semester = '$selectedSemester' AND type = '$selectedCourseType'";
        $courseResult = mysqli_query($conn, $courseQuery);
        foreach ($faculty4 as $index => $courseid) {
            $row = mysqli_fetch_assoc($courseResult);
            $coursecode = $row['coursecode'];

            $insertQuery = "INSERT INTO coursesharing (CourseCode, ProgramID, Fid) 
        VALUES ('$coursecode','$selectedProgram','$courseid')";
            mysqli_query($conn, $insertQuery);
        }
    }

    echo "Inserted Successfully";
}
// if (!empty($labcoursecode)) {
//     echo "!!!";
//     $insertQuery = "INSERT INTO coursesharing (CourseCode, ProgramID, Fid, EffectiveDate, Description) VALUES " . implode(",", $values);
//     mysqli_query($conn, $insertQuery);

//     // Display a success message or any other relevant message after data insertion
//     echo "Course details shared successfully!";
// }
// //else {
// //     echo "No faculties selected.";
// // }

?>

</body>

</html>