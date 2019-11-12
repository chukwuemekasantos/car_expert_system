<?php
include_once("../inc/check_login_status.php");
$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
?><?php // Mark Read for Messages
 if (isset($_POST['action']) && $_POST['action'] == "apply_admision"){
	sleep(2);
	if(!isset($_POST['type']) || $_POST['pin'] == "" || $_POST['reg_no'] == ""
	|| $_POST['subject1'] == "" || $_POST['subject2'] == "" || $_POST['subject3'] == "" 
	|| $_POST['subject4'] == ""|| $_POST['subject5'] == ""  || $_POST['subject1_grade'] == ""
	|| $_POST['subject2_grade'] == ""|| $_POST['subject3_grade'] == ""|| $_POST['subject4_grade'] == "" 
	|| $_POST['subject5_grade'] == ""){
		echo " Filed is missing";
		exit();
	}
$type = $_POST['type'] ;
$reg_no = $_POST['reg_no'] ;
$pin = $_POST['pin'] ;
$sitting = $_POST['sitting'] ;
$program = $_POST['program'] ;
$subject1 = $_POST['subject1'] ;
$subject2 = $_POST['subject2'] ;
$subject3 = $_POST['subject3'] ;
$subject4 = $_POST['subject4'] ;
$subject5 = $_POST['subject5'] ;
$subject1_grade = $_POST['subject1_grade'];
$subject2_grade = $_POST['subject2_grade'];
$subject3_grade = $_POST['subject3_grade'];
$subject4_grade = $_POST['subject4_grade'];
$subject5_grade = $_POST['subject5_grade'];
		//check  existence
		$res = $db->query("SELECT id FROM apply WHERE user='$log_email' LIMIT 1");
		$apply_check = $res->fetchColumn();
		if ($apply_check > 0){ 
			echo '<span  class="fa fa-envelope-o"> You Have Already Applied For Admission, Please Check Your Admission Status</span>';
			exit();
		}
$sql = "INSERT INTO `apply` (`user`, `program_id`, `type`, `sitting`, `reg_no`, `pin`, `sbj_1`, `sbj_2`, `sbj_3`, `sbj_4`, `sbj_5`, `sbj_1_grade`, `sbj_2_grade`,`sbj_3_grade`,`sbj_4_grade`,`sbj_5_grade`, date) 
	VALUES(:user, :program_id,  :type, :sitting, :reg_no, :pin, :sbj_1, :sbj_2, :sbj_3, :sbj_4, :sbj_5, :sbj_1_grade, :sbj_2_grade, :sbj_3_grade, :sbj_4_grade, :sbj_5_grade, now())";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user', $log_email);
$stmt->bindParam(':program_id', $program);
$stmt->bindParam(':type', $type);
$stmt->bindParam(':sitting', $sitting);
$stmt->bindParam(':reg_no', $reg_no);
$stmt->bindParam(':pin', $pin);
$stmt->bindParam(':sbj_1', $subject1);
$stmt->bindParam(':sbj_2', $subject2);
$stmt->bindParam(':sbj_3', $subject3);
$stmt->bindParam(':sbj_4', $subject4);
$stmt->bindParam(':sbj_5', $subject5);
$stmt->bindParam(':sbj_1_grade', $subject1_grade);
$stmt->bindParam(':sbj_2_grade', $subject2_grade);
$stmt->bindParam(':sbj_3_grade', $subject3_grade);
$stmt->bindParam(':sbj_4_grade', $subject4_grade);
$stmt->bindParam(':sbj_5_grade', $subject5_grade);
$stmt->execute();
$uid = $db->lastInsertId();
if ($stmt == true){
///////////////////
echo "submit_success|$uid";
		exit();
	}
}
?>
<?php // Mark Read for Messages
 if (isset($_POST['action']) && $_POST['action'] == "add_program"){
	sleep(2);
	if(!isset($_POST['program_name']) || $_POST['program_mark'] == ""){
		echo " Filed is missing";
		exit();
	}
$program_name = $_POST['program_name'] ;
$program_mark = $_POST['program_mark'] ;
$sql = "INSERT INTO `programs` (`name`, `cut_off_mark`) 
	VALUES(:name, :cut_off_mark)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $program_name);
