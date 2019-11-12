<?php
include_once("inc/check_login_status.php");
// To Check IF The User Is Already Login
?>
<?php if($user_ok == true){ 
    	// details, if no then exit this script and give message why
        $res = $db->query("SELECT * FROM users WHERE email='$log_email'");
        $numrows = $res->fetchColumn();
        if($numrows >0 ){
            $sql = "SELECT * FROM users WHERE email='$log_email'";
        foreach( $db->query($sql) as $row ) {
            $username = $row["username"];
            $mainemail = $row["mainemail"];
            $avatar2 = $row["avatar"];
            $ip = $row["ip"];
            $userlevel = $row["userlevel"];
            $signup = $row["signup"];
            $lastlogin = $row["lastlogin"];
            $activated = $row["activated"];
            }
            } else {
              header("location:logout.php");
                exit();
            }

}else{
  header("location:logout.php");
  exit();
}
?>	
<!DOCTYPE html>
<html>
<!-- Mirrored from www.konnectplugins.com/lorvens/site/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Jul 2019 00:29:29 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Car Expert System</title>
	<!-- Fav  Icon Link -->
	<link rel="shortcut icon" type="image/png" href="images/fav.png">
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- themify icons CSS -->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Animations CSS -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Main CSS -->
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/red.css" id="style_theme">
	<link rel="stylesheet" href="css/responsive.css">
	<!-- morris charts -->
	<link rel="stylesheet" href="charts/css/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="css/jquery-jvectormap.css">

	<script src="js/modernizr.min.js"></script>
</head>

<body>
	<!-- Pre Loader -->
	<div class="loading">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
	<!--/Pre Loader -->
	<!-- Color Changer -->
	<div class="theme-settings" id="switcher">
		<span class="theme-click">
			<img src="images/color-pallete.png" alt="color pallete">
		</span>
		<span class="theme-color theme-default theme-active" data-color="green"></span>
		<span class="theme-color theme-blue" data-color="blue"></span>
		<span class="theme-color theme-red" data-color="red"></span>
		<p>(Or) Your Color</p>
	</div>
	<!-- /Color Changer -->
	<div class="wrapper">
		<!-- Sidebar -->
		<nav id="sidebar" class="lorvens-bg">
			<div class="sidebar-header">
				<a href="."> Car Expert System</a>
				<a href="." style="font-size: 40px"><?php echo $username;?></a>
			</div>
			<ul class="list-unstyled components">
				<li class="active">
					<a href="#nav-dashboard" data-toggle="collapse" aria-expanded="true">
						<span class="ti-home"></span> Dashboard
					</a>
	
				</li>
		
				

                        <li>
                                <a href="logout">
                                    <span class="ti-layout-menu-v"></span> Log Out
                                </a>
                            </li>
				
			</ul>
			<div class="nav-help animated fadeIn">
				<h5>Need Help</h5>
				<h6>
					<span class="ti-mobile"></span> +234 816 0048 962</h6>
				<h6>
					<span class="ti-email"></span> contact@samuel.com</h6>
				<p class="copyright-text">Copy rights &copy; 2018</p>
			</div>
		</nav>
		<!-- /Sidebar -->