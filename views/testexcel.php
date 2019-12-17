<?php  
      include '../models/config.php';
     
    //   $stmt=$db_conn->prepare('select timestampdiff(YEAR,date_planted,NOW()) as AGE  from treemap_marker');
    //  $test=$stmt->execute();
 
     
    
      
      $stmt=$db_conn->prepare('SELECT * FROM treemap_marker');
          $stmt->execute();
          if($stmt->rowCount()>0)
          {
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
              
                  ?>
                 
            
    
        <td>
          <?php echo $row['marker_id'];?>
          </td>
         
        <td ><?php echo $row['species']; ?></td>
        <td><?php echo $row['location'];?></td>
      <td><?php echo $row['tree_height'];?></td>
      <td><?php echo $row['dba'];?></td>
      <td><?php echo $row['mh'];?></td>
      <td><?php echo $row['volume'];?></td>
      <td><?php echo $row['coord_latitude'].'-'. $row['coord_longitude'] ?> </td>
      <td><?php echo $row['date_planted']?></td>
      <td><?php echo $row['owner_tree'];?></td>
      <td><?php echo $row['tree_health'];?></td>
      <td><?php echo $row['stem_quality_code'];?></td>
      <td><?php echo $row['remarks'];?></td>
      <td>
      <?php 
       $data=$row['date_planted'];
       $bday = new DateTime($data); // Your date of birth
       $today = new Datetime(date('m/d/y'));
       $diff = $today->diff($bday);
       printf(' AGE : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
       
      ?>
 
           <?php 
 header('Content-Type: application/xls');
 header('Content-Disposition: attachment; filename=treedata.xls');

          }
      }
     
      ?>
     
     </table>