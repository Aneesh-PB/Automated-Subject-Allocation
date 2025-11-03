<?php
include("config.php");
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
        font-size:16px
      }


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
	 
      input[type=text]{
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
      select{
      width:80%;
      padding:5px;
      }
      h1 {
      text-align:center;
      font-size:18;
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
                        <?php
                        // Fetch programs from the "Programme" table
                        $programQuery = mysqli_query($conn, "SELECT ProgrammeId, ProgrammeName FROM programme;");
                        while ($programRow = mysqli_fetch_assoc($programQuery)) {
                            $programId = $programRow['iProgrammeId'];
                            $programName = $programRow['ProgrammeName'];
                            echo "<option value='$programId'>$programName</option>";
                        }
                        ?>
                    </select>                    
                </div>
                <div class="column">
                    <label for="Semester">Choose Semester:</label>
                    <select id="Semester">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                      </select>
                      </div>
                <div class="column">
                    <label for="Elective">Choose Elective:</label>
                    <select name="SelectedElective">
                        <?php
                        if (isset($_POST['Program']) && isset($_POST['Semester'])) {
                            $selectedProgramName = $_POST['Program'];
                            $selectedSemester = $_POST['Semester'];

                            // Fetch ProgrammeID from the "Programme" table based on the selected ProgrammeName
                            $programmeQuery = mysqli_query($conn, "SELECT ProgrammeID FROM programme WHERE ProgrammeName = '$selectedProgramName';");
                            if (mysqli_num_rows($programmeQuery) > 0) {
                                $programmeRow = mysqli_fetch_assoc($programmeQuery);
                                $selectedProgramID = $programmeRow['ProgrammeID'];

                                // Fetch CourseTypeName from the "CourseType" table based on the selected ProgramID and Semester
                                $courseQuery = mysqli_query($conn, "SELECT ct.CourseTypeName 
                                                                    FROM course c
                                                                    INNER JOIN coursetype ct ON c.CourseTypeID = ct.CourseTypeID
                                                                    WHERE c.ProgrammeID = '$selectedProgramID' AND c.CourseSem = '$selectedSemester';");
                                while ($courseRow = mysqli_fetch_assoc($courseQuery)) {
                                    $selectedCourseTypeName = $courseRow['CourseTypeName'];
                                    echo "<option value='$selectedCourseTypeName'>$selectedCourseTypeName</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                    </div>

<input type="submit" name="submit">
</div>
</form>
<div>
<?php
if (isset($_POST['submit']) && isset($_POST['SelectedElective'])) {
$selectedElective = $_POST['SelectedElective'];

// Fetch CourseName and CourseType from the "Course" table based on the selected Elective (CourseTypeName)
$courseTypeQuery = mysqli_query($conn, "SELECT ct.CourseTypeName, c.CourseName, c.CourseCode
                                         FROM CourseType ct
                                         INNER JOIN Course c ON ct.CourseTypeID = c.CourseTypeID
                                         WHERE ct.CourseTypeName = '$selectedElective';");
if (mysqli_num_rows($courseTypeQuery) > 0) {
    $courseTypeRow = mysqli_fetch_assoc($courseTypeQuery);
    $courseName = $courseTypeRow['CourseName'];
    $courseCode = $courseTypeRow['CourseCode'];

    // Display the fetched data along with the checkbox
    echo "<label>Course Name: $courseName</label><br>";
    echo "<label>Course Code: $courseCode</label><br>";
    echo "<input type='checkbox' name='includeCheckbox' value='1'>";
    echo "<label for='includeCheckbox'>Include Checkbox</label><br>";
}
}
?>
</div>
</div>
</div>
</body>
</html>
