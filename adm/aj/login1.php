<?php
session_start();
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["e"])){
	//sleep(3);
	// START Expansion
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
			if($elapsed > 300){
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
		$e = $_POST['e'];
		// Time to log this
		$sql = "INSERT INTO `logging` (`dt`, `ip`, `referer`, `issues`, `epost`)
		VALUES(now(), :ip, :refer, :csrf, :e)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':ip', $ip);
		$stmt->bindParam(':refer', $refer);
		$stmt->bindParam(':csrf', $csrf);
		$stmt->bindParam(':e', $e);
		$stmt->execute();
		// Unset 
		if(isset($_SESSION['login'])){
			unset($_SESSION['login']);
		}
		// Throttle back the attack
		sleep(3);
		// Return generic login_failed and exit script
		echo "login_failed";
        exit();
	}
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$avatar="";
	$e = $_POST['e'];
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// FORM DATA ERROR HANDLING
	if($e == ""){
		echo "login_failed|please try again";
        exit();
	}
	$res = $db->query("SELECT id FROM users WHERE mainemail='$e' OR mobile='$e' LIMIT 1");
	$userMatch = $res->fetchColumn();
	if ($userMatch >0) { // evaluate the count
	$sql = "SELECT id, mobile, email, mainemail, avatar, first_name FROM users WHERE mainemail='$e' OR mobile='$e' LIMIT 1";
			foreach( $db->query($sql) as $row ) {
		$db_id = $row["id"];
		$mobile = $row["mobile"];
		$db_email = $row["email"];
        $mainemail = $row["mainemail"];
        $avatar = $row["avatar"];
        $f_name = $row["first_name"];
		echo "success|$db_email|$avatar|$mobile|$f_name";
		exit();	
		}
		} else {		
		echo "login_failed|$e";
            exit();
		}
}
?>