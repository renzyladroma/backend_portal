<?php
include('../functions/dbconnection.php');
session_start();
//$sub_category_id_fk = $_REQUEST['sub_category_id_fk'];
$content = $_REQUEST['sagitarrius'];
$content2 = $_REQUEST['scorpio'];
$content3 = $_REQUEST['libra'];
$content4 = $_REQUEST['virgo'];
$content5 = $_REQUEST['leo'];
$content6 = $_REQUEST['cancer'];
$content7 = $_REQUEST['gemini'];
$content8 = $_REQUEST['taurus'];
$content9 = $_REQUEST['aries'];
$content10 = $_REQUEST['pisces'];
$content11 = $_REQUEST['aquarius'];
$content12 = $_REQUEST['capricorn'];
$publish_date = $_REQUEST['publish_date'];
$date_created = date('Y-m-d');
$created_by	= $_SESSION['id'];

$sql = "INSERT INTO tbl_content (sub_category_id_fk, content, publish_date, date_created, created_by)
						VALUES ('19','$content','$publish_date','$date_created', '$created_by'),
							   ('18','$content2','$publish_date','$date_created', '$created_by'),
						       ('17','$content3','$publish_date','$date_created', '$created_by'),
						       ('16','$content4','$publish_date','$date_created', '$created_by'),
						       ('15','$content5','$publish_date','$date_created', '$created_by'),
						       ('14','$content6','$publish_date','$date_created', '$created_by'),
						       ('13','$content7','$publish_date','$date_created', '$created_by'),
						       ('12','$content8','$publish_date','$date_created', '$created_by'),
						       ('11','$content9','$publish_date','$date_created', '$created_by'),
						       ('10','$content10','$publish_date','$date_created', '$created_by'),
						       ('9','$content11','$publish_date','$date_created', '$created_by'),
						       ('8','$content12','$publish_date','$date_created', '$created_by')";

//mysqli_query($con, $sql) or die(mysqli_error($con));

if(mysqli_query($con, $sql)){
	echo json_encode(array("status" => TRUE));
}else{
	echo json_encode(array("status" => FALSE));
}


?>