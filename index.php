<?php  

	session_start();
	include 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Age Profile</title>
	 <link href="dist/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>

<div class="container">
	

	<div class="row">
	<div class="col-md-12 text-center border-bottom border-3">
		<h1 class="m-0 p-0"><b>BARANGAY MINI PROFILING SYSTEM </b></h1>
	</div>
	<div class="col-md-6 mt-3">
			<?php 
	if(isset($_SESSION['set'])){
		?>
		<div class="alert alert-success mb-3 mt-3">New Profile Added!</div>
		<?php
	}
	if(isset($_SESSION['delete'])){
		?>
		<div class="alert alert-success mb-3 mt-3"><?=$_SESSION['delete']?></div>
		<?php
	}
	?>
	<form class="" method="POST" action="core.php">
		<label>Purok</label>
		<select  class="form-select" name="purok" required>
			<option value="<?=isset($_SESSION['purok'])?$_SESSION['purok']:''?>" selected ><?=isset($_SESSION['purok'])?$_SESSION['purok']:'Select....'?></option>
			<option value="" disabled>Select...</option>
			<option value="Purok 1A">Purok 1A</option>
			<option value="Purok 1B">Purok 1B</option>
			<option value="Purok 2A">Purok 2A</option>
			<option value="Purok 2B">Purok 2B</option>
			<option value="Purok 3">Purok 3</option>
			<option value="Purok 4A">Purok 4A</option>
			<option value="Purok 4B">Purok 4B</option>
			<option value="Purok 5A">Purok 5A</option>
			<option value="Purok 5B">Purok 5B</option>
			<option value="Purok 6A">Purok 6A</option>
			<option value="Purok 6B">Purok 6B</option>
			<option value="Purok 7A">Purok 7A</option>
			<option value="Purok 7B">Purok 7B</option>
			
		</select>
		<label>Name</label>
		<input type="text" name="name" class="form-control" required>
		<label>Age</label>
		<input type="number" name="age" id="age" class="form-control" required>
		<label>Gender</label>
		<div class="form-check">
			  <input class="form-check-input" type="radio" name="gender"  value="Male" id="flexRadioDefault1">
			  <label class="form-check-label" for="flexRadioDefault1">
			   Male
			  </label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="gender" value="Female" id="flexRadioDefault2" checked>
			  <label class="form-check-label" for="flexRadioDefault2">
			   Female
			  </label>
			</div>
			<button class="btn w-100 btn-primary mt-2" type="submit" name="details">Submit</button>
	</form>
	


  <div class="container mt-4" style="height: 300px; overflow-y: scroll;">
	<table class="table" >
		<thead>
			<tr>
				<th>Name</th>
				<th>Purok</th>
					<th>Gender</th>
						<th>Age</th>
							<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if(isset($_SESSION['purok'])){
					$sql = "SELECT * FROM details where purok = '".$_SESSION['purok']."'  ORDER BY data_no DESC ";
					$res = mysqli_query($conn, $sql);
					if(mysqli_num_rows($res)>0){
						while($row = mysqli_fetch_array($res)){
							?>
							<tr>
								<td><?=$row['name']?></td>
								<td><?=$row['purok']?></td>
								<td><?=$row['gender']?></td>
								<td><?=$row['age']?></td>
								<td>
									<button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal-<?=$row['data_no']?>"  class="btn btn-danger"> Delete</button>
								</td>
							</tr>

							<div class="modal fade" id="deleteModal-<?=$row['data_no']?>"  data-bs-backdrop="static" data-bs-keyboard="false">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Delete</h4>
											<button class="btn-close" type="button" data-bs-dismiss="modal"></button>
										</div>
										<div class="modal-body text-center">
											<form class="" action="core.php" method="POST">
												<h5>Are you sure to delete this data?</h5>
												<button class="btn btn-primary w-50" type="submit" name="delete-btn" value="<?=$row['data_no']?>">Yes</button>
											</form>
										</div>
									</div>
								</div>
								
							</div>

							<?php
						}
					}
			}
		

			?>
		</tbody>

	</table>
	
</div>



	</div>
	<div class="col-md-6 mt-3">

<div class=" mt-5 mb-4">
	<h4>Count by Specific Age</h4>

	<div class="row">
		<div class="col-md-6">
		<h4>Male</h4>	
		<div class="row">
		<div class="col-md-6">Age</div>
		<div class="col-md-4">Count</div>
	 <?php 
	 	$male=0;
	 	if(isset($_SESSION['purok'])){
	 	
		 $sql = "SELECT  DISTINCT age  from details where purok = '".$_SESSION['purok']."'  ORDER BY age ASC ";
					$res = mysqli_query($conn, $sql);
					if(mysqli_num_rows($res)>0){
						while($row = mysqli_fetch_array($res)){
							?>
							
							<?php
								$age=0;
								$sql = "SELECT * FROM details where purok = '".$_SESSION['purok']."' and age='".$row['age']."' and gender='Male' ";
									$res2 = mysqli_query($conn, $sql);
									if(mysqli_num_rows($res2)>0){
										while($row2 = mysqli_fetch_array($res2)){
											$age++;
											$male++;
										}
									?>
										<div class="col-md-6"><?=$row['age']?></div>
										<div class="col-md-4"><?=$age?></div>
										<?php
									}
							
						}
					
			}
		}

	 ?>
	  <div class="col-md-6 bg-dark text-light ">Total</div>
      <div class="col-md-4 bg-dark text-light "><?=$male?></div>
</div>

		</div>

		<div class="col-md-6">
			<h4>Female</h4>	
	<div class="row">
		<div class="col-md-6">Age</div>
		<div class="col-md-4">Count</div>
	 <?php 
	  $female=0;
	 	if(isset($_SESSION['purok'])){
	 	
		 $sql = "SELECT  DISTINCT age  from details where purok = '".$_SESSION['purok']."'  ORDER BY age ASC ";
					$res = mysqli_query($conn, $sql);
					if(mysqli_num_rows($res)>0){
						while($row = mysqli_fetch_array($res)){
							?>
							
							<?php
								$age=0;
								$sql = "SELECT * FROM details where purok = '".$_SESSION['purok']."' and age='".$row['age']."' and gender='Female' ";
									$res2 = mysqli_query($conn, $sql);
									if(mysqli_num_rows($res2)>0){
										while($row2 = mysqli_fetch_array($res2)){
											$age++;
											$female++;
										}
											?>
										<div class="col-md-6"><?=$row['age']?></div>
										<div class="col-md-4"><?=$age?></div>
										<?php
									}
							
						}
					
			}
		}

	 ?>
	 <div class="col-md-6 bg-success text-light">Total</div>
      <div class="col-md-4 bg-success text-light"><?=$female?></div>
</div>

		</div>
	</div>




	</div>			






</div>
	
</div>


 <script src="dist/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 <script src="dist/jquery.min.js"></script>
 <script >
 	$(function(){
		$(document).on('keyup blur','#age', function(){
			var node = $(this);
		   node.val(node.val().replace(/[^0-9]/g,''));
		})
	})
 </script>
<?php 
	
	if(isset($_SESSION['set'])){
		?>
		
<script type="text/javascript">		
	$(function(){
		setTimeout(()=>{
			$('.alert').hide();
		},4000)
	})
</script> 
		<?php

	}unset($_SESSION['set']);	
	if(isset($_SESSION['delete'])){
		?>
		
<script type="text/javascript">		
	$(function(){
		setTimeout(()=>{
			$('.alert').hide();
		},4000)
	})
</script> 
		<?php
		
	}unset($_SESSION['delete']);	


 ?>	


</body>
</html>