$stmt->bindParam(':cut_off_mark', $program_mark);
$stmt->execute();
$uid = $db->lastInsertId();
if ($stmt == true){
///////////////////
echo "submit_success|$uid";
		exit();
	}
}
?><?php // Mark Read for Messages
if (isset($_POST['action']) && $_POST['action'] == "add_score"){
   sleep(2);
   if(!isset($_POST['reg_no']) || $_POST['jamb_score'] == "" || $_POST['utme_score'] == ""){
	   echo " Filed is missing";
	   exit();
   }
$reg_no = $_POST['reg_no'] ;
$jamb_score = $_POST['jamb_score'] ;
$utme_score = $_POST['utme_score'] ;
$sql = "INSERT INTO `scores` (`jamb_reg_no`, `jamb_score`, `utme_score`) 
   VALUES(:jamb_reg_no, :jamb_score, :utme_score)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':jamb_reg_no', $reg_no);
$stmt->bindParam(':jamb_score', $jamb_score);
$stmt->bindParam(':utme_score', $utme_score);
$stmt->execute();
$uid = $db->lastInsertId();
if ($stmt == true){
///////////////////
echo "submit_success|$uid";
	   exit();
   }
}
?>
<?php // DELETE for apartment advert
 if (isset($_POST['action']) && $_POST['action'] == "delete_student"){
	 //sleep(3);
	if(!isset($_POST['tid']) || $_POST['tid'] !== ""){
		echo "We Can't Delete For Demo Purposes";
		exit();
	}
	$tid = preg_replace('#[^0-9]#', '', $_POST['tid']);
	// Check to make sure this logged in user actually owns that advert
	$sql = "SELECT email FROM students WHERE id='$tid' LIMIT 1";
	foreach( $db->query($sql) as $row ) {
	$account_name = $row["email"]; 
	}
	$picur1 = "users/$account_name"; 
	    if (file_exists($picur1)){
		unlink($picur1);
		$sql = "DELETE FROM students WHERE id='$tid' LIMIT 1";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		}
	    echo "delete_ok";
		exit();
 }
?><?php // DELETE Here We Wiil
if (isset($_POST['action']) && $_POST['action'] == "delete_program"){
	//sleep(3);
   if(!isset($_POST['tid']) || $_POST['tid'] !== ""){
	   echo "We Can't Delete For Demo Purposes";
	   exit();
   }
   $tid = preg_replace('#[^0-9]#', '', $_POST['tid']);
	   $sql = "DELETE FROM programs WHERE id='$tid' LIMIT 1";
	   $stmt = $db->prepare($sql);
	   $stmt->execute();
	   echo "delete_ok";
	   exit();
}
?><?php // DELETE for apartment advert
if (isset($_POST['action']) && $_POST['action'] == "delete_score"){
	//sleep(3);
   if(!isset($_POST['tid']) || $_POST['tid'] !== ""){
	echo "We Can't Delete For Demo Purposes";
	   exit();
   }
   $tid = preg_replace('#[^0-9]#', '', $_POST['tid']);
	   $sql = "DELETE FROM scores WHERE id='$tid' LIMIT 1";
	   $stmt = $db->prepare($sql);
	   $stmt->execute();
	   echo "delete_ok";
	   exit();
}
?><?php // fuction for visibility for apartments
if (isset($_POST['action']) && $_POST['action'] == "admit_student"){
	sleep(3);
   if(!isset($_POST['tid'])|| $_POST['type'] == ""){
	   echo " form Variables Missing";
	   exit();
   }
   $url = preg_replace('#[^0-9]#', '', $_POST['tid']);
   $type = $_POST['type'];
   ///////////////////////////////////
   if($type=="on"){
   $status='1';
   $sql = "UPDATE students SET  admission_status=:status
		   WHERE email = :url
		   LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':url', $url);
$submit= $stmt->execute();
	   echo "on_success";
	   exit();
   }else if ($type=="off"){
   $status='0';
   $sql = "UPDATE students SET  admission_status=:status
		   WHERE email = :url
		   LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':url', $url);
$submit= $stmt->execute();
echo "off_success";
	   exit();
   }		
}
?>