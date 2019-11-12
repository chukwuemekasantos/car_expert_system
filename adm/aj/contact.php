<?php
include_once("../inc/check_login_status.php");
?><?php
// AJAX CALLS THIS CODE TO EXECUTE
if (isset($_POST['action']) && $_POST['action'] == "e_contact"){
	//sleep(3);
	$n = $_POST['n'];
	$e = $_POST['e'];
	$mob = $_POST['mob'];
	$m =  $_POST['m'];
	$ae = $_POST['ae'];
	$an = $_POST['a_name'];
	$p_name = $_POST['ap_name'];
	$image = $_POST['image'];
	if (filter_var($e, FILTER_VALIDATE_EMAIL) == false) {
    echo '<span  class="fa fa-warning" style="color:darkred"> Please Provide a valid email address</span>';
	exit();
	}else if ( !preg_match ("/^([0-9]+)$/", $mob)) {
       echo '<span  class="fa fa-warning" style="color:darkred"> Mobile Number must be Numeric Only, eg 08123456789</span>';
	    exit();
    }
	$sql = "SELECT first_name, mainemail FROM users WHERE email='$ae' LIMIT 1";
        foreach( $db->query($sql) as $row ){
	$agent_name = $row["first_name"];
	$agent_email = $row["mainemail"];
	}
		///////////////////////////
	/*  $to = $agent_email;
		$from = "enquiry@mycampushomes.com";
		$headers ="From: $from\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
		$subject ="My Campus Home";
		$msg = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title> My Campus Home</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:0px; background:#FFF; font-size:24px; color:#CCC;"><a href="http://www.mycampushomes.com"><h1> '.$an.' Enquiry </h1></a><br></div><div style="padding:24px; font-size:17px;"> <h4> Hello '.$agent_name.' You Have a New Enquiry</h4><p>.</p><p> Name : '.$n.' </p><p>Email: '.$e.'</p> </p><p>Mobile: '.$mob.'</p> <p>Message : '.$m.'</p></div></body></html>';
		if(mail($to,$subject,$msg,$headers)) {
	*/
	  // Email Sending Script
	  // $to = "jc.computers.ng@gmail.com,jc.softworld@gmail.com";
		$to = ''.$agent_email.'';							 
		$from = "enquiry@mycampushomes.com";
		$subject = "".$p_name." Enquiry";
		
   $text_message = " Campus Life at Ease <br/>www.mycampushomes.com";      
   // HTML email starts here
   $message  = "<html><body>";
   
   $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
   
   $message .= "<tr><td>";
   
   $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
   
   $message .= "<thead>
      <tr height='80'>
       <th colspan='4' style='background-color:#00a2d1; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#fff; font-size:25px;' >  Enquiry Update</th>
      </tr>
      </thead>";
    
   $message .= "<tbody>
       <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#f5f5f5; text-align:center;'><a href='http://www.mycampushomes.com' style='color:#333;font-size:20px; text-decoration:none;'><u> ".$p_name." </u></a></td>
	   </tr>
	   
	   <tr align='center' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#f5f5f5; text-align:center;'>
		<a href='http://www.mycampushomes.com'> <img src='http://www.mycampushomes.com/agents/".$ae."/small/".$image."' alt='My Campus Home Updates' title='FUNAI Connect Updates' style='height:auto; width:80%; max-width:80%;' /></a>
       </td>
      </tr>
	   
	   <tr>
       <td colspan='4' style='padding:15px;'>
       <p><span style='font-size:17px;'> 
	   
	   <h4> Hello ".$agent_name." You Have a New Enquiry</h4><p></p><p> Name : ".$n." </p><p>Email: ".$e."</p> </p><p> Mobile: ".$mob."</p> <p>Message : ".$m."</p>
        <hr />	 
	   <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#00a2d1;font-size:20px; text-align:center;'><a href='http://www.mycampushomes.com' style='color:#fff; text-decoration:none;' > Visit My Campus Home</a></td>
	   </tr>
	   <tr>
	   <td>
		<p align='center' style='font-size:15px; text-align:center; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
       </td>
      </tr>
      
      <tr height='80'>
       <td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:16px; '>
       
	    <h4>Powered By</h4>
                 <a href='https://www.coderstriangle.com' target='blank'><img src='http://www.mycampushomes.com/images/coders_triangle.png' alt='Coders Triangle' style='width:23%'></a>
                 <a href='#'><img src='http://www.mycampushomes.com/images/jc_soft_world.png' alt='Jc Soft World' style='width:28%'></a>
                 <a href='#'><img src='http://www.mycampushomes.com/images/donwoods.png' alt='Donwoods'style='width:18%'></a>
                 <a href='https://www.eaglesarena.com' target='blank'><img src='http://www.mycampushomes.com/images/eagles_arena2.png' alt='Eagles Arena' style='width:25%'></a>
	   
	   <label>
	   copyright @ mycampushomes.com,  
       
       </label>
       </td>
      </tr>
      </tbody>"; 
   $message .= "</table>";
   $message .= "</td></tr>";
   $message .= "</table>";
   $message .= "</body></html>";
   $headers = "From: $from\n";
   $headers .= "MIME-Version: 1.0\n";
   $headers .= "Content-type: text/html; charset=iso-8859-1\n";
 if(mail($to, $subject, $message, $headers)) {
	////////////////////
	// INSERT Into Dbase
$sql = "INSERT INTO message (receiver, sender, mobile, email, p_name, message, sent_time) 
		VALUES(:ae, :n, :mob, :e, :p_name, :m, now())";
$stmt = $db->prepare($sql);
$stmt->bindParam(':ae', $ae);
$stmt->bindParam(':n', $n);
$stmt->bindParam(':mob', $mob);
$stmt->bindParam(':e', $e);
$stmt->bindParam(':p_name', $p_name);
$stmt->bindParam(':m', $m);
$stmt->execute();
	/////////////////////////////////////////Delete Excess	
	$res = $db->query("SELECT COUNT(id) FROM message WHERE receiver='$ae'");
	$row = $res->fetchColumn();
	if ($row[0] > 10){ // If they have 20 or more posts of type a
		// (you can auto flush for post types c and b if you wish to also)
		$sql = "SELECT id FROM message WHERE receiver='$ae' ORDER BY id ASC LIMIT 1";
        foreach( $db->query($sql) as $row ){
	$oldest = $row["id"];
	}
	$sql = "DELETE FROM message WHERE id='$oldest'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	}
	    	echo "sent_success";
			exit();
		} else {
			echo "Sorry Your Message Was Not Sent";
			exit();
		}
     exit();
}
?><?php
// AJAX CALLS THIS CODE TO EXECUTE
if (isset($_POST['action']) && $_POST['action'] == "agent_visiting"){
	//sleep(3);
	$n = $_POST['n'];
	$d = $_POST['d'];
	$t = $_POST['t'];
	$mob = $_POST['mob'];
	$m =  $_POST['m'];
	$ae = $_POST['ae'];
	$an = $_POST['a_name'];
	$p_name = $_POST['ap_name'];
	$image = $_POST['image'];
	if ( !preg_match ("/^([0-9]+)$/", $mob)) {
       echo '<span  class="fa fa-warning" style="color:darkred"> Mobile Number must be Numeric Only, eg 08123456789</span>';
	    exit();
    }
	$sql = "SELECT first_name, mainemail FROM users WHERE email='$ae' LIMIT 1";
        foreach( $db->query($sql) as $row ){
	$agent_name = $row["first_name"];
	$agent_email = $row["mainemail"];
	}
	  // Email Sending Script
	  // $to = "jc.computers.ng@gmail.com,jc.softworld@gmail.com";
		$to = ''.$agent_email.'';							 
		$from = "visitation@mycampushomes.com";
		$subject = "".$p_name." Visitation";
		
   $text_message = "  Campus Life at Ease <br/>www.mycampushomes.com";      
   // HTML email starts here
   $message  = "<html><body>";
   
   $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
   
   $message .= "<tr><td>";
   
   $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
   
   $message .= "<thead>
      <tr height='80'>
       <th colspan='4' style='background-color:#00a2d1; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#fff; font-size:25px;' > Visitation Update</th>
      </tr>
      </thead>";
    
   $message .= "<tbody>
       <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#f5f5f5; text-align:center;'><a href='http://www.mycampushomes.com' style='color:#333;font-size:20px; text-decoration:none;'><u> ".$p_name." </u></a></td>
	   </tr>
	   
	   <tr align='center' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#f5f5f5; text-align:center;'>
		<a href='http://www.mycampushomes.com'> <img src='http://www.mycampushomes.com/agents/".$ae."/small/".$image."' alt='My Campus Home Updates' title='FUNAI Connect Updates' style='height:auto; width:80%; max-width:80%;' /></a>
       </td>
      </tr>
	   
	   <tr>
       <td colspan='4' style='padding:15px;'>
       <p><span style='font-size:17px;'> 
	   
	   <h4> Hello ".$agent_name." You Have New Visitation Update</h4><p></p><p> Name : ".$n." </p><p>Mobile: ".$mob."</p> </p><p> Date: ".$d."</p> <p> Visitation Time: ".$t."</p> <p>Message : ".$m."</p>
        <hr />	 
	   <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#00a2d1;font-size:20px; text-align:center;'><a href='http://www.mycampushomes.com' style='color:#fff; text-decoration:none;' > Visit My Campus Home</a></td>
	   </tr>
	   <tr>
	   <td>
		<p align='center' style='font-size:15px; text-align:center; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
       </td>
      </tr>
      
      <tr height='80'>
       <td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:16px; '>
	   <label>
	   copyright @ mycampushomes.com,  
       
       </label>
       </td>
      </tr>
      </tbody>"; 
   $message .= "</table>";
   $message .= "</td></tr>";
   $message .= "</table>";
   $message .= "</body></html>";
   $headers = "From: $from\n";
   $headers .= "MIME-Version: 1.0\n";
   $headers .= "Content-type: text/html; charset=iso-8859-1\n";
 if(mail($to, $subject, $message, $headers)) {
	////////////////////
	// INSERT Into Dbase
$sql = "INSERT INTO visitation (day, time, receiver, sender, mobile, p_name, message, sent_time) 
		VALUES(:d, :t, :ae, :n, :mob, :p_name, :m, now())";
$stmt = $db->prepare($sql);
$stmt->bindParam(':d', $d);
$stmt->bindParam(':t', $t);
$stmt->bindParam(':ae', $ae);
$stmt->bindParam(':n', $n);
$stmt->bindParam(':mob', $mob);
$stmt->bindParam(':p_name', $p_name);
$stmt->bindParam(':m', $m);
$stmt->execute();
	/////////////////////////////////////////Delete Excess	
	$res = $db->query("SELECT COUNT(id) FROM visitation WHERE receiver='$ae'");
	$row = $res->fetchColumn();
	if ($row[0] > 10){ // If they have 20 or more posts of type a
		// (you can auto flush for post types c and b if you wish to also)
		$sql = "SELECT id FROM visitation WHERE receiver='$ae' ORDER BY id ASC LIMIT 1";
        foreach( $db->query($sql) as $row ){
	$oldest = $row["id"];
	}
	$sql = "DELETE FROM visitaton WHERE id='$oldest'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	}
	    	echo "sent_success";
			exit();
		} else {
			echo "Sorry Your Message Was Not Sent";
			exit();
		}
     exit();
}
?><?php
// AJAX CALLS THIS CODE TO EXECUTE
if (isset($_POST['action']) && $_POST['action'] == "a_contact"){
	//sleep(3);
	$n = $_POST['n'];
	$e = $_POST['e'];
	$mob = $_POST['mob'];
	$m =  $_POST['m'];
	$ae = $_POST['ae'];
	if (filter_var($e, FILTER_VALIDATE_EMAIL) == false) {
    echo '<span style="" class="fa fa-envelope-o"> Please Provide a valid email address</span>';
	exit();
	}else if ( !preg_match ("/^([0-9]+)$/", $mob)) {
       echo '<span  class="fa fa-envelope-o"> Mobile Number must be Numeric Only </span>';
	    exit();
    }	$sql = "SELECT first_name, mainemail FROM users WHERE email='$ae' LIMIT 1";
        foreach( $db->query($sql) as $row ){
	$agent_name = $row["first_name"];
	$agent_email = $row["mainemail"];
	}
		///////////////////////////
	  // $to = "jc.computers.ng@gmail.com,jc.softworld@gmail.com";
		$to = ''.$agent_email.'';							 
		$from = "enquiry@mycampushomes.com";
		$subject = "".$e." Contact";
   $text_message = " Making Campus Life to be at Ease <br/>www.mycampushomes.com";      
   // HTML email starts here
   $message  = "<html><body>";
   
   $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
   
   $message .= "<tr><td>";
   
   $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
   
   $message .= "<thead>
      <tr height='80'>
       <th colspan='4' style='background-color:#00a2d1; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#fff; font-size:25px;' > My Advert Visitors Enquiry Update</th>
      </tr>
      </thead>";
		$message .= "<tbody>
       <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#f5f5f5; text-align:center;'><a href='http://www.mycampushomes.com' style='color:#333;font-size:20px; text-decoration:none;'><u> ".$agent_name." </u></a></td>
	   </tr>
	   <tr>
       <td colspan='4' style='padding:15px;'>
       <p><span style='font-size:17px;'> 
	   <h4> Hello ".$agent_name." You Have a New Enquiry</h4><p></p><p> Name : ".$n." </p><p>Email: ".$e."</p> </p><p> Mobile: ".$mob."</p> <p>Message : ".$m."</p>
        <hr/>	 
	   <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#00a2d1;font-size:20px; text-align:center;'><a href='http://www.mycampushomes.com' style='color:#fff; text-decoration:none;' > Visit My Campus Home</a></td>
	   </tr>
	   <tr>
	   <td>
		<p align='center' style='font-size:15px; text-align:center; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
       </td>
      </tr>
      <tr height='80'>
       <td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:16px; '>
	   <label>
	   copyright @ mycampushomes.com,  
       
       </label>
       </td>
      </tr>
      </tbody>"; 
   $message .= "</table>";
   $message .= "</td></tr>";
   $message .= "</table>";
   $message .= "</body></html>";
   $headers = "From: $from\n";
   $headers .= "MIME-Version: 1.0\n";
   $headers .= "Content-type: text/html; charset=iso-8859-1\n";
 if(mail($to, $subject, $message, $headers)) {
	////////////////////
	// INSERT Into Dbase
$sql = "INSERT INTO message (receiver, sender, mobile, email, message, sent_time) 
		VALUES(:ae, :n, :mob, :e, :m, now())";
$stmt = $db->prepare($sql);
$stmt->bindParam(':ae', $ae);
$stmt->bindParam(':n', $n);
$stmt->bindParam(':mob', $mob);
$stmt->bindParam(':e', $e);
$stmt->bindParam(':m', $m);
$stmt->execute();
	/////////////////////////////////////////Delete Excess	
	$res = $db->query("SELECT COUNT(id) FROM message WHERE receiver='$ae'");
	$row = $res->fetchColumn();
	if ($row[0] > 6){ // If they have 20 or more posts of type a
		// (you can auto flush for post types c and b if you wish to also)
		$sql = "SELECT id FROM message WHERE receiver='$ae' ORDER BY id ASC LIMIT 1";
        foreach( $db->query($sql) as $row ){
	$oldest = $row["id"];
	}
	$sql = "DELETE FROM message WHERE id='$oldest'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	}
	    	echo "sent_success";
			exit();
		} else {
			echo "Sorry Your Message Was Not Sent";
			exit();
		}
     exit();
}
?><?php
// AJAX CALLS THIS CODE TO EXECUTE
if (isset($_POST['action']) && $_POST['action'] == "contact_us"){
	//sleep(3);
	$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	$name = $_POST['name'];
	$e = $_POST['email'];
	$subject = $_POST['subject'];
	$textarea =  $_POST['textarea'];
	if (filter_var($e, FILTER_VALIDATE_EMAIL) == false) {
    echo '<span style="" class="fa fa-envelope-o"> Please Provide a valid email address</span>';
	exit();
	}	
		///////////////////////////
	  // Email Sending Script
	  // $to = "jc.computers.ng@gmail.com,jc.softworld@gmail.com";
		$to = '$contact@mycampushomes.com';							 
		$from = "Contact Us @mycampushomes.com";
		$subject = "Enquiry";
		
   $text_message = " Making Campus Life to be at Ease <br/>www.mycampushomes.com";      
   // HTML email starts here
   $message  = "<html><body>";
   
   $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
   
   $message .= "<tr><td>";
   
   $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
   
   $message .= "<thead>
      <tr height='80'>
       <th colspan='4' style='background-color:#00a2d1; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#fff; font-size:25px;' > My Campus Home Contact Us Form </th>
      </tr>
      </thead>";
    
   $message .= "<tbody>
       <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#f5f5f5; text-align:center;'><a href='http://www.mycampushomes.com' style='color:#333;font-size:20px; text-decoration:none;'><u> ".$subject." </u></a></td>
	   </tr>
	   
	   <tr align='center' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#f5f5f5; text-align:center;'>
		
       </td>
      </tr>
	   
	   <tr>
       <td colspan='4' style='padding:15px;'>
       <p><span style='font-size:17px;'> 
	   
	   <h4> Hello You Have a New Enquiry</h4><p></p><p> Name : ".$name." </p><p>Email: ".$e."</p> </p><p> Subject: ".$subject."</p> <p>Message : ".$textarea."</p>
        <hr />	 
	   <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
       <td style='background-color:#00a2d1;font-size:20px; text-align:center;'><a href='http://www.mycampushomes.com' style='color:#fff; text-decoration:none;' > Visit My Campus Home</a></td>
	   </tr>
	   <tr>
	   <td>
		<p align='center' style='font-size:15px; text-align:center; font-family:Verdana, Geneva, sans-serif;'>".$ip.".</p>
       </td>
      </tr>
      
      <tr height='80'>
       <td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:16px; '>
	   <label>
	   copyright @ mycampushomes.com,
       </label>
       </td>
      </tr>
      </tbody>"; 
   $message .= "</table>";
   $message .= "</td></tr>";
   $message .= "</table>";
   $message .= "</body></html>";
   $headers = "From: $from\n";
   $headers .= "MIME-Version: 1.0\n";
   $headers .= "Content-type: text/html; charset=iso-8859-1\n";
 if(mail($to, $subject, $message, $headers)) {
	    	echo "message_success";
			exit();
		} else {
			echo "Sorry Your Message Was Not Sent";
			exit();
		}
     exit();
}
?>