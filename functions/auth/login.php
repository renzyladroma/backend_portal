<?php
session_start();
include('../dbconnection.php');
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

$sql = "SELECT * FROM tbl_auth WHERE email = '".$email."' AND password = '".$password."' LIMIT 1;";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

if (mysqli_num_rows($result) > 0) {
	
	while ($row_user = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$_SESSION['id']			= $row_user['id'];
		$_SESSION['email']	= $row_user['email'];
		$_SESSION['first_name']	= $row_user['first_name'];
		$_SESSION['last_name']		= $row_user['last_name'];
	}
	
	//echo $_SESSION['id'];
	header('Location: ../../index.php');
} else {
	header('Location: ../../login.php?s='.base64_encode("failed"));
}

?>