<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>

<h1>Details</h1>

<p>
    <?php

    require_once 'config.php';

    $sql ="select fid,fname,theory,lab from faculty";
    $result=$conn ->query ($sql);

    if ($result ->num_rows>0){
        echo "<select name=sublist class='form-control' style='width:200px;'>";
        while ($row=$result ->fetch_assoc()){
            echo "<option value=$row[id]>$row[coursename].</option>";
            
        }
        echo "</select>";
    }
    else{
        echo "0 results";
        }
    

    ?>
</p>
</body>
</html>