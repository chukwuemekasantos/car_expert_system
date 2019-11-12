
        <?php include ("inc/header.php");?>
		<?php
		$res = $db->query("SELECT COUNT(*) AS id FROM model");
		$model_mum = $res->fetchColumn();
		$res = $db->query("SELECT COUNT(*) AS id FROM symptoms");
		$symptoms_mum = $res->fetchColumn();
		$res = $db->query("SELECT COUNT(*) AS id FROM problems");
		$problems_mum = $res->fetchColumn();
		$res = $db->query("SELECT COUNT(*) AS id FROM solutions");
		$solutions_mum = $res->fetchColumn();
	
		$model_list='';
	$sql = "SELECT * FROM model";
foreach( $db->query($sql) as $row ) {
   	$id = $row["id"];
   	$name = $row["name"];
    $year = $row["year"];
	$model_list .='<option value="'.$id.'"> '.$name.' - '.$year.' </option>';
}
?>	<?php
$notification_list='';
$sql = "SELECT * FROM notification";
foreach( $db->query($sql) as $row ) {
   $id = $row["id"];
   $message = $row["message"];
$notification_list .='<a class="dropdown-item" href="#"><span class="ti-comment-alt"></span> '.$message.' </a>';
}
?>
		<!-- Page Content -->
		<div id="content">
			<!-- Top Navigation -->
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<span class="ti-menu" id="sidebarCollapse"></span>
					</div>
					<ul class="nav justify-content-end">
						<li class="nav-item">
							<a class="nav-link" data-toggle="modal" data-target=".lorvens-modal-lg">
								<span class="ti-search"></span>
							</a>
							<div class="modal fade lorvens-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lorvens">
									<div class="modal-content lorvens-box-shadow">
										<div class="modal-header">
											<h5 class="modal-title">Serach Client/Project:</h5>
											<span class="ti-close" data-dismiss="modal" aria-label="Close">
											</span>
										</div>
										<div class="modal-body">
											<form>
												<div class="form-group">
													<input type="text" class="form-control" id="search-term" placeholder="Type text here">
													<button type="button" class="btn btn-lorvens lorvens-bg">
														<span class="ti-location-arrow"></span> Search</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
								<span class="ti-announcement"></span>
							</a>
							<div class="dropdown-menu lorvens-box-shadow notifications animated flipInY">
								<h5>Notifications</h5>
								<?php echo $notification_list;?>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
								<span class="ti-user"></span>
							</a>
							<div class="dropdown-menu lorvens-box-shadow profile animated flipInY">
								<h5><?php echo $username; ?></h5>
								<a class="dropdown-item" href="logout">
									<span class="ti-power-off"></span> Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<!-- /Top Navigation -->
			<!-- Breadcrumb -->
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="index-2.html">
						<span class="ti-home"></span>
					</a>
				</li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
			<!-- /Breadcrumb -->
			<!-- Main Content -->
			<div class="container-fluid home">

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-3">
						<div class="widget-area lorvens-box-shadow color-red">
							<div class="widget-left">
									<span class="ti-car"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Total Mercedese Models</h4>
								<span class="numeric color-red"><?php echo $model_mum;?></span>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-md-3">
						<div class="widget-area lorvens-box-shadow color-blue">
							<div class="widget-left">
                                    <span class="ti-thumb-up"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title"> Total Symptoms</h4>
								<span class="numeric color-blue"><?php echo $symptoms_mum;?></span>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-md-3">
						<div class="widget-area lorvens-box-shadow color-green">
							<div class="widget-left">
								<span class="ti-bar-chart"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Posible Problem</h4>
								<span class="numeric color-green"><?php echo $problems_mum;?></span>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-md-3">
						<div class="widget-area lorvens-box-shadow color-yellow">
							<div class="widget-left">
								<span class="ti-thumb-up"></span>
							</div>
							<div class="widget-right">
								<h4 class="wiget-title">Posible Solutions</h4>
								<span class="numeric color-yellow"><?php echo $solutions_mum;?></span>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
		
				
		
				
		
				<div class="row">

						<div class="col-md-12">
								<div class="widget-area-2 lorvens-box-shadow">
									<!-- Form Item -->
									<h3 class="widget-title">Mercedes benz Expert System</h3>
									

									<div class="lorvens-widget">
				
				<form onsubmit="return false">
						<div class="form-group">
								<label for="exampleInputEmail1">Car Model</label>
								<select class="form-control" id="model" onchange="loadsymptoms()">
									<option value=""> Select Car Model </option>
									<?php echo $model_list;?>
								</select>
							</div>
       
							<div class="form-group">
									<label for="exampleInputEmail1">Symptoms</label>
								<div id="span_symp">
                                        <select class="form-control" id="symptoms_cont"  onchange="loadproblem()"> <option>   Select Models First </option>	</select>
                                    </div>
									</div>

									
									<div class="form-group">
											<label for="exampleInputEmail1">Posible Problem</label>
                                            <div id="span_prob">
										<select class="form-control" id="problem">
											<option value=""> Select Symptoms First</option>
                                        </select>
                                        </div>
                                    </div>                


									<a href="#" data-toggle="modal" id="open-modal" data-target="#basicExampleModal2" class="property__link">
											<i class="ion-android-share-alt property__icon"></i> </a> 
								
									<button type="submit" class="btn btn-primary" id="btn_solution" onclick="getsolution()"> Get Solution </button>
								</form>

									</div></div></div>

				</div>		
			</div>
			<!-- /Main Content -->
		</div>
		<!-- /Page Content -->
	</div>
	
