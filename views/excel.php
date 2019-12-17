<style>
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
<?php  
//export.php  
include '../models/config.php';

if(isset($_POST["export"]))
{

$stmt=$db_conn->prepare('SELECT * FROM gps_data');
$stmt->execute();
if($row=$stmt->rowCount()>0){
   ?> 
  
<table class="table" id="design bordered="1"> 
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
                                       
                    
                    
                  </tr>
                </thead>
              <?php  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
                    
                    <tr>  
               
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

                
       


 </td></tr> 
             <?php   }?>
                </table>
      <?php       
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=treedata.xls');

}
}
?>
