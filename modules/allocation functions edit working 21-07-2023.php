<?php 

include('config.php');
session_start();
function display()
    {
      
      
      global $conn;  
      $itercount=$_SESSION['itercount'];       
      //global $itercount;
      //echo $itercount;
      ?>

      <h3>Iteration <?php echo $itercount++; ?></h3>
      <table border="black" width=100% height=30%>
                <tr>
                
                <th>Priority</th>
                <th>Name</th>
                <th>Subject</th>
                </tr>
         
        <form action='subjectallocation_allocationpost.php' method='POST'>        
        <?php 
         //Display 
         
         $i=1;

         $query="select * from faculty order by priority";
         $resu=mysqli_query($conn,$query);
        
         while($row=mysqli_fetch_array($resu)){
         $allocationcount=0;
           
           $Fid=$row['Fid'];
           
           //echo $Fid;
           $theoryquery="select * from faculty where Fid='$Fid'";
           $theoryres=mysqli_query($conn,$theoryquery);
           $theorycol=mysqli_fetch_array($theoryres);
           $theorynum=$theorycol['Theory'];
           //echo $theorynum;

           

           $allocatedquery="select * from tempallocation where FacultyID='$Fid'";
           $allocatedres=mysqli_query($conn,$allocatedquery);
           $allocatedsub=mysqli_fetch_array($allocatedres);

           $alloccountquery="select count(*) as count from tempallocation where FacultyID='$Fid'";
           $alloccountres=mysqli_query($conn,$alloccountquery);
           $alloccountcol=mysqli_fetch_array($alloccountres);
           $alloccount=$alloccountcol['count'];
           if (!$alloccount){
             $alloccount=1;
           }
           

         
         ?>
         
         <tr>                                        
         <td rowspan="<?php echo $alloccount;?>"><?php echo $row['Priority'];?></td>
         <td rowspan="<?php echo $alloccount;?>"><?php echo $row['FName'];?>
         <?php if($itercount>4){?>
           <input name="<?php echo $Fid; ?>" type='submit' value='Edit'>
           <?php }?>
         </td>
         <td><?php if ($allocatedsub) {
           $allocatedsubcode=$allocatedsub['CourseID'];
           $allocatedsubprogram=$allocatedsub['Program'];
          
            $allocatedsubnamequery="select * from subjects where CourseCode='$allocatedsubcode' and Program='$allocatedsubprogram'";
           
           $allocatedsubnameres=mysqli_query($conn,$allocatedsubnamequery);
           $allocatedsubnamecol=mysqli_fetch_array($allocatedsubnameres);
           $allocatedsubname=$allocatedsubnamecol['CourseName'];
           $allocatedsubsem=$allocatedsubnamecol['Semester'];
           $allocatedsubprogram=$allocatedsubnamecol['Program'];
           echo $allocatedsubsem.' '.$allocatedsubprogram.' : '.$allocatedsubname;
         }
         else {
           echo "-";
         }?> </td>
         </tr>
         <script>
          

<?php 
           while($allocatedsub=mysqli_fetch_array($allocatedres))
           {?>
             document.write(`
             <tr>

             <td><?php if ($allocatedsub) {
           $allocatedsubcode=$allocatedsub['CourseID'];
           $allocatedsubprogram=$allocatedsub['Program'];
           $allocatedsubnamequery="select * from subjects where CourseCode='$allocatedsubcode' and Program='$allocatedsubprogram'";
          
          $allocatedsubnameres=mysqli_query($conn,$allocatedsubnamequery);
          $allocatedsubnamecol=mysqli_fetch_array($allocatedsubnameres);
          $allocatedsubname=$allocatedsubnamecol['CourseName'];
          $allocatedsubsem=$allocatedsubnamecol['Semester'];
          $allocatedsubprogram=$allocatedsubnamecol['Program'];
          echo $allocatedsubsem.' '.$allocatedsubprogram.' : '.$allocatedsubname;
         
         } 
         else {
           echo "-";
         }?>
          </td>
             </tr>`
             )
             
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

       $unallocsubquery="select * from subjects where (CourseCode,Program) not in (select CourseID,Program from tempallocation) and Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
       $unallocsubres=mysqli_query($conn,$unallocsubquery);
       $unallocrows=mysqli_num_rows($unallocsubres)


         ?>
         
         
         <?php
         if ($unallocrows>0)
         {
         while ($unallocsub=mysqli_fetch_array($unallocsubres))
         {
         ?>
         <tr>
            <td><?php echo $i; $i++ ?></td>
            <td><?php echo $unallocsub['Semester'];?></td>
            <td><?php echo $unallocsub['Program'];?></td>                                        
            <td><?php echo $unallocsub['CourseCode'];?></td>
            <td><?php echo $unallocsub['CourseName'];?></td>
         </tr>
         <?php }}
         else{?>
         <tr>
            <td style="text-align:center">-</td>
            <td>-</td>
            <td>-</td>                                        
            <td>-</td>
            <td>-</td>
         </tr>
         <?php }?>
       </table>

    <?php $_SESSION['itercount']++;}

    function seconditer(){
      echo'<script>
      document.body.innerHTML="";
      </script>';

      
        ?>
        <html>
    <head>
        <title>Subject Allocation</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    
  <body>
    <div id="wrapper-div">
      <div id="logo-div">Logo</div>

      <div id="nav-div">Navigation</div>

      <div id="header-banner-div">Subject Allocation</div>

      <div id="main-div" class="clearfix">
        <div id="sidebar-div"> 
        <button onclick="document.location='flolad1.php'">Subject Allocation</button>
        <button onclick="document.location='fload.php'">Edit Allocation</button>
        <button onclick="document.location='currallo.php'">Current Allocation</button>
        </div>
        <div id="bodyarea-div">

       

        <form action = "subjectallocation_allocationpost.php" method = "POST">
        <input type = "submit" value="Next" name = "unalloc" >
        
        </form>
        
        
        <?php
        
        global $conn;
        $subarray=$_SESSION['subarray'];
        global $selectedsubcount;

           

                  // echo"subarray:".count($subarray);
                  // echo"selectedsub:".$selectedsubcount;

                $query="select * from faculty order by priority desc";
                $resu=mysqli_query($conn,$query);
                $i=0;
                $j=1000;
                //print_r($subarray);
                //$subarray=array();
                while($row=mysqli_fetch_array($resu)){
                  $allocationcount=0;
                  ++$i;
                  ++$j;
                  $Fid=$row['Fid'];
                  
                  //echo $Fid;
                  $theoryquery="select * from faculty where Fid='$Fid'";
                  $theoryres=mysqli_query($conn,$theoryquery);
                  $theorycol=mysqli_fetch_array($theoryres);
                  $theorynum=$theorycol['Theory'];
                  //echo $theorynum;

                  $subquery="select * from selected_subjects where FID='$Fid' order by Pref";
                  $subres=mysqli_query($conn,$subquery);

                  $allocatedquery="select * from tempallocation where FacultyID='$Fid'";
                  $allocatedres=mysqli_query($conn,$allocatedquery);
                  $allocatedsub=mysqli_fetch_array($allocatedres);
       
                  $alloccountquery="select count(*) as count from tempallocation where FacultyID='$Fid'";
                  $alloccountres=mysqli_query($conn,$alloccountquery);
                  $alloccountcol=mysqli_fetch_array($alloccountres);
                  $alloccount=$alloccountcol['count'];
                  //echo $alloccount.' '.$Fid;
                  if (!$alloccount){
                    $alloccount=0;
                  }
                  

                  while ($subcol=mysqli_fetch_array($subres))
                    {
                        
                      $sub=$subcol['Course_name'];
                      $subid=$subcol['Course_code'];
                      $subsem=$subcol['Semester'];
                      $subprogram=$subcol['Program'];
                      
                      
                        
                        if (!(in_array(array($subid,$subprogram),$subarray)) && ($allocationcount==0) && ($alloccount<$theorynum) )
                        {
                           
                          array_push($subarray,array($subid,$subprogram));
                          $inquery="insert into tempallocation (FacultyID,CourseID,AllocationType,Semester,Program) values('$Fid','$subid','Theory','$subsem','$subprogram')";
                          $inqueryres=mysqli_query($conn,$inquery);
                          $allocationcount++;

                        }

                    }
                   

                
              }
              //print_r($subarray);

            //Display 
            $_SESSION['subarray']=$subarray;
            display();
            
           ?>
            
            
           </div>
            </div>   
    </div>

    
    <div id="footer-div">Footer</div>
    </script>

    
    </body>

    </html>
        <?php }

    
    
 
 function unalloc()
 {

  echo'<script>
  document.body.innerHTML="";
  
  </script>';
  
 

  
    ?>
    <html>
<head>
    <title>Subject Allocation</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    </head>

<body>
<div id="wrapper-div">
  <div id="logo-div">Logo</div>

  <div id="nav-div">Navigation</div>

  <div id="header-banner-div">Subject Allocation</div>

  <div id="main-div" class="clearfix">
    <div id="sidebar-div"> 
    <button onclick="document.location='flolad1.php'">Subject Allocation</button>
    <button onclick="document.location='fload.php'">Edit Allocation</button>
    <button onclick="document.location='currallo.php'">Current Allocation</button>
    </div>
    <div id="bodyarea-div">

   

    <form action = "subjectallocation_allocationpost.php" method = "POST">
    <input type = "submit" value="Next" name = "unallocadd" >
   
    </form>
    
    
    <?php
    
    
  global $conn;
  $subarray=$_SESSION['subarray'];
  $subcountquery="select count(*) as count from subjects where Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
  $subcountres=mysqli_query($conn,$subcountquery);
  $subcountarray=mysqli_fetch_array($subcountres);
  $subcount=$subcountarray['count'];

  // $unallocsubquery="select * from subjects where CourseCode not in (select CourseID from tempallocation) and Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
  // $unallocsubres=mysqli_query($conn,$unallocsubquery);

  for ($k=0;$k<5;$k++)
  {
    //echo count($subarray).' '.$subcount.' ';
    
  if(count($subarray)<$subcount)
      {

      $query="select * from faculty order by priority desc";
      $resu=mysqli_query($conn,$query);
      $i=0;
      $j=1000;
      
      //$subarray=array();
      while($row=mysqli_fetch_array($resu)){
        $allocationcount=0;
        ++$i;
        ++$j;
        $Fid=$row['Fid'];
        
        //echo $Fid;
        $theoryquery="select * from faculty where Fid='$Fid'";
        $theoryres=mysqli_query($conn,$theoryquery);
        $theorycol=mysqli_fetch_array($theoryres);
        $theorynum=$theorycol['Theory'];
        //echo $theorynum;

        $subquery="select * from subjects where (CourseCode,Program) not in (select CourseID,Program from tempallocation) and Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
        $subres=mysqli_query($conn,$subquery);

        $facultysubcountquery="select count(*) as count from tempallocation where FacultyID='$Fid'";
        $facultysubcountres=mysqli_query($conn,$facultysubcountquery);
        $facultysubcountcol=mysqli_fetch_array($facultysubcountres);
        $facultysubcount=$facultysubcountcol['count'];
        //echo $facultysubcount;

        while ($subcol=mysqli_fetch_array($subres))
          {
              
            $sub=$subcol['CourseName'];
            $subid=$subcol['CourseCode'];
            $subsem=$subcol['Semester'];
            $subprogram=$subcol['Program'];

            
              
              if (!(in_array(array($subid,$subprogram),$subarray)) && ($allocationcount==0) && ($facultysubcount<$theorynum) )
              {
                 
                array_push($subarray,array($subid,$subprogram));
                $inquery="insert into tempallocation (FacultyID,CourseID,AllocationType,Semester,Program) values('$Fid','$subid','Theory','$subsem','$subprogram')";
                $inqueryres=mysqli_query($conn,$inquery);
                $allocationcount++;

              }

          }

      }
      
      

    }
    
  }


    $_SESSION['subarray']=$subarray;
    display();
        
       ?>
        
        
       </div>
        </div>   
</div>


<div id="footer-div">Footer</div>
</script>


</body>

</html>

    <?php 
}

 
 function unallocadd()
 {

  echo'<script>
  document.body.innerHTML="";
  
  </script>';
  
 

  
    ?>
    <html>
<head>
    <title>Subject Allocation</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    </head>

<body>
<div id="wrapper-div">
  <div id="logo-div">Logo</div>

  <div id="nav-div">Navigation</div>

  <div id="header-banner-div">Subject Allocation</div>

  <div id="main-div" class="clearfix">
    <div id="sidebar-div"> 
    <button onclick="document.location='flolad1.php'">Subject Allocation</button>
    <button onclick="document.location='fload.php'">Edit Allocation</button>
    <button onclick="document.location='currallo.php'">Current Allocation</button>
    </div>
    <div id="bodyarea-div">

   

    <form action = "subjectallocation_allocationpost.php" method = "POST">
    <!-- <input type = "submit" value="Next" name = "unalloc" > -->
    <input type = "submit" name = "submit">
    </form>
    
    
    <?php
    
 
    global $conn;
    $subarray=$_SESSION['subarray'];
    $subcountquery="select count(*) as count from subjects";
    $subcountres=mysqli_query($conn,$subcountquery);
    $subcountarray=mysqli_fetch_array($subcountres);
    $subcount=$subcountarray['count'];

    for ($k=0;$k<5;$k++)
    {
  
      if(count($subarray)<$subcount)
                  {
  
                  $query="select * from faculty order by priority desc";
                  $resu=mysqli_query($conn,$query);
                  $i=0;
                  $j=1000;
                  
                  //$subarray=array();
                  while($row=mysqli_fetch_array($resu)){
                    $allocationcount=0;
                    ++$i;
                    ++$j;
                    $Fid=$row['Fid'];
                    
                    //echo $Fid;
                    $theoryquery="select * from faculty where Fid='$Fid'";
                    $theoryres=mysqli_query($conn,$theoryquery);
                    $theorycol=mysqli_fetch_array($theoryres);
                    $theorynum=$theorycol['Theory'];
                    //echo $theorynum;
  
                    $subquery="select * from subjects where (CourseCode,Program) not in (select CourseID,Program from tempallocation) and Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
                    $subres=mysqli_query($conn,$subquery);
  
                    $facultysubcountquery="select count(*) as count from tempallocation where FacultyID='$Fid'";
                    $facultysubcountres=mysqli_query($conn,$facultysubcountquery);
                    $facultysubcountcol=mysqli_fetch_array($facultysubcountres);
                    $facultysubcount=$facultysubcountcol['count'];
                    // echo $facultysubcount;
  
                    while ($subcol=mysqli_fetch_array($subres))
                      {
                          
                        $sub=$subcol['CourseName'];
                        $subid=$subcol['CourseCode'];
                        $subsem=$subcol['Semester'];
                        $subprogram=$subcol['Program'];
                        
                        
                          if (!(in_array(array($subid,$subprogram),$subarray)) && $allocationcount<1 && $facultysubcount<=$theorynum)
                          {
                              //echo "1";
                              array_push($subarray,array($subid,$subprogram));
                              $inquery="insert into tempallocation (FacultyID,CourseID,AllocationType,Semester,Program) values('$Fid','$subid','Theory','$subsem','$subprogram')";
                              $inqueryres=mysqli_query($conn,$inquery);
                              $allocationcount++;
  
                          }
  
                      }
  
                  }
                }
              }
  
               
              $_SESSION['subarray']=$subarray;    
              display();
        
       ?>
        
        
       </div>
        </div>   
</div>


<div id="footer-div">Footer</div>
</script>


</body>

</html>

    <?php 
} 



function displaydropdown($Fidin)
{
  
  echo'<script>
  document.body.innerHTML="";
  </script>';
  

  
    ?>
    <html>
<head>
    <title>Subject Allocation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div id="wrapper-div">
  <div id="logo-div">Logo</div>

  <div id="nav-div">Navigation</div>

  <div id="header-banner-div">Subject Allocation</div>

  <div id="main-div" class="clearfix">
    <div id="sidebar-div"> 
    <button onclick="document.location='flolad1.php'">Subject Allocation</button>
    <button onclick="document.location='fload.php'">Edit Allocation</button>
    <button onclick="document.location='currallo.php'">Current Allocation</button>
    </div>
    <div id="bodyarea-div">
      <h3> Edit </h3>
    
<?php
      
      global $conn;  
      $itercount=$_SESSION['itercount'];       
      //global $itercount;
      //echo $itercount;
      ?>

      
      <table border="black" width=100% height=30%>
                <tr>
                
                <th>Priority</th>
                <th>Name</th>
                <th>Subject</th>
                </tr>
         
        <form action='subjectallocation_allocationpost.php' method='POST'>        
        <?php 
         //Display 
         
         $i=1;

         $query="select * from faculty order by priority";
         $resu=mysqli_query($conn,$query);
        
         while($row=mysqli_fetch_array($resu)){
         $allocationcount=0;
           
           $Fid=$row['Fid'];
           
           //echo $Fid;
           $theoryquery="select * from faculty where Fid='$Fid'";
           $theoryres=mysqli_query($conn,$theoryquery);
           $theorycol=mysqli_fetch_array($theoryres);
           $theorynum=$theorycol['Theory'];
           //echo $theorynum;

           
          try{
            $allocatedquery="select * from tempallocationedit where FacultyID='$Fid'";
            $allocatedres=mysqli_query($conn,$allocatedquery);
            $allocatedsub=mysqli_fetch_array($allocatedres);

            $alloccountquery="select count(*) as count from tempallocationedit where FacultyID='$Fid'";
            $alloccountres=mysqli_query($conn,$alloccountquery);
            $alloccountcol=mysqli_fetch_array($alloccountres);
            $alloccount=$alloccountcol['count'];
            if (!$alloccount){
              $alloccount=1;
            }
           }
           catch(Exception)
           {         
            
                $allocatedquery="select * from tempallocation where FacultyID='$Fid'";
                $allocatedres=mysqli_query($conn,$allocatedquery);
                $allocatedsub=mysqli_fetch_array($allocatedres);

                $alloccountquery="select count(*) as count from tempallocation where FacultyID='$Fid'";
                $alloccountres=mysqli_query($conn,$alloccountquery);
                $alloccountcol=mysqli_fetch_array($alloccountres);
                $alloccount=$alloccountcol['count'];
                if (!$alloccount){
                  $alloccount=1;
                }
           }

         
         ?>
         
         <tr>                                        
         <td rowspan="<?php echo $alloccount;?>"><?php echo $row['Priority'];?></td>
         <td rowspan="<?php echo $alloccount;?>"><?php echo $row['FName'];?>
         
         </td>
         <td><?php if ($allocatedsub) {
           $allocatedsubcode=$allocatedsub['CourseID'];
           $allocatedsubprogram=$allocatedsub['Program'];
            $allocatedsubnamequery="select * from subjects where CourseCode='$allocatedsubcode' and Program='$allocatedsubprogram'";
           
           $allocatedsubnameres=mysqli_query($conn,$allocatedsubnamequery);
           $allocatedsubnamecol=mysqli_fetch_array($allocatedsubnameres);
           $allocatedsubname=$allocatedsubnamecol['CourseName'];
           $allocatedsubsem=$allocatedsubnamecol['Semester'];
           $allocatedsubprogram=$allocatedsubnamecol['Program'];
           $alloccountquery="select count(*) as count from tempallocation where FacultyID='$Fid'";
           $alloccountres=mysqli_query($conn,$alloccountquery);
           $alloccountcol=mysqli_fetch_array($alloccountres);
           $alloccount=$alloccountcol['count'];
           if ($Fid==$Fidin){?>
            <select class="form-control" name="sub1[]" id="sub1[]" class="form-control" required placeholder="Select Subject" >
                 <option value="" disabled selected>Select Subject</option>
                    <?php
                    $subquery="select * from subjects where Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
                    $subqueryres=mysqli_query($conn,$subquery);
                    
                    while($rows=mysqli_fetch_array($subqueryres)){
                    ?>
                    
                    <option value="<?php echo $rows['CourseCode'];?>"><?php echo $rows['CourseCode']." - ".$rows['CourseName'];?></option>
                    <?php
                } 
                ?>
                    </select>

                    <?php 
                    
                    if ($alloccount==1){?>
                    <br>
                    
                    <input name="<?php echo $Fid.'Edit'; ?>" type='submit' value='Submit'>
                    
                    
            
          <?php
              }
          
           }
           else{
           echo $allocatedsubsem.' '.$allocatedsubprogram.' : '.$allocatedsubname;
           }
         }
         else {
           echo "-";
         }?> </td>
         </tr>
         <script>
          

<?php 
          $i=1;
           while($allocatedsub=mysqli_fetch_array($allocatedres))
           {?>
             document.write(`
             <tr>

             <td><?php if ($allocatedsub) {
           $allocatedsubcode=$allocatedsub['CourseID'];
           $allocatedsubnamequery="select * from subjects where CourseCode='$allocatedsubcode'";
          
          $allocatedsubnameres=mysqli_query($conn,$allocatedsubnamequery);
          $allocatedsubnamecol=mysqli_fetch_array($allocatedsubnameres);
          $allocatedsubname=$allocatedsubnamecol['CourseName'];
          $allocatedsubsem=$allocatedsubnamecol['Semester'];
          $allocatedsubprogram=$allocatedsubnamecol['Program'];
          
           
          
          if ($Fid==$Fidin){?>
          <select class="form-control" name="sub1[]" id="sub1[]" class="form-control" required placeholder="Select Subject" >
                 <option value="" disabled selected>Select Subject</option>
                    <?php
                    $subquery="select * from subjects where Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
                    $subqueryres=mysqli_query($conn,$subquery);
                    
                    while($rows=mysqli_fetch_array($subqueryres)){
                    ?>
                    
                    <option value="<?php echo $rows['CourseCode'];?>"><?php echo $rows['CourseCode']." - ".$rows['CourseName'];?></option>
                    
                    <?php
                }
                
                ?>
                    
                    </select>
                    
                    <?php 
                    
                    if ($i==$alloccount-1){?>
                    <br>
                    <input name="<?php echo $Fid.'Edit'; ?>" type='submit' value='Submit'>
                    
            
          <?php
              }
          $i++;
           }
           else{
           echo $allocatedsubsem.' '.$allocatedsubprogram.' : '.$allocatedsubname;
           }
         
         
         } 
         else {
           echo "-";
         }?>
          </td>
             </tr>`
             )
             
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

       $unallocsubquery="select * from subjects where (CourseCode,Program) not in (select CourseID,Program from tempallocation) and Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
       $unallocsubres=mysqli_query($conn,$unallocsubquery);
       $unallocrows=mysqli_num_rows($unallocsubres)


         ?>
         
         
         <?php
         if ($unallocrows>0)
         {
         while ($unallocsub=mysqli_fetch_array($unallocsubres))
         {
         ?>
         <tr>
            <td><?php echo $i; $i++ ?></td>
            <td><?php echo $unallocsub['Semester'];?></td>
            <td><?php echo $unallocsub['Program'];?></td>                                        
            <td><?php echo $unallocsub['CourseCode'];?></td>
            <td><?php echo $unallocsub['CourseName'];?></td>
         </tr>
         <?php }}
         else{?>
         <tr>
            <td style="text-align:center">-</td>
            <td>-</td>
            <td>-</td>                                        
            <td>-</td>
            <td>-</td>
         </tr>
         <?php }?>
       </table>

    <?php 
    
}
function displayafteredit()
    {
      
      echo'<script>
  document.body.innerHTML="";
  </script>';
  

  
    ?>
    <html>
<head>
    <title>Subject Allocation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div id="wrapper-div">
  <div id="logo-div">Logo</div>

  <div id="nav-div">Navigation</div>

  <div id="header-banner-div">Subject Allocation</div>

  <div id="main-div" class="clearfix">
    <div id="sidebar-div"> 
    <button onclick="document.location='flolad1.php'">Subject Allocation</button>
    <button onclick="document.location='fload.php'">Edit Allocation</button>
    <button onclick="document.location='currallo.php'">Current Allocation</button>
    </div>
    <div id="bodyarea-div">
    <?php
      global $conn;  
      $itercount=$_SESSION['itercount'];       
      //global $itercount;
      //echo $itercount;
      ?>

      <h3>Duplicates Found</h3>
      <?php
      $duplicatecheckquery='SELECT CourseID,COUNT(CourseID) as coursecount,Program,COUNT(Program) as programcount FROM `tempallocationedit` GROUP BY CourseID,Program HAVING count(CourseID)>1 and count(Program)>1;';
      $duplicatecheckqueryres=mysqli_query($conn,$duplicatecheckquery);
      $duplicaterowcount= mysqli_num_rows($duplicatecheckqueryres);
      if ($duplicaterowcount>0){
        ?><table border="black" width=100% height=30%>
        <tr>        
        <th>Name</th>
        <th>Subject</th>
        </tr>
      
      
<?php
      while($duplicatecheckqueryrow=mysqli_fetch_array($duplicatecheckqueryres)){
        $duplicatecoursecount=$duplicatecheckqueryrow['coursecount'];
        $duplicatecourseid=$duplicatecheckqueryrow['CourseID'];
        $duplicateprogramname=$duplicatecheckqueryrow['Program'];
        $duplicateprogramcount=$duplicatecheckqueryrow['programcount'];

        $duplicatefacultynamequery="Select * from tempallocationedit t join faculty f on t.FacultyID=f.Fid join subjects s on t.CourseID=s.CourseCode where t.CourseID='$duplicatecourseid' and t.Program='$duplicateprogramname' and  s.Program='$duplicateprogramname'";
        $duplicatefacultynamequeryres=mysqli_query($conn,$duplicatefacultynamequery);
        while ($duplicatefacultynamerow=mysqli_fetch_array($duplicatefacultynamequeryres))
        {

         
          
            $duplicatefaculyname=$duplicatefacultynamerow['FName'];
            $duplicatecoursename=$duplicatefacultynamerow['CourseName'];
            $duplicatecoursesem=$duplicatefacultynamerow['Semester'];
            ?>
            <tr>        
            <td><?php echo $duplicatefaculyname;?></td>
            <td><?php echo $duplicatecourseid.' - '.$duplicatecoursename.' - '. $duplicatecoursesem.' - '.$duplicateprogramname;?></td>
            </tr>

            <?php
        }

      }
      ?>
      </table>
    <?php
    }
      ?>
      <h3>Current Allocation</h3>
      <form action='subjectallocation_allocationpost.php' method='POST'>       
      <input type = "submit" name = "submit">
      <table border="black" width=100% height=30%>
                <tr>
                
                <th>Priority</th>
                <th>Name</th>
                <th>Subject</th>
                </tr>
         
         
        <?php 
         //Display 
         
         $i=1;

         $query="select * from faculty order by priority";
         $resu=mysqli_query($conn,$query);
        
         while($row=mysqli_fetch_array($resu)){
         $allocationcount=0;
           
           $Fid=$row['Fid'];
           
           //echo $Fid;
           $theoryquery="select * from faculty where Fid='$Fid'";
           $theoryres=mysqli_query($conn,$theoryquery);
           $theorycol=mysqli_fetch_array($theoryres);
           $theorynum=$theorycol['Theory'];
           //echo $theorynum;

           

           $allocatedquery="select * from tempallocationedit where FacultyID='$Fid'";
           $allocatedres=mysqli_query($conn,$allocatedquery);
           $allocatedsub=mysqli_fetch_array($allocatedres);

           $alloccountquery="select count(*) as count from tempallocation where FacultyID='$Fid'";
           $alloccountres=mysqli_query($conn,$alloccountquery);
           $alloccountcol=mysqli_fetch_array($alloccountres);
           $alloccount=$alloccountcol['count'];
           if (!$alloccount){
             $alloccount=1;
           }
           

         
         ?>
         
         <tr>                                        
         <td rowspan="<?php echo $alloccount;?>"><?php echo $row['Priority'];?></td>
         <td rowspan="<?php echo $alloccount;?>"><?php echo $row['FName'];?>
         <?php if($itercount>4){?>
           <input name="<?php echo $Fid; ?>" type='submit' value='Edit'>
           <?php }?>
         </td>
         <td><?php if ($allocatedsub) {
           $allocatedsubcode=$allocatedsub['CourseID'];
           $allocatedsubprogram=$allocatedsub['Program'];
            $allocatedsubnamequery="select * from subjects where CourseCode='$allocatedsubcode' and Program='$allocatedsubprogram'";
           
           $allocatedsubnameres=mysqli_query($conn,$allocatedsubnamequery);
           $allocatedsubnamecol=mysqli_fetch_array($allocatedsubnameres);
           $allocatedsubname=$allocatedsubnamecol['CourseName'];
           $allocatedsubsem=$allocatedsubnamecol['Semester'];
           $allocatedsubprogram=$allocatedsubnamecol['Program'];
           echo $allocatedsubsem.' '.$allocatedsubprogram.' : '.$allocatedsubname;
         }
         else {
           echo "-";
         }?> </td>
         </tr>
         <script>
          

<?php 
           while($allocatedsub=mysqli_fetch_array($allocatedres))
           {?>
             document.write(`
             <tr>

             <td><?php if ($allocatedsub) {
           $allocatedsubcode=$allocatedsub['CourseID'];
           $allocatedsubnamequery="select * from subjects where CourseCode='$allocatedsubcode'";
          
          $allocatedsubnameres=mysqli_query($conn,$allocatedsubnamequery);
          $allocatedsubnamecol=mysqli_fetch_array($allocatedsubnameres);
          $allocatedsubname=$allocatedsubnamecol['CourseName'];
          $allocatedsubsem=$allocatedsubnamecol['Semester'];
          $allocatedsubprogram=$allocatedsubnamecol['Program'];
          echo $allocatedsubsem.' '.$allocatedsubprogram.' : '.$allocatedsubname;
         
         } 
         else {
           echo "-";
         }?>
          </td>
             </tr>`
             )
             
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

       $unallocsubquery="select * from subjects where (CourseCode,Program) not in (select CourseID,Program from tempallocationedit) and Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
       $unallocsubres=mysqli_query($conn,$unallocsubquery);
       $unallocrows=mysqli_num_rows($unallocsubres)


         ?>
         
         
         <?php
         if ($unallocrows>0)
         {
         while ($unallocsub=mysqli_fetch_array($unallocsubres))
         {
         ?>
         <tr>
            <td><?php echo $i; $i++ ?></td>
            <td><?php echo $unallocsub['Semester'];?></td>
            <td><?php echo $unallocsub['Program'];?></td>                                        
            <td><?php echo $unallocsub['CourseCode'];?></td>
            <td><?php echo $unallocsub['CourseName'];?></td>
         </tr>
         <?php }}
         else{?>
         <tr>
            <td style="text-align:center">-</td>
            <td>-</td>
            <td>-</td>                                        
            <td>-</td>
            <td>-</td>
         </tr>
         <?php }?>
       </table>

    <?php }

function allocsubmit()
{
  global $conn;
    $duplicatecheckquery="SELECT CourseID,COUNT(CourseID) as coursecount,Program,COUNT(Program) as programcount FROM tempallocationedit GROUP BY CourseID,Program HAVING count(CourseID)>1 and count(Program)>1;";
    $duplicatecheckqueryres=mysqli_query($conn,$duplicatecheckquery);
    $duplicaterowcount= mysqli_num_rows($duplicatecheckqueryres);
    $unallocsubquery="select * from subjects where (CourseCode,Program) not in (select CourseID,Program from tempallocation) and Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
    $unallocsubres=mysqli_query($conn,$unallocsubquery);
    $unallocrows=mysqli_num_rows($unallocsubres);

    if ($duplicaterowcount>0){
      echo "<script>window.alert('Duplicate Values Present!')</script>";
      displayafteredit();
      
      }
   
      else if ($unallocrows>0)
        {
          echo "<script>window.alert('Unallocated Subjects Present!')</script>";
          displayafteredit();
        }
        else{
          $submitinsertquery="Insert into subjectallocation (FacultyID,CourseID,AllocationType,Semester,Program,EffectiveDate) (select (FacultyID,CourseID,AllocationType,Semester,Program,EffectiveDate) from tempallocationedit";
          $submitinsertqueryres=mysqli_query($conn,$submitinsertquery);
        }


}

 ?>


 