<script src="js/main1.js"></script>
<script src="js/ajax.js"></script>

<script> 
function restrict(elem){
var tf = _(elem);
var rx = new RegExp;
if(elem == "email"){
    rx = /[' "]/gi;
} else if(elem == "address"){
rx = /[^a-z 0-9():><+-@#$'"%\|\_/]/gi;
}
tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
_(x).innerHTML = "";
}
</script>



<script> 
function loadsymptoms(){
var m = _("model").value;
var symptom = _("span_symp");
// sad swart 
if(m == ""){
    alert("Please Select Model"); 
}else{
    symptom.innerHTML = 'Loading.. <img src="images/loading3.gif">';
    var ajax = ajaxObj("POST", "../aj/proccess.php");
    ajax.onreadystatechange = function() {
        if(ajaxReturn(ajax) == true) {
    var datArray = ajax.responseText.split("|");	
    if(datArray[0] == "loaded_symtoms"){
      symptom.innerHTML = datArray[1];
}else if(datArray[0] != "loaded_symtoms"){
    alert(ajax.responseText);
            }
      }
    }
    ajax.send("action=load_symptom&m="+m);
}
}
</script>

<script> 
        function loadproblem(){
        var s = _("symptoms").value;
        var problem = _("span_prob");
        // sad swart 
        if(s == ""){
            alert("Please Select Symptoms"); 
        }else{
            problem.innerHTML = 'Loading.. <img src="images/loading3.gif">';
            var ajax = ajaxObj("POST", "../aj/proccess.php");
            ajax.onreadystatechange = function() {
                if(ajaxReturn(ajax) == true) {
            var datArray = ajax.responseText.split("|");	
            if(datArray[0] == "loaded_problems"){
                problem.innerHTML = datArray[1];
        }else if(datArray[0] != "loaded_problems"){
            alert(ajax.responseText);
                    }
              }
            }
            ajax.send("action=load_problems&s="+s);
        }
        }
        </script>
        
<script> 
        function getsolution(){
        var p = _("problem").value;
        var dispay = _("display_solution");
        var btn = _("btn_solution");
        // sad swart 
        if(p == ""){
            alert("No Posible Problem Selected"); 
        }else{
			
         dispay.innerHTML = '<div align="center"> Loading Posible Solutions.. <img src="images/ajax-loader12.gif"></div>';
            _('open-modal').click();	
            var ajax = ajaxObj("POST", "../aj/proccess.php");
            ajax.onreadystatechange = function() {
                if(ajaxReturn(ajax) == true) {
            var datArray = ajax.responseText.split("|");	
            if(datArray[0] == "loaded_solutions"){
                dispay.innerHTML = datArray[1];
        }else if(datArray[0] != "loaded_solutions"){
            alert(ajax.responseText);
                    }
              }
            }
            ajax.send("action=load_solution&p="+p);
        }
        }
        </script>
        <script>
                function triggerUpload(e,elem){
                    e.preventDefault();
                    _(elem).click();	
                }
                </script>
				
<!-- Modal -->
<div class="modal fade" id="basicExampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <span class="modal-title text-center" id="exampleModalLabel"><i class="fa fa-envelope-o"></i> Posible Solutions  </span>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

   
    <div class="input-group" id="display_solution">

  </div>

    
    </div>
    <div class="modal-footer">
        
        <button type="button" class="btn btn-danger btn-sm btn-secondary" data-dismiss="modal"> Close <i class="fa fa-times"></i></button>
      </div>
  
  </div>
  </div>
      </div>
	<?php include ("inc/footer.php");?>