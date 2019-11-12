<?php
include_once("inc/check_login_status.php");
// To Check IF The User Is Already Login
if($user_ok == true){
header("location:.?e=".$_SESSION["email"]);
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


<!-- Mirrored from www.konnectplugins.com/lorvens/site/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Jul 2019 00:30:58 GMT -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Car Expert</title>
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
		<!-- Page Content  -->
		<div id="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6 auth-box">
						<div class="lorvens-box-shadow">
							<h3 class="widget-title">Login</h3>
							<form class="widget-form">
								<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<input name="user" placeholder="Username" class="form-control" required="" data-validation="length alphanumeric" data-validation-length="3-12"
										 data-validation-error-msg="User name has to be an alphanumeric value (3-12 chars)" data-validation-has-keyup-event="true" id="sign-up-username" onfocus="emptyElement('status1')">
									</div>
								</div>
								<!-- /.form-group -->
								<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="password" placeholder="Password" name="pass_confirmation" class="form-control" data-validation="strength" data-validation-strength="2"
										 data-validation-has-keyup-event="true" id="sign-up-pass1" onfocus="emptyElement('status1')">
									</div>
								</div>
								<!-- /.form-group -->
								<div id='status1'></div>
								<!-- Login Button -->			
								<div class="button-btn-block">
									<button type="button" class="btn btn-primary btn-lg btn-block"onclick="login2()" id="loginbtn">Login</button>
								</div>
								<!-- /Login Button -->	
								<!-- Links -->	
								<div class="auth-footer-text">
									<small>New User,
										<a href="sign-up">Sign Up</a> Here</small>
								</div>
								<!-- /Links -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Content  -->
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
function login2(){
	//make sure time has not expired
	var postTime = new Date().valueOf();
	var totalTime = Math.ceil((postTime - startTime)/1000);
	// if 5 minutes has passed.. make them refresh
	// shave off a few seconds for time lost in page load 300 -> 295
	if (totalTime > 295){
		_("loginbtn").style.display = "none";
		_("sign-up-username").style.display = "none";
		_("sign-up-pass1").style.display = "none";
		_("status1").innerHTML = '<p><div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> Alert! : You have timed out. <br/><a href ="login">Click here to refresh your browser.</a> </div></p>';
	return false;
	}
	var e = _("sign-up-username").value;
	var p = _("sign-up-pass1").value;
	if(e == "" || p == ""){
		_("status1").innerHTML = '<p><div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> Alert! : Please Fill out all. </div></p>';
	} else {
		_("status1").innerHTML = '';
		_("loginbtn").innerHTML = '<img src="images/loading3.gif">';
		_("status1").innerHTML = 'Please Waith....';
		var ajax = ajaxObj("POST", "aj/login_parse.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
		var datArray = ajax.responseText.split("|");	
		if(datArray[0] == "login_failed"){
			_("loginbtn").innerHTML = "Login";
		_("status1").innerHTML = '<p><div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> Alert! : Login Failed </div></p>';
	}else if(datArray[0] == "Not_Exist"){
		_("loginbtn").innerHTML = "Login";
		_("status1").innerHTML = '<p><div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> Sorry! : '+datArray[1]+' Does Not Exist In Our System </div></p>';
	}else if(datArray[0] == "success"){
	window.location = "?e="+datArray[1]
				}else{	
				  _("loginbtn").innerHTML = "Login";
                    _("status1").innerHTML ='<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="icon fa fa-warning"></i> ' +ajax.responseText+' </div>';
	
				
				}
	        }
        }
        ajax.send("e="+e+"&p="+p+"&t=<?php echo $_SESSION['login']['tk'];?>");
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
<script> 
		// Emty Function Starts Here
		// get initial timestamp for 5 minute limit
		var startTime = new Date().valueOf();	
		function emptyElement(x){
			_(x).innerHTML = "";
		}
		</script>
		   
</html>