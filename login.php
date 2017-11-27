<!DOCTYPE html>
<?php $url = "http://115.85.17.57:8001/abaka_cms/"; ?>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.html">

    <title>Login</title>

    <!--Core CSS -->
    <link href="<?php echo $url;?>asset/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $url;?>asset/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo $url;?>asset/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo $url;?>asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $url;?>asset/css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<style>
		body{
			background-color: white;
		}
	</style>
</head>

  <body class="login-body">

    <div class="container">
      <form class="form-signin" method="post" action="<?php echo $url; ?>functions/auth/login.php">
        <h2 class="form-signin-heading">
			
			ABAKA - CMS
		</h2>
        <div class="login-wrap">
            <div class="user-login-info">
			<?php if(isset($_REQUEST['s']) != ""){ ?>
                <h4><span class="label label-danger col-md-12"> <strong>Invalid Email or Password</strong></span></h4></br></br>
			<?php } ?>
			<b>	Enter Username: </b> <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
            <b> Enter Password: </b> <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
            </div>
            
            <input class="btn btn-lg btn-login btn-block" type="submit" value="Sign in" />
        </div>
      </form>
    </div>



    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="<?php echo $url;?>asset/js/jquery.js"></script>
    <script src="<?php echo $url;?>asset/bs3/js/bootstrap.min.js"></script>
  </body>
</html>
