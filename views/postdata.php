<?php
#
   include_once 'layout/header.php';
  
#
?>
<script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
	oFReader.onload = function (oFREvent) {
	document.getElementById("uploadPreview").src = oFREvent.target.result;
	};
	};
</script>
	
    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="POST" enctype="multipart/form-data">
	
<div class="panel-heading">
                        <h2 class="text-center">TREE TRACKING</h2>
</div>
	
						<div>
                           
							<table>
									<td><img id="uploadPreview" style=" margin-left:37vw;width:300px; height:150px;"   src="img/a.jpg" />
									<br/>  <!-- This is where the uploaded picture was placed -->
									<input id="uploadImage" style="margin-left:40vw;" type="file" name="myimage"  onchange="PreviewImage();"   accept="image/*" ></br>
									</td>
									<tr>
									<td><label for="nameotree" style="margin-left:30vw;">NAME OF TREE</label></td>
	<tr>
									<td><input type="text"style="margin-left:35vw; width:20vw;" name="" placeholder="TREE NAME" ></td>
							<tr>
							<td><label for="address" style="margin-left:30vw;">Location of tree</label></td>
	<tr>								
								<td> <select style="margin-left:40vw;">
                                       <option>MARIA AURORA</option>
                                       <option>BALER AURORA</option>
                                       <option>SAN LUSI AURORA</option>
                                       <option>DIPACULAO AURORA</option>
                                       <option>CASIGURAN AURORA</option>
                                       <option>DILASAG AURORA</option>
                                       
                                 </select></td>
	
								<tr>
							<td><label for="width" style="margin-left:30vw;">Width</label></td>
	<tr>
									<td><input type="number"style="margin-left:35vw; width:8vw;" name="" placeholder="tree width" ></td>
							<tr>
							<td><label for="height" style="margin-left:30vw;">Height</label></td>
	<tr>
									<td><input type="number"style="margin-left:35vw; width:8vw;" name="" placeholder="tree height" ></td>
							<tr>
							<td><label for="nameotree" style="margin-left:30vw;">Distance</label></td>

			<td> <select style="margin-left:-24vw;">
                                       <option>2KM</option>
                                       <option>3KM</option>
                                       <option>4km</option>
                                       <option>5km</option>
                                       <option>6km</option>
                                       <option>7km</option>
                                       
                                 </select></td>		
<tr>								 <td><button type="submit" name="register" class="btn btn-danger pull-right">SAVE</button></td>
                        <div class="clearfix"></div>
							</table>		
						
						
						</div>
						
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
     </form>