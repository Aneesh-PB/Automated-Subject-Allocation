

<?php
include("config.php");
$itercount=1;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Faculty Load Allocation</title>
    </head>
    
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
        <form action = "" method = "POST">
    <input type = "submit" value="Next" name = "Nextiteration" onclick="nextiter()">
           <input type = "submit" name = "submit">
           </form>

        
                
                <?php
                // First iteration

                $subcountquery="select count(*) as count from subjects";
                $subcountres=mysqli_query($conn,$subcountquery);
                $subcountarray=mysqli_fetch_array($subcountres);
                $subcount=$subcountarray['count'];

                $selectedsubcountquery="select count(distinct Course_code) as count from selected_subjects";
                $selectedsubcountres=mysqli_query($conn,$selectedsubcountquery);
                $selectedsubcountarray=mysqli_fetch_array($selectedsubcountres);
                $selectedsubcount=$selectedsubcountarray['count'];
                //echo $selectedsubcount;

                $delquery="delete from tempallocation";
                $resu=mysqli_query($conn,$delquery);
                $query="select * from faculty order by priority";
                $resu=mysqli_query($conn,$query);
                $i=0;
                $j=1000;
                
                $subarray=array();
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
                  

                  while ($subcol=mysqli_fetch_array($subres))
                    {
                        
                        $sub=$subcol['Course_name'];
                        $subid=$subcol['Course_code'];
                        if (!(in_array($subid,$subarray)) && $allocationcount<1)
                        {
                            //echo "1";
                            array_push($subarray,$subid);
                            $inquery="insert into tempallocation (FacultyID,CourseID,AllocationType) values('$Fid','$subid','Theory')";
                            $inqueryres=mysqli_query($conn,$inquery);
                            $allocationcount++;

                        }

                    }
                }

                

                    // First iteration ends
                    // second iteration
            //     while (count($subarray)<$selectedsubcount)
            //     {

            //     $query="select * from faculty order by priority desc";
            //     $resu=mysqli_query($conn,$query);
            //     $i=0;
            //     $j=1000;
                
            //     //$subarray=array();
            //     while($row=mysqli_fetch_array($resu)){
            //       $allocationcount=0;
            //       ++$i;
            //       ++$j;
            //       $Fid=$row['Fid'];
                  
            //       //echo $Fid;
            //       $theoryquery="select * from faculty where Fid='$Fid'";
            //       $theoryres=mysqli_query($conn,$theoryquery);
            //       $theorycol=mysqli_fetch_array($theoryres);
            //       $theorynum=$theorycol['Theory'];
            //       //echo $theorynum;

            //       $subquery="select * from selected_subjects where FID='$Fid' order by Pref";
            //       $subres=mysqli_query($conn,$subquery);
                  

            //       while ($subcol=mysqli_fetch_array($subres))
            //         {
                        
            //             $sub=$subcol['Course_name'];
            //             $subid=$subcol['Course_code'];
            //             if (!(in_array($subid,$subarray)) && $allocationcount<1)
            //             {
            //                 //echo "1";
            //                 array_push($subarray,$subid);
            //                 $inquery="insert into tempallocation (FacultyID,CourseID,AllocationType) values('$Fid','$subid','Theory')";
            //                 $inqueryres=mysqli_query($conn,$inquery);
            //                 $allocationcount++;

            //             }

            //         }

            //     }
            //   }

            //   echo count($subarray)." ".$subcount;

            //   //Uallocated subjects:

            //   while (count($subarray)<$subcount)
            //     {

            //     $query="select * from faculty order by priority desc";
            //     $resu=mysqli_query($conn,$query);
            //     $i=0;
            //     $j=1000;
                
            //     //$subarray=array();
            //     while($row=mysqli_fetch_array($resu)){
            //       $allocationcount=0;
            //       ++$i;
            //       ++$j;
            //       $Fid=$row['Fid'];
                  
            //       //echo $Fid;
            //       $theoryquery="select * from faculty where Fid='$Fid'";
            //       $theoryres=mysqli_query($conn,$theoryquery);
            //       $theorycol=mysqli_fetch_array($theoryres);
            //       $theorynum=$theorycol['Theory'];
            //       //echo $theorynum;

            //       $subquery="select * from subjects";
            //       $subres=mysqli_query($conn,$subquery);

            //       $facultysubcountquery="select count(*) as count from tempallocation where FacultyID='$Fid'";
            //       $facultysubcountres=mysqli_query($conn,$facultysubcountquery);
            //       $facultysubcountcol=mysqli_fetch_array($facultysubcountres);
            //       $facultysubcount=$facultysubcountcol['count'];
            //       //echo $facultysubcount;

            //       while ($subcol=mysqli_fetch_array($subres))
            //         {
                        
            //             $sub=$subcol['CourseName'];
            //             $subid=$subcol['CourseCode'];
            //             if (!(in_array($subid,$subarray)) && $allocationcount<1 && $facultysubcount<=$theorynum)
            //             {
            //                 //echo "1";
            //                 array_push($subarray,$subid);
            //                 $inquery="insert into tempallocation (FacultyID,CourseID,AllocationType) values('$Fid','$subid','Theory')";
            //                 $inqueryres=mysqli_query($conn,$inquery);
            //                 $allocationcount++;

            //             }

            //         }

            //     }
            //     echo count($subarray)." ".$subcount;
            //   }

            //   //Uallocated subjects additional one:

            //   while (count($subarray)<$subcount)
            //     {

            //     $query="select * from faculty order by priority desc";
            //     $resu=mysqli_query($conn,$query);
            //     $i=0;
            //     $j=1000;
                
            //     //$subarray=array();
            //     while($row=mysqli_fetch_array($resu)){
            //       $allocationcount=0;
            //       ++$i;
            //       ++$j;
            //       $Fid=$row['Fid'];
                  
            //       //echo $Fid;
            //       $theoryquery="select * from faculty where Fid='$Fid'";
            //       $theoryres=mysqli_query($conn,$theoryquery);
            //       $theorycol=mysqli_fetch_array($theoryres);
            //       $theorynum=$theorycol['Theory'];
            //       //echo $theorynum;

            //       $subquery="select * from subjects";
            //       $subres=mysqli_query($conn,$subquery);

            //       $facultysubcountquery="select count(*) as count from tempallocation where FacultyID='$Fid'";
            //       $facultysubcountres=mysqli_query($conn,$facultysubcountquery);
            //       $facultysubcountcol=mysqli_fetch_array($facultysubcountres);
            //       $facultysubcount=$facultysubcountcol['count'];
            //       echo $facultysubcount;

            //       while ($subcol=mysqli_fetch_array($subres))
            //         {
                        
            //             $sub=$subcol['CourseName'];
            //             $subid=$subcol['CourseCode'];
            //             if (!(in_array($subid,$subarray)) && $allocationcount<1 && $facultysubcount<=$theorynum)
            //             {
            //                 //echo "1";
            //                 array_push($subarray,$subid);
            //                 $inquery="insert into tempallocation (FacultyID,CourseID,AllocationType) values('$Fid','$subid','Theory')";
            //                 $inqueryres=mysqli_query($conn,$inquery);
            //                 $allocationcount++;

            //             }

            //         }

            //     }
            //   }


              

                
                
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


    function display()
    {
      
      
      global $conn;         
      global $itercount;
      ?>

      <h3>Iteration <?php echo $itercount++; ?></h3>
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
         <td rowspan="<?php echo $alloccount;?>"><?php echo $row['FName'];?></td>
         <td><?php if ($allocatedsub) {
           $allocatedsubcode=$allocatedsub['CourseID'];
            $allocatedsubnamequery="select CourseName from subjects where CourseCode='$allocatedsubcode'";
           
           $allocatedsubnameres=mysqli_query($conn,$allocatedsubnamequery);
           $allocatedsubnamecol=mysqli_fetch_array($allocatedsubnameres);
           $allocatedsubname=$allocatedsubnamecol['CourseName'];
           echo $allocatedsubname;
         }
         else {
           echo "-";
         }?> </td>
         </tr>
         <script>
           var i=1

<?php 
           while($allocatedsub=mysqli_fetch_array($allocatedres))
           {?>
             document.write(`
             <tr>

             <td><?php if ($allocatedsub) {
           $allocatedsubcode=$allocatedsub['CourseID'];
            $allocatedsubnamequery="select CourseName from subjects where CourseCode='$allocatedsubcode'";
       
           $allocatedsubnameres=mysqli_query($conn,$allocatedsubnamequery);
           $allocatedsubnamecol=mysqli_fetch_array($allocatedsubnameres);
           $allocatedsubname=$allocatedsubnamecol['CourseName'];
           echo $allocatedsubname;
         
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

       $unallocsubquery="select * from subjects where CourseCode not in (select CourseID from tempallocation) and Type='CORE'and Semester in ('S1','S3','S5','S7','M1','M3')";
       $unallocsubres=mysqli_query($conn,$unallocsubquery);


         ?>
         
         
         <?php
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
         <?php }?>
       </table>

    <?php } ?>

    <script>
        
    function nextiter()
    {
      
      document.body.innerHTML="";
      document.write(`
      <html>
    <head>
        <title>Faculty Load Allocation</title>
        
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
        background-color: lightblue;
        padding-left: 2%;
        line-height: 50px;
        margin-bottom: 10px;
      }

      #nav-div {
        width: 100%;
        min-height: 30px;
        background-color: lightblue;
        text-align: center;
        line-height: 30px;
        margin-bottom: 10px;
      }

      #header-banner-div {
        width: 100%;
        min-height: 100px;
        background-color: lightblue;
        text-align: center;
        line-height: 100px;
        margin-bottom: 10px;
        font-weight: bold;
      }

      #main-div {
        width: 100%;
        margin-bottom: 10px;
      }

      #sidebar-div {
        width: 20%;
        min-height: 400px;
        background-color: lightblue;
        float: left;
        text-align: center;
        line-height: 70px;
      }

      #bodyarea-div {
        width: 75%;
        min-height: 400px;
        background-color: lightblue;
        float: right;
        text-align: center;
        line-height: 50px;
      }

      .clearfix::after {
        content: "";
        display: block;
        clear: both;
      }

      #footer-div {
        width: 100%;
        min-height: 50px;
        background-color: lightblue;
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

      <div id="nav-div">Navigation</div>

      <div id="header-banner-div">Faculty Load Allocation</div>

      <div id="main-div" class="clearfix">
        <div id="sidebar-div"> 
        <button onclick="document.location='flolad1.php'">Subject Allocation</button>
        <button onclick="document.location='fload.php'">Edit Allocation</button>
        <button onclick="document.location='currallo.php'">Current Allocation</button>
        </div>
        <div id="bodyarea-div">

        
        <form action = "" method = "POST">
        <input type = "submit" value="Next" name = "Nextiteration" >
        <input type = "submit" name = "submit">
        </form>
        
        
        <?php
        
        global $conn;
        global $subarray;
        global $selectedsubcount;

           

                  // echo"subarray:".count($subarray);
                  // echo"selectedsub:".$selectedsubcount;

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

                        echo $alloccount.' '.$theorynum.'\n';
                        
                        if (!(in_array($subid,$subarray)) && ($allocationcount==0) && ($alloccount<$theorynum) )
                        {
                            
                            array_push($subarray,$subid);
                            $inquery="insert into tempallocation (FacultyID,CourseID,AllocationType) values('$Fid','$subid','Theory')";
                            $inqueryres=mysqli_query($conn,$inquery);
                            $allocationcount++;
                            $alloccount++;
                            //echo $Fid.' '.$allocationcount;

                        }

                    }

                
              }
            

            //Display 

            display();
            ?>
            
            
           </div>
            </div>   
    </div>

    
    <div id="footer-div">Footer</div>
        
    </body>

    </html>`)



    }
</script>
