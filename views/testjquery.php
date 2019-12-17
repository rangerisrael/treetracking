<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>JQUERY TABLE</title>
</head>
<body>
    <div class="container">
            <div class="row">
            <div class="col-md-8 col-md-offset-2">
            
            <table class="table table-bordered hover">
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
                    <th>NAME OF HOLDER</th>
                    <th>TREE HEALTH </th>
                    <th>CODE</th>
                    <th>REMARK</th>
                    <th>YEAR</th>
                    <th>ACTION<th>
                    
                  </tr>
                
                
                </thead>
            
            
            
            
            
            </table>
            <tbody>
            
            <?php  
      include '../models/config.php';
     
      // $stmt=$db_conn->prepare('select timestampdiff(YEAR,date_planted,NOW()) as year  from treemap_marker');
    
    
      
      $stmt=$db_conn->prepare('SELECT * FROM treemap_marker');
          $stmt->execute();
          if($stmt->rowCount()>0)
          {
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
              
                  ?>
                <td><?php echo $row['marker_id'];?></td>
         
         <td ><?php echo $row['species']; ?></td>
         <td><?php echo $row['location'];?></td>
       <td><?php echo $row['tree_height'];?></td>
       <td><?php echo $row['dba'];?></td>
       <td><?php echo $row['mh'];?></td>
       <td><?php echo $row['volume'];?></td>
       <td><?php echo $row['coord_latitude'].'-'. $row['coord_longitude'] ?> </td>
       <td><?php echo $row['tree_category'];?></td>
       <td><?php echo $row['date_planted']?></td>
       <td><?php echo $row['owner_tree'];?></td>
       <td><?php echo $row['tree_health'];?></td>
       <td><?php echo $row['stem_quality_code'];?></td>
       <td><?php echo $row['remarks'];?></td>
       <td><?php 
        $data=$row['date_planted'];
        $bday = new DateTime($data); // Your date of birth
        $today = new Datetime(date('m/d/y'));
        $diff = $today->diff($bday);
        printf(' AGE : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
        
       ?></td>
     <td><a class="btn btn-info" href="edittreedata.php?edit_id=<?php echo $row['marker_id']?>" title="click for edit" onclick="return confirm('Sure to edit this record')"><span class="glyphicon glyphicone-edit"></span>Edit</a></td>
       <td><a class="btn btn-danger" href="?delete_id=<?php echo $row['marker_id']?>" title="click for delete" onclick="return confirm('Sure to delete this record?')">Delete</a></td>
       
            
            
            
            
            
            
            
            </tbody>
            
            <?php 

}
}

?>

</table>    
            
            
            
            </div>
            
            
            
            
            </div>
    
    
    </div>
</body>
</html>