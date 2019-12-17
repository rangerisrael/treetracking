<?php 
require_once '../models/config.php';
			$stmt=$db_conn->prepare('SELECT * FROM postdata ORDER BY post_id DESC');
				$stmt->execute();
				if($stmt->rowCount()>0)
				{
					while($row=$stmt->fetch(PDO::FETCH_ASSOC))
					{
						extract($row);
					}
				}
	?>

<?php
$stmt=$db_conn->prepare('SELECT * FROM postdata ORDER BY post_id DESC');
$stmt->execute();
if($stmt->rowCount()>0)
{
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
    }
}
?>
<!-- delete script -->
<?php 

	if(isset($_GET['delete_id']))
	{
		$stmt_select=$db_conn->prepare('SELECT * FROM postdata WHERE post_id=:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("uploads/".$imgRow['photo']);
		$stmt_delete=$db_conn->prepare('DELETE FROM postdata WHERE post_id =:uid');
		$stmt_delete->bindParam(':uid', $_GET['delete_id']);
		if($stmt_delete->execute())
		{
			?>
			<script>
			alert("You are deleted one item");
			window.location.href=('modifypost.php');
			</script>
			<?php 
		}else 

		?>
			<script>
			alert("Can not delete item");
			window.location.href=('modifypost.php');
			</script>
			<?php 

	}

	?>