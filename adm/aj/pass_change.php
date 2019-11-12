<?php
include_once("../inc/check_login_status.php");
?><?php
// AJAX CALLS THIS CODE TO EXECUTE
if(isset($_POST['action']) && $_POST['action'] == "change_password"){
	//sleep(3);
	// Get user ip address
	$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// Check our errors here
	//////////end////////////////////
	/////////////////////////////////////
	$p1 = $_POST['pass'];
	$p2 = $_POST['pass1'];
	$temppasshash = md5($p1);
	$p_hash = md5($p2);
	//check username existence
$res = $db->query("SELECT id FROM users WHERE email='$log_email' AND password='$temppasshash' LIMIT 1");
	$numrows = $res->fetchColumn();
	if($numrows == 0){
		echo "Sorry your old password	does not match with the one in our system.";
    	exit();
	}else{
$sql = "UPDATE `users` SET password =:p_hash
			WHERE `id` = :id
			AND `email` = :e3
			LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':p_hash', $p_hash);
$stmt->bindParam(':id', $log_id);
$stmt->bindParam(':e3', $log_email);
$stmt->execute();
////////////////////////////////
		echo "pass_success";
        exit();
    }
}
?><?php
// AJAX CALLS THIS CODE TO EXECUTE
if(isset($_POST["p1"])){
	//sleep(3);
	// Get user ip address
	$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// Get referer from header
	$refer = preg_replace('#[^a-z0-9 -._]#i', '.', getenv('HTTP_REFERER'));	
	// Set variable for possible logging
	$csrf = "";
	// Check for login session	
	if(isset($_SESSION['login']) && isset($_SESSION['login']['tm']) && isset($_SESSION['login']['tk']) && isset($_POST['t'])){
		// Sanitize everything now
		$sTimestamp = preg_replace('#[^0-9]#', '', $_SESSION['login']['tm']);
		$sToken = preg_replace('#[^a-z0-9.-]#i', '', $_SESSION['login']['tk']);
		$fToken = preg_replace('#[^a-z0-9.-]#i', '', $_POST['t']);
		// Make sure we have values after sanitizing
		if($sTimestamp != "" && $sToken != "" && $fToken != ""){
			// Check if session and post token match
			if($fToken !== $sToken){
				$csrf .= "Form token and session token do not match|";
			}
			// Do 5 minute check
			$elapsed = time() - $sTimestamp;
			if($elapsed > 2000){
				$csrf .= "Expired session|";
			}
			// add more checks here if needed			
		} else {
			$csrf .= "A critical session or form token post was empty after sanitization|";
		}	
	} else {
		// Something fishy is going on .. our session is not set
		$csrf .= "A critical session or form token post was not set|";		
	}
	// CONNECT TO THE DATABASE
	include_once("../inc/db_conx.php");
	// Check our errors here
	if($csrf !== ""){
		// At least one of our tests above was failed
		// Sanitize the e & p posts for logging
		$e = preg_replace('#[^a-z 0-9]#i', '', $_POST['e']);
		$p = preg_replace('#[^a-z 0-9]#i', '', $_POST['m']);
		// Time to log this
	$sql = "INSERT INTO `logging` (`dt`, `ip`, `referer`, `issues`, `epost`, `ppost`)
	VALUES(now(), :ip, :refer, :csrf, :e, :p)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':ip', $ip);
$stmt->bindParam(':refer', $refer);
$stmt->bindParam(':csrf', $csrf);
$stmt->bindParam(':e', $e);
$stmt->bindParam(':p', $p);
$stmt->execute();
		// Unset 
		if(isset($_SESSION['login'])){
			unset($_SESSION['login']);
		}
		// Throttle back the attack
		sleep(3);
		// Return generic login_failed and exit script
		echo '<i class="fa fa-envelope-o"></i> Signup Failed <a href="pass_change.php"> Clicik here to Refresh</a>';
        exit();
	}
	/////////////////////////////////////////////
	//////////end////////////////////
	/////////////////////////////////////
	$p1 = $_POST['p1'];
	$p_hash = md5($p1);
	$temppasshash = $_POST['tp'];
	$e3 = $_POST['e'];
	//check username existence
$res = $db->query("SELECT id FROM useroptions WHERE email='$e3' AND temp_pass='$temppasshash' LIMIT 1");
	$numrows = $res->fetchColumn();
	if($numrows == 0){
		echo "Expired / Invalid Temporary Password: <br/> <a href='forgot_pass.php'style='color:green'> Clicik Here For New Password Reset.</a>";
    	exit();
	}else{
		 $sql = "SELECT id FROM useroptions WHERE email='$e3' AND temp_pass='$temppasshash' LIMIT 1";
	foreach( $db->query($sql) as $row ){
	$id = $row["id"];
	}
$sql = "UPDATE `users` SET password =:p_hash
			WHERE `id` = :id
			AND `email` = :e3
			LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':p_hash', $p_hash);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':e3', $e3);
$stmt->execute();
////////////////////////////////
$empty='';
$sql = "UPDATE `useroptions` SET temp_pass =:empty
			WHERE `email` = :e3
			LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':empty', $empty);
$stmt->bindParam(':e3', $e3);
$stmt->execute();
 //   header("location: index.php");
		echo "p_success";
        exit();
    }
}
?>