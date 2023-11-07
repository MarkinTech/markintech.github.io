<?php 
session_start();
include 'dbconnect.php';


if(isset($_POST['details'])){
		$insert = "INSERT INTO details(name, purok, gender, age) VALUES('".ucwords(strtolower($_POST['name']))."','".$_POST['purok']."', '".$_POST['gender']."', '".$_POST['age']."')";
		if(mysqli_query($conn, $insert)){
			$_SESSION['purok'] = $_POST['purok'];
			$_SESSION['set'] = '200';
			header('location: index.php');
			
		}
	}

if(isset($_POST['delete-btn'])){
	$qry = "DELETE FROM details where data_no = '".$_POST['delete-btn']."'";
	if(mysqli_query($conn, $qry)){
			$_SESSION['delete'] ="Deleted Successfully!";
			header('location: index.php');
	}
}	
?>