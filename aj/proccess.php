<?php
include_once("../adm/inc/check_login_status.php");
$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
?><?php // Load Symtoms
 if (isset($_POST['action']) && $_POST['action'] == "load_symptom"){
	 sleep(2);
	if(!isset($_POST['m']) || $_POST['m'] == ""){
		echo "Model id is missing";
		exit();
	}
	$m = $_POST['m'];
	$res = $db->query("SELECT COUNT(*) AS id FROM symptoms WHERE  model_id = '$m'");
	$check = $res->fetchColumn();
	$symptom_list ='<option value=""> Please Select Symptom </option>';
	if($check>0){
	$sql = "SELECT id, question FROM symptoms WHERE model_id = '$m'";
	foreach( $db->query($sql) as $row) {
	$id= $row["id"];
	$question= $row["question"];
	$symptom_list .='  <option value="'.$id.'"> '.$question.' </option>';
	}
	}else{
	$symptom_list ='<option value=""> No Available Symptoms Yet  </option>';
		}
		echo 'loaded_symtoms|<select class="form-control" id="symptoms"  onchange="loadproblem()"> '.$symptom_list.' </select>';
		exit();
	}
?><?php // Load Symtoms
if (isset($_POST['action']) && $_POST['action'] == "load_problems"){
	sleep(2);
   if(!isset($_POST['s']) || $_POST['s'] == ""){
	   echo "Symptom id is missing";
	   exit();
   }
   $m = $_POST['s'];
   $res = $db->query("SELECT COUNT(*) AS id FROM problems WHERE  symptom_id = '$m'");
   $check = $res->fetchColumn();
   $problem_list ='<option value=""> Please Select Posible Problem </option>';
   if($check>0){
   $sql = "SELECT id, problem FROM problems WHERE symptom_id = '$m'";
   foreach( $db->query($sql) as $row) {
   $id= $row["id"];
   $problem= $row["problem"];
   $problem_list .='  <option value="'.$id.'"> '.$problem.' </option>';
   }
   }else{
   $problem_list ='<option value=""> No Available Symptoms Yet  </option>';
	   }
	   echo 'loaded_problems|<select class="form-control" id="problem"  onchange="loadsolution()"> '.$problem_list.' </select>';
	   exit();
   }
?><?php // Load Symtoms
if (isset($_POST['action']) && $_POST['action'] == "load_solution"){
	sleep(2);
   if(!isset($_POST['p']) || $_POST['p'] == ""){
	   echo "Problem Id Is Missing";
	   exit();
   }
   $m = $_POST['p'];
   $res = $db->query("SELECT COUNT(*) AS id FROM solutions WHERE  problem_id = '$m'");
   $check = $res->fetchColumn();
   $solution_list ='';
   if($check>0){
	   $num=0;
   $sql = "SELECT id, solution FROM solutions WHERE problem_id = '$m'";
   foreach( $db->query($sql) as $row) {
	   $num++;
   $id= $row["id"];
   $solution= $row["solution"];
   $solution_list .='<h3>'.$num.' : '.$solution.'</h3>';
   }
   }else{
   $solution_list =' No Available Solution Yet ';
	   }
	   echo 'loaded_solutions|'.$solution_list.'';
	   exit();
   }
?>