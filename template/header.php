<!DOCTYPE html>
<?php
	include('functions/dbconnection.php');
	$url = "http://115.85.17.57:8001/abaka_cms/"; 
?>
<?php 
	session_start();
	if(isset($_SESSION['id'])){
		 
	}else{
		header('Location: login.php?s='.base64_encode("failed"));
	}
	
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">

    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
    <meta http-equiv="X-UA-Compatible" content="IE=9">

    <link rel="icon" type="image/png" href="<?php echo $url; ?>asset/images/cdu.png" />
    <title>ABAKA - CMS</title>
    <!--Core CSS -->
    <link href="<?php echo $url;?>asset/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $url;?>asset/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
    <link href="<?php echo $url;?>asset/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo $url;?>asset/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $url;?>asset/js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="<?php echo $url;?>asset/css/clndr.css" rel="stylesheet">
    <!--clock css-->
	
	<!--dynamic table-->
    <link href="<?php echo $url;?>asset/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo $url;?>asset/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $url;?>asset/js/data-tables/DT_bootstrap.css" />
	
    <link href="<?php echo $url;?>asset/js/css3clock/css/style.css" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo $url; ?>asset/js/morris-chart/morris.css">
    <!-- Custom styles for this template -->
    <link href="<?php echo $url;?>asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $url;?>asset/css/style-responsive.css" rel="stylesheet"/>
	<script src="<?php echo $url;?>asset/js/jquery.js"></script>
	
	<!-- Graph javascript -->
	<link href="<?php echo $url;?>asset/js/datatables/jquery.dataTables.min.css" rel="stylesheet">
	<script src="<?php echo $url;?>asset/js/datatables/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="<?php echo $url;?>asset/js/datatables/buttons.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="<?php echo $url;?>asset/js/datatables/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo $url;?>asset/js/datatables/buttons.flash.min.js"></script>
	
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="<?php echo $url; ?>" class="logo" style="color: #fff;">
        
		ABAKA - CMS
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars" ></div>
    </div>
</div>
<!--logo end-->

<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle icon-user" href="#">
                <!--<img alt="" src="images/avatar1_small.jpg">-->
                <i class="fa fa-user"></i>
                <span class="username"><?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
				<li><a href=""><i class="fa fa-lock"></i> Lock</a></li>
                <li><a href="logout.php"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="" href="<?php echo $url; ?>">
                        <i class="fa "></i>
                        <span>Manage User's Story</span>
                    </a>
                </li>
				
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-list-ul"></i>
                        <span>Manage Contents</span>
                    </a>
                    <ul class="sub">
						<li><a href="news.php">News Content</a></li>
                        <li><a href="lotto_content.php">Lotto Content</a></li>
                        <li><a href="horoscope_content.php">Horoscope Content</a></li>
						 <li><a href="love_content.php">Love Content</a></li>
                    </ul>
                </li>
				

                
            </ul>            
	</div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
