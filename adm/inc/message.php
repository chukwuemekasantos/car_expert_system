<?php
$logo = "";
$message = "";
$msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
if($msg == "activation_failure"){
	$message = '<h2>Activation Error</h2> Sorry there seems to have been an issue activating your account at this time. We have already notified ourselves of this issue and we will contact you via email when we have identified the issue.';
	$logo = '<img src="../images/error2.png" height="65" width="65">';
} else if($msg == "activation_success"){
	$message = '<h2>Activation Success</h2> Your account is now activated. <a href="../index.php">Click here to log in</a>';
	$logo = '<img src="../images/good2.png" height="65" width="65">';
} else if($msg == "preset_success"){
	$message = '<h2>Password Reset Success</h2> Your can now login with your temporary password.<br/> Note. You can change your password from your profile settings.';
	$logo = '<img src="../images/good2.png" height="65" width="65">';
} else if($msg == "email_active_success"){
	$message = '<h2>Email Verified </h2> Your will be redirected shortly.';
	$logo = '<img src="../images/good2.png" height="65" width="65">';
} else if($msg == "email_active_Fail"){
	$message = '<h2>Email Verification Failed </h2> Your will be redirected shortly.';
	$logo = '<img src="../images/error2.png" height="65" width="65">';
	} else {
	$message = $msg;
	$logo = '<img src="../images/error2.png" height="65" width="65">';
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title> My Campuse Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/ie6.css">
	<link rel="stylesheet" type="text/css" href="../css/ie7.css">
	<!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/ie6.css">
	<link rel="stylesheet" type="text/css" href="../css/ie7.css">
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap_v3.3.7.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

   
    
</head>
<!-- <span class="btn fa fa-reply" onclick="goBack()"> Please Go Back</span> </div> -->

<body> 

<div class="container">
        <div class="row centered-form" style="padding-top:100px">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class='panel-title' align='center'><span style='color:#079F26' class='fa fa'> <?php echo $message; ?> </span></h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form">
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12"></div>
		    			  </div>
                          
                          
                          <fieldset>
                          <div align="center">
                          
                          <?php echo $logo; ?>
                          
                          </div>
                          
                          </fieldset>
                          

			    			

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6"></div>
			    				<div class="col-xs-6 col-sm-6 col-md-6"></div>
			    			</div>
			    			<div align="center">
                            <button type="button" onclick="location.href='../verify.php';" class="btn btn-primary fa fa-sign-in" style="width:100px; align-self:center; align-content:center"> Account Verification</button>
			    			</div>
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
<script type="text/javascript">
$(document).ready(function(){
    // Floating Labels
	//==============================================================
    $('[data-toggle="floatLabel"]').attr('data-value', $(this).val()).on('keyup change', function() {
		$(this).attr('data-value', $(this).val());
	});
});
</script>




<script type="text/javascript">
// for Redirecting
setTimeout('ourRedirect()',5000)
function ourRedirect(){
	location.href='../index.php'
}
</script>

</body>
</html>