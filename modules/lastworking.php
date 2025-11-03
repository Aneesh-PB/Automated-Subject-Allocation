<?php
 require_once 'config.php';
 $subj="Subject1";
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
      }

      #logo-div {
        width: 100%;
        min-height: 50px;
        background-color: lightgray;
        padding-left: 2%;
        line-height: 50px;
        margin-bottom: 10px;
      }


      #header-banner-div {
        width: 100%;
        min-height: 100px;
        background-color: lightgray;
        text-align: center;
        line-height: 100px;
        margin-bottom: 10px;
      }

      #main-div {
        width: 100%;
        margin-bottom: 10px;
      }

      /* #sidebar-div {
        width: 20%;
        min-height: 400px;
        background-color: lightgray;
        float: left;
        text-align: center;
        line-height: 400px;
      } */

      #bodyarea-div {
        width: 100%;
        min-height: 100px;
        background-color: lightblue;
        float: right;
        text-align: center;
        line-height: 100px;
      }

      #tname{
        text-align:left;
        margin-left: 100px;
        margin-top: 10px;
      }

      .clearfix::after {
        content: "";
        display: block;
        clear: both;
      }

      #footer-div {
        width: 100%;
        min-height: 50px;
        background-color: lightgray;
        text-align: center;
        line-height: 50px;
      }

      #wrapper-div {
        width: 80%;
        margin: auto;
      }


    </style>
  </head>
  <body>
    <div id="wrapper-div">
      <div id="logo-div">Logo</div>


      <div id="header-banner-div">Subject Selection</div>

      <div id="main-div" class="clearfix">
  
        <div id="bodyarea-div">

    
        
<p>

<div id='selectdiv'>

            <table id='table' border="black" width=100% height=30%>
            
            <tr>
               <td>Subject 1</td>
               
               <td>
               <form action = "" method = "POST">
               <select class="inpu" name="Subject1" >
                <?php
                $query="select * from subjects";
                $resu=mysqli_query($conn,$query);
                while($row=mysqli_fetch_array($resu)){
                ?>
                <option value="<?php echo $row['CourseCode'];?>"><?php echo $row['CourseName'];?></option>
                <?php
            } 
            ?>
                </select>
        
                <td>
                

            </tr>
            </form>    
            </table>
    
            <button id='button' name='add' onclick="duplicate()" class='btn btn-default'>Add</button>
            </div>
            <input type = "submit" onclick="submit()" name = "submit" >
            

        <!-- </form> -->
        <?php
        if(isset($_REQUEST['submit']))
        {
         //$Fid = $_POST['FId']; 
         //$Fid='F100';  
         $Ccode= $_REQUEST['CourseCode'];
         echo $Ccode;
         //$Cname = 'abc';
         
        $res = mysqli_query($conn,"INSERT INTO `selected_subjects` (`Fid`, `Course_code`, `Course_name`) VALUES ('F100', '101004/IT622T', 'ABC');");
        }
        ?>
        <script>

// var i=0;
// var original=document.getElementById('selectdiv');

// function duplicate(){
//   var clone=original.cloneNode(true);
//   clone.id="selectdiv"+ ++i;
//   original.parentNode.appendChild(clone);
// }
var i=1;
function duplicate(){
    let html=`<td>Subject `+ ++i+`<td> <select class="inpu" name=Subject'`+i+`>
                <?php
                 $query="select * from subjects";
                 $resu=mysqli_query($conn,$query);
                 while($row=mysqli_fetch_array($resu)){
                ?>
                <option value="<?php echo $row['CourseCode'];?>"><?php echo $row['CourseName'];?></option>
                <?php
             } 
            ?>
                </select>
                </td>`
  var tableRow = document.getElementById("table");
let row = document.createElement('tr');
row.innerHTML = html;
tableRow.appendChild(row);

}

function submit(){
    for (var j=1;j<=i;j++){
        console.log(j);
        var sub='Subject'+i;
        <?php
        if(isset($_REQUEST['submit']))
        {
         //$Fid = $_POST['FId']; 
         //$Fid='F100';
         echo 1; 
         echo $subj;
         $subj++; 
        //  $Ccode= $_REQUEST[sub];
        //  echo $Ccode;
         //$Cname = 'abc';
        
        }
        ?>
    }
}
</script>
<!-- <script>console.log(i)</script> -->
</p>
    </div>
       
      </div>
      <div id="footer-div">Footer</div>
    </div>
  </body>
</html>