<?php
#

#
  session_start();
   if ( !$_SESSION['user']['id'] ) {
      // If the user tries to change the url path to an inside-account page without being logged in,
      // It will redirect the user to login page as long as the user is not logging in
      header('location: forbidden.php?attempt=failed');
   }
   // The sessions that you're seeing below are the sessions you created in login controller page
   // T
?>
<style>
#register{
    background:#b5e3de;
   
}
td{
     
      border-bottom: 2px solid black;
      border-left:2px solid black;
      border-right:2px solid black;
      
    }
   #design {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#design td, #design th {
    border: 1px solid #ddd;
    padding: 8px;
}

#design tr:nth-child(even){background-color: #f2f2f2;}

#design tr:hover {background-color: #ddd;}

#design th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Trees Data</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="jquerytable/css/dataTables.bootstrap.min.css">
</head>
<script src="js/jquery.min.js"></script>
    <script src="jquerytable/js/jquery.dataTables.min.js"></script>
    <script src="jquerytable/js/dataTables.bootstrap.min.js"></script>
<body>
  <button class="btn btn-warning"><a href="adminpage.php">ADMIN</a></button>
<button class="btn btn-danger float-right"><a href="logout.php">LOGOUT</a></button>

    <div class="container-fluid" style="margin-top: 20px">
        <div class="row">
            <div class="col-md-12">
                <table id="design" class="  table-hover">
                    <thead>
                  <tr>
                    <th>TREE NO</th>
                    <th>SPECIES</th>
                    <th>LOCATION</th>
                    <th>TREE HEIGHT</th>
                    <th>DIAMETER</th>
                    <th>MERCHANTABLE HEIGHT</th>
                    <th>VOLUME HEIGHT</th>
                    <th>GPS READING</th>
                    <th>TREE CATEGORY</th>
                    <th>DATE PLANTED</th>
                    <th>DATE DISCOVER</th>
                    <th>NAME OF HOLDER</th>
                    <th>TREE HEALTH </th>
                    <th>CODE</th>
                    <th>REMARK</th>
                    <th>YEAR PLANTED</th>
                    <th>YEAR DISCOVER</th>
                    <th>ACTION</th>
                    <th>REMOVE</th>
                    
                  </tr>
                </thead>
 <?php  
      include '../models/config.php';
     
      // $stmt=$db_conn->prepare('select timestampdiff(YEAR,date_planted,NOW()) as year  from treemap_marker');
    
    
      
      $stmt=$db_conn->prepare('SELECT * FROM gps_data');
          $stmt->execute();
          if($stmt->rowCount()>0)
          {
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
              
                  ?>
                 
            
    <tbody>
          <td><?php echo $row['gps_id'];?></td>
         
        <td ><?php echo $row['species_name']; ?></td>
        <td><?php
              if($row['location']=="others"){
               echo  $row['sub_location'];

              }
              else{

                 echo $row['location'];

              }
        


        ?></td>
      <td><?php echo $row['tree_height'];?></td>
      <td><?php echo $row['dba'];?></td>
      <td><?php echo $row['mh'];?></td>
      <td><?php echo $row['volume'];?></td>
      <td>
        <?php 
            if($row['gps']=="degrees"){

                echo $row['degreelat'].'-'. $row['degreelong'];


            }
            if($row['gps']=="decimal"){
              echo $row['latdecimal'].'-'. $row['longdecimal'];

            }

        
         ?>



         </td>
      <td><?php echo $row['tree_category'];?></td>
      <td><?php echo $row['date_planted']?></td>
      <td><?php echo $row['date_discover']?></td>
      <td><?php echo $row['holder'];?></td>
      <td><?php echo $row['tree_health'];?></td>
      <td><?php echo $row['code'];?></td>
      <td><?php

            if($row['remark']=="others"){
               echo $row['other_remark'];
            }
            else{
              echo $row['remark'];
            }
      

       ?></td>
      <td><?php 
      if($row['tree_category']=="planted"){
         $data=$row['date_planted'];
       $bday = new DateTime($data); // Your date of birth
       $today = new Datetime(date('m/d/y'));
       $diff = $today->diff($bday);
       printf(' AGE : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
       
      }
      else{
        echo "";
      }
      
      ?></td>

       <td><?php 
       if($row['tree_category']=="natural"){
            $data=$row['date_discover'];
       $bday = new DateTime($data); // Your date of birth
       $today = new Datetime(date('m/d/y'));
       $diff = $today->diff($bday);
       printf(' AGE : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
       

       }
       else{
        echo "";
       }
     
      ?></td>
    <td><a class="btn btn-info" href="edittingdatatree.php?edit_id=<?php echo $row['gps_id']?>" title="click for edit" onclick="return confirm('Sure to edit this record')"><span class="glyphicon glyphicone-edit"></span>Edit</a>
    </td>
    <td><a class="btn btn-danger" href="?delete_id=<?php echo $row['gps_id']?>" title="click for delete" onclick="return confirm('Sure to delete this record?')">Delete</a> </td>
   
   </tbody>            
  
   <?php 

}
}

?>
     </table> 
         
        
      <?php

     include '../models/config.php';
     
      

    $stmt = $db_conn->prepare("SELECT SUM(volume) AS total FROM gps_data");
$stmt->execute();

while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $total=$row['total'];
}
?>
     <table>
          <th>SUB TOTAL</th>
          <td style="position:relative;left:35.5vw;"><b><?php 
          echo $total;
          ?></b></td>
     
     </table>
     <form method="post" action="excel.php">
     <input type="submit" name="export" class="btn btn-success float-right" value="EXPORT TO EXCEL" />
    </form>
    <!-- <form method="post" action="import.php">
     <input style="position: relative; top: -2.3vh;" type="submit" name="import" class="btn btn-success float-right" value="IMPORT CSV FILE" />
    </form>
 -->
    
   </div>
      <?php 
  include("../models/config.php");
  if(isset($_GET['delete_id']))
  {
    //to delete your data you  need to fetch before you drop use array and bindvalues or bindparam
    $stmt_select=$db_conn->prepare('SELECT * FROM gps_data WHERE gps_id=:uid');
    $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
    
    
    $stmt_delete=$db_conn->prepare('DELETE FROM gps_data WHERE gps_id =:uid');
    $stmt_delete->bindParam(':uid', $_GET['delete_id']);
    if($stmt_delete->execute())
    {
      ?>
      <script>
      alert("DATA HAS BEEN DELETED SUCCESSFULLY");
      window.location.href=('showingdata.php');
      </script>
      <?php 
    }else 

    ?>
      <script>
      alert("YOUR FILE DOESNT DELETE BECAUSE WE ENCOUNTERED ERROR");
      window.location.href=('showingdata.php');
      </script>
      <?php 

  }

  ?>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".table").DataTable({
                "ordering": true,
                "searching": true,
                "paging": true,
               
            });
        });
    </script>
</body>
</html>