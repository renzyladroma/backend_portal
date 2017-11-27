
<?php
include('../functions/dbconnection.php');
session_start();
$base_url = $_SERVER['DOCUMENT_ROOT'];

$publish_date = $_REQUEST['publish_date'];
$date_created = date('Y-m-d');
$created_by	= $_SESSION['id'];


 $file_name = "";
  $file_size = "";
  $file_tmp = "";
  $file_type = "";
  $url = "http://115.85.17.57:8001/abaka_cms/love/";
  $rename = date('Ymdhis');
   if(isset($_FILES['image_url'])){
      $errors= array();
      $file_name = $_FILES['image_url']['name'];
      $file_size = $_FILES['image_url']['size'];
      $file_tmp = $_FILES['image_url']['tmp_name'];
      $file_type = $_FILES['image_url']['type'];
	  
      $file_ext=strtolower(end(explode('.',$_FILES['image_url']['name'])));
	  
      $expensions= array("jpeg","jpg","png");
      
	 $tmp=$_FILES["image_url"]["tmp_name"];
     $extension = explode("/", $_FILES["image_url"]["type"]);
     $name = $rename.".".$extension[1];
	  
	
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 10097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
		  //Dito ka magiinsert sa db
		 $filename = $url.$name;
		 
         move_uploaded_file($file_tmp, "../love/".$name);
         $sql = "INSERT INTO tbl_content(sub_category_id_fk, image_url,publish_date, date_created, created_by) 
		 VALUES('6', '$filename', '$publish_date', '$date_created', '$created_by')";
		 if ($con->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		header("Location: ../love_content.php?status=1");
      }else{
        header("Location: ../love_content.php?status_error=1");
      }
   }
?>
