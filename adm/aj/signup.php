<?php
session_start();
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["u"])){
	date_default_timezone_set('Africa/Lagos');
	sleep(3);
	// START Expansion
	// Get user ip address
	$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	///// end of capcha
	include_once("../inc/db_conx.php");
	$u = preg_replace('#[^a-z 0-9]#i', '', $_POST['u']);
	$e =  $_POST['e'];
	$p = $_POST['p1'];
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	//check email existence
	$res = $db->query("SELECT id FROM users WHERE mainemail='$e' LIMIT 1");
	$e_check = $res->fetchColumn();
		//check rg existence
		$res = $db->query("SELECT id FROM users WHERE username='$u' LIMIT 1");
		$u_check1 = $res->fetchColumn();
		if($u == ""|| $e == "" || $p == "" ){
		echo '<span  class="fa fa-envelope-o"> The form submission is missing values.</span>';
        exit();
	} else if ($e_check > 0){ 
        echo '<span  class="fa fa-envelope-o"> The email address is already in use in the system. Please sign in </span>';
        exit();
	} else if ($u_check1 > 0){ 
        echo '<span  class="fa fa-envelope-o"> The Username. is already in use by another user. Please chose another </span>';
        exit();
	} else if (strlen($p) < 5 ) {
        echo '<span  class="fa fa-envelope-o"> Password must be greather than 4 characters</span>';
        exit(); 
    }else if (filter_var($e, FILTER_VALIDATE_EMAIL) == false) {
    echo '<span  class="fa fa-envelope-o"> Please Provide a valid email address </span>';
	exit();
	} else {		 
		include("../inc/randStrGen.php");
		//////
		$e_hash = md5($e);
		$date = date("DMjGisY");
		//$url = randStrGen(10).randStrGen1(7);
		//$rand = "my_Campus_Home".$date.$slash.$rand1;
		//$url = $date.randStrGen2(5);
		$p_hash = md5($p);
		/////////////////	
	$avatar='avatar.png';
	$sql = "INSERT INTO `users` (`username`,`mainemail`, `password`,`avatar`,`ip`,`signup`,`lastlogin`,`last_seen`, `notescheck`)
	VALUES(:rg, :e, :p_hash, :avatar, :ip, now(), now(), now(), now())";
$stmt = $db->prepare($sql);
$stmt->bindParam(':rg', $u);
$stmt->bindParam(':e', $e);
$stmt->bindParam(':p_hash', $p_hash);
$stmt->bindParam(':avatar', $avatar);
$stmt->bindParam(':ip', $ip);
$stmt->execute();
$uid = $db->lastInsertId();
if($stmt==true){
$url = randStrGen3(5).$uid;	
$sql = "UPDATE users SET  email=:url
			WHERE id = :id
            LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':url', $url);
$stmt->bindParam(':id', $uid);
$submit= $stmt->execute();
}
$original='original';
	$sql = "INSERT INTO `useroptions` (`id`, `email`, `background`)
	VALUES( :uid, :url, :original)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':uid', $uid);
$stmt->bindParam(':url', $url);
$stmt->bindParam(':original', $original);
$query = $stmt->execute();
		if ($query == true) {
		// Create directory(folder) to hold each user's files(pics, MP3s, etc.)
		if (!file_exists("../users/$url")) {
			mkdir("../users/$url", 0755);
		}
		// Create directory(folder) to hold each user's small photo
		if (!file_exists("../users/$url/small")) {
			mkdir("../users/$url/small", 0755);
		}
		//////////////////////////////// 
		//////////////////////////////// 
		$index = '../inc/index.php';
		$avatar = '../images/avatar.jpg';
		$index2 = "../users/$url/index.php"; 
		$index3 = "../users/$url/small/index.php"; 
		$avatar1 = "../users/$url/avatar.jpg"; 
		if (!copy($index, $index2)) {
			echo "failed to create index.php one";
		exit();
		}
		if (!copy($index, $index3)) {
			echo "failed to create index.php two";
		exit();
		}
		if (!copy($avatar, $avatar1)) {
			echo "failed to create Avater";
		exit();
		}
		$sql = "SELECT username, avatar, mainemail FROM users WHERE email='$url' LIMIT 1";
        foreach( $db->query($sql) as $row ){
	$username = $row["username"];
	$avatar = $row["avatar"];
	$agent_email = $row["mainemail"];
	}
	// CREATE THEIR SESSIONS AND COOKIES
	$_SESSION['userid'] = $uid;
	$_SESSION['idx'] = base64_encode("g4p3h9xrg8sq03hs2234$uid");
	$_SESSION['email'] = $url;
	$_SESSION['password'] = $p_hash;
	setcookie("id", $uid, strtotime( '+30 days' ), "/", "", "", TRUE);
	setcookie("user", $url, strtotime( '+30 days' ), "/", "", "", TRUE);
	setcookie("pass", $p_hash, strtotime( '+30 days' ), "/", "", "", TRUE); 
	echo "signup_success|$url";
			exit();
	}else{
	echo "Not Successful";
	exit();
	}							
	exit();
	}
	exit();
	}
?>