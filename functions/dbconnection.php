<?php
$con = mysqli_connect("192.168.63.26","root","jfr3u9t","abaka_db");
//$con = mysqli_connect("localhost","root","","ctifls_db");

// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>