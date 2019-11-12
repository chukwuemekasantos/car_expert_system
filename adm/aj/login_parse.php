<?php
session_start();
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["e"])){
	date_default_timezone_set('Africa/Lagos');
	sleep(2);
	// START Expansion
	// Get user ip address
	$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	$ip_add = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// Get referer from header
	$refer = preg_replace('#[^a-z0-9 -._]#i', '.', getenv('HTTP_REFERER'));	
	// Set variable for possible logging
	include_once("../inc/db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$avatar="";
	$e = $_POST['e'];
	$p = md5($_POST['p']);
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// FORM DATA ERROR HANDLING
	if($e == "" || $p == ""){
		echo "login_failed|please try again";
        exit();
	}
	$res = $db->query("SELECT id FROM users WHERE mainemail='$e' OR username='$e' LIMIT 1");
	$userMatch = $res->fetchColumn();
	if ($userMatch >0) { // evaluate the count
	// END FORM DATA ERROR HANDLING
		$sql = "SELECT id, username, email, password, avatar FROM users WHERE mainemail='$e' OR username='$e' LIMIT 1";
		foreach( $db->query($sql) as $row ) {
		$db_id = $row["id"];
		$username = $row["username"];
		$db_email = $row["email"];
        $db_pass_str = $row["password"];;
        $avatar = $row["avatar"];
        if($p !== $db_pass_str){
			echo "login_failed|$e";
            exit();
		} else {
			// CREATE THEIR SESSIONS AND COOKIES
			$_SESSION['userid'] = $db_id;
			$_SESSION['username'] = $username;
			$_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$db_id");
			$_SESSION['email'] = $db_email;
			$_SESSION['password'] = $db_pass_str;
			setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("username", $username, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("user", $db_email, strtotime( '+30 days' ), "/", "", "", TRUE);
    		setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE); 
			// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
			$sql = "UPDATE `users` SET ip = :ip, lastlogin = now(), last_seen = now() 
			WHERE `email` = :url
			LIMIT 1";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':ip', $ip);
			$stmt->bindParam(':url', $db_email);
			$stmt->execute();
			//if user is login from page we will send login_success
			echo "success|$db_email";
			exit();
		}
	exit();
}
} else {		
	echo "Not_Exist|$e";
		exit();
	}
}
?>