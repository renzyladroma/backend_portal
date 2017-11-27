<?php
include('../dbconnection.php');
session_start();
  if (isset($_POST['id'])) {
	  $id = $_POST['id'];
	  $status = $_POST['status'];
	  $len = count($id);
	  $update_date = date('Y-m-d H:i:s');
	  $approved_by	= $_SESSION['id'];
	  
	  if(empty($id)){
		echo("You didn't select any records.");
	  } 
	  else{
		$N = count($id);
	 
		for($i=0; $i < $N; $i++)
		{
		  
		  $id_update = $id[$i];
		  $sql = "UPDATE tbl_ucontent SET status = '$status', date_updated = '$update_date', approved_by = '$approved_by'
				  WHERE id = $id_update ";
		  mysqli_query($con, $sql) or die(mysqli_error($con));
		}
		
		$key_list = "";
		$keyword_list = 0;
		for($x=0 ; $x < $len ; $x++)
		{
			$key_list .= $id[$x].',';
		}
		  $keyword_list = trim($key_list,",");
		  header("Location: ../../lotto_content.php?status=1&id=$keyword_list");
	  }
  }else{
	  header('Location: ../../lotto_content.php?status_error=1');
  }
?>