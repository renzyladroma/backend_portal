<?php
include('../functions/dbconnection.php');
$base_url = $_SERVER['DOCUMENT_ROOT'];
session_start();
header('Content-Type: application/json');
$id  = $_REQUEST['id'];
		
		$query = "SELECT t1.id AS id, headline, image, fetch_date, t2.category AS category_name
				  FROM rss_content t1 
				  INNER JOIN rss_category t2 ON t1.category_id = t2.category_id
				  WHERE t1.id = '$id'";
		
		$result = mysqli_query($con, $query) or die(mysqli_error($con));
		
		
		$data = array();
        
        while ($row_result = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
			$row = array();
			$row1 = $row_result['id'];
            $row2 = $row_result['category_name'];
			$row3 = $row_result['headline'];
			$row4 = $row_result['image'];
			$row5 = $row_result['fetch_date'];
			$data[] = $row;
		}
		$output = array("id" => $row1,
						"category_name" => $row2,
						"headline" => $row3,
						"image" => $row4,
						"fetch_date" => $row5);
		
		//echo json_encode(array("status" => TRUE));
        //output to json format
        echo json_encode($output);




 //$file_name = "";
  //$file_size = "";
  //$file_tmp = "";
  //$file_type = "";
  //$url = "http://115.85.17.57:8001/abaka_cms/news_image_uploads/";
  //$urlpdf = "http://115.85.17.57:8001/digitalshop_cms/uploads/pdf/";
  //$rename = date('Ymdhis');
   //if(isset($_FILES['image_url'])){
     // $errors= array();
      //$file_name = $_FILES['image_url']['name'];
     // $file_size = $_FILES['image_url']['size'];
     // $file_tmp = $_FILES['image_url']['tmp_name'];
	 // $file_tmp_pdf = $_FILES['pdf_url']['tmp_name'];
     // $file_type = $_FILES['image_url']['type'];
	  
     // $file_ext=strtolower(end(explode('.',$_FILES['image_url']['name'])));
	  //$pdf_ext=strtolower(end(explode('.',$_FILES['pdf_url']['name'])));
	  
      //$expensions= array("jpeg","jpg","png", "pdf");
      
	 //$tmp=$_FILES["image_url"]["tmp_name"];
     //$extension = explode("/", $_FILES["image_url"]["type"]);
	 //$extension_pdf = explode("/", $_FILES["pdf_url"]["type"]);
     //$name = $rename.".".$extension[1];
	 //$namepdf = $rename.".".$extension_pdf[1];
	  
	  
     // if(in_array($file_ext,$expensions)=== false){
      //   $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      //}
      
      //if($file_size > 10097152) {
      //   $errors[]='File size must be excately 2 MB';
    //  }
      
     // if(empty($errors)==true) {
		  //Dito ka magiinsert sa db
		// $filename = $url.$name;
		 //$filenamepdf = $urlpdf.$namepdf;
        // move_uploaded_file($file_tmp, "../../uploads/".$name);
		 //move_uploaded_file($file_tmp_pdf, "../../uploads/pdf/".$namepdf);
         //$sql = "UPDATE rss_content2 SET image = '$filename' WHERE id = '$id'";
		 //if ($con->query($sql) === TRUE) {
			//echo "New record created successfully";
		//} else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
		//}
		
		//header("Location: ../../news.php?status=1");
      //}else{
       // header("Location: ../../news.php?status_error=1");
      //}
  // }
?>
