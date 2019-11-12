<?php
include_once("inc/check_login_status.php");
// To Check IF The User Is Already Login
if($user_ok == true){
header("location:profile?e=".$_SESSION["email"]);
exit();
}
// for login security funtion
// Add timer java script
		// Add token to ajax post
		$salt = "h89ZzxKYassa40832";
		$timestamp = time();
		$tk = str_shuffle(md5(uniqid().md5($salt)));
		// filter the caracter bc of ajax
		$tk = preg_replace('#[^a-z0-9.-]#i','',$tk);
		$ses_array = array("tm" => $timestamp, "tk" => $tk);
		if (!isset($_SESSION['login'])){
				$_SESSION['login'] = $ses_array;
		}else{
				unset($_SESSION['login']);
				$_SESSION['login'] = $ses_array;
		}
		?>
		<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lorvens-Tables Bo</title>
	<!-- Fav  Icon Link -->
	<link rel="shortcut icon" type="image/png" href="images/fav.png">
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- themify icons CSS -->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Main CSS -->
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/red.css" id="style_theme">
	<link rel="stylesheet" href="css/responsive.css">

	<script src="js/modernizr.min.js"></script>
</head>

<body class="auth-bg">
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
		<!-- Page Content -->
		<div id="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6 auth-box">
						<div class="lorvens-box-shadow">
							<!-- Page Title -->
							<h3 class="widget-title">Sign Up</h3>
							<!-- /Page Title -->

							<!-- Form -->
							<form class="widget-form">
							
								<div class="form-group row">
									<div class="col-sm-12">
										<input name="user" placeholder="Username" class="form-control" required="" data-validation="length alphanumeric" data-validation-length="3-12"
										 data-validation-error-msg="User name has to be an alphanumeric value (3-12 chars)" data-validation-has-keyup-event="true"name="sign-up-username" id="sign-up-username" onfocus="emptyElement('status1')">
									</div>
								</div>

							<div class="form-group row">
									<div class="col-sm-12">
										
										<input type="email" placeholder="Email" name="email" class="form-control" required="" data-validation="email" data-validation-has-keyup-event="true"name="sign-up-email" id="sign-up-email" onfocus="emptyElement('status1')">
									</div>
								</div>
										
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="password" placeholder="Password" name="pass_confirmation" class="form-control" data-validation="strength" data-validation-strength="2"
										 data-validation-has-keyup-event="true" name="sign-up-pass1" id="sign-up-pass1" placeholder="Password"onfocus="emptyElement('status1')">
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="password" placeholder="Confirm Password" name="pass_confirmation" class="form-control" data-validation="strength"
										 data-validation-strength="2" data-validation-has-keyup-event="true" name="sign-up-pass2" id="sign-up-pass2" onfocus="emptyElement('status1')">
									</div>
								</div>

								
								<div id='status1'></div>
								<!-- Button -->
								<div class="button-btn-block">
									<button type="button" class="btn btn-primary btn-lg btn-block" onclick="signup()"  id="signupbtn">Sign Up</button>
								</div>
								<!-- /Button -->
								<!-- Linsk -->
								<div class="auth-footer-text">
									<small>Alredy Sign Up,
										<a href="login">Login</a> Here</small>
								</div>
								<!-- /Links -->
							</form>
							<!-- /Form -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Content -->
	</div>
	<!-- Jquery Library-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<!-- Popper Library-->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap Library-->
	<script src="js/bootstrap.min.js"></script>
	<!-- Custom Script-->
	<script src="js/custom.js"></script>
</body>


<script> 
		function restrict(elem){
		 var tf = _(elem);
		 var rx = new RegExp;
		 if(elem == "sign-up-email" || elem == "sign-up-uname" ){
			 rx = /[' "]/gi;
		 }else if(elem == "price"){
			 //rx = /[^a-z 0-9():><+-@#$'"%\|\_/]/gi;
			 rx = /[^0-9]/gi;
		 }
		 tf.value = tf.value.replace(rx, "");
	 }
	 function emptyElement(x){
		 _(x).innerHTML = "";
	 }
		</script>
	 
	 <script>
		 function signup(){
	   var u = _("sign-up-username").value;
	   var e = _("sign-up-email").value;
	   var p = _("sign-up-pass1").value;
	   var p2 = _("sign-up-pass2").value;
	   if(u == ""){
			 _("status1").innerHTML = '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> Alert! :  Please Enter Your User Name </div>';
	   }else if(e == ""){
				 _("status1").innerHTML = '<p><div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> Alert! :   Please Enter Your Email. </div>';
	  }else if(p == ""){
		 _("status1").innerHTML = '<p><div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> Alert! :   Please Enter Your Password. </div>';
	   }else if(p2 == ""){
			 _("status1").innerHTML = '<p><div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> Alert! :   Please Enter Confirm Password. </div>';
	 }else if (p !== p2){
		 _("status1").innerHTML = '<p><div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> Alert! :   Your Passwords Does not Match. </div>';
	 }else{
		 _("signupbtn").innerHTML = '<img src="images/loading3.gif">';
		 _("status1").innerHTML = 'Please Waith....';
		 var ajax = ajaxObj("POST", "aj/signup.php");
		 ajax.onreadystatechange = function() {
				 if(ajaxReturn(ajax) == true) {	
			 var datArray = ajax.responseText.split("|");	
			 if(datArray[0] == "signup_success"){		
			 window.location = "profile?e="+datArray[1]
					 }else{
				 _("status1").innerHTML ='<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> ' +ajax.responseText+' </div>';
				 _("signupbtn").innerHTML = 'Register';
				 //	alert(ajax.responseText);
					 }
				 }
			 }
			 ajax.send("u="+u+"&e="+e+"&p1="+p+"&t=<?php echo $_SESSION['login']['tk'];?>");
		 }
	 }
	 // Login Function Ends Here
	 </script>
	 
	 
	 <script src="js/main1.js"></script>
		 <script src="js/ajax.js"></script>
		 
		 <script> 
		 /////////////////////////////////
		 function restrict(elem){
		 var tf = _(elem);
		 var rx = new RegExp;
	   if(elem == "sign-up-email"){
			 rx = /[' "]/gi;
		 } else if(elem == "sign-up-username"){
			 rx = /[^a-z0-9-.-_]/gi;
		 }
		 tf.value = tf.value.replace(rx, "");
	 }
	 </script> 

</html>