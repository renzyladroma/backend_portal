<?php
include('../functions/dbconnection.php');
session_start();
$sub_category_id_fk = $_REQUEST['sub_category_id_fk'];
$content = $_REQUEST['content'];
$publish_date = $_REQUEST['publish_date'];
$publish_time = $_REQUEST['publish_time'];
$date_created = date('Y-m-d');
$created_by	= $_SESSION['id'];

$sql = "INSERT INTO tbl_content (sub_category_id_fk, content, publish_date, publish_time, date_created, created_by)
						VALUES ('$sub_category_id_fk','$content','$publish_date','$publish_time','$date_created', '$created_by')";
mysqli_query($con, $sql) or die(mysqli_error($con));

echo json_encode(array("status" => TRUE));




?>