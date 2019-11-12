<?php
include_once("adm/inc/check_login_status.php");
	$model_list='';
	$sql = "SELECT * FROM model";
foreach( $db->query($sql) as $row ) {
   	$id = $row["id"];
   	$name = $row["name"];
    $year = $row["year"];
	$model_list .='<option value="'.$id.'"> '.$name.' - '.$year.' </option>';
}
?>
<!DOCTYPE html>
<!--[if IE 7 ]>  <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>  <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>  <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!-- Meta -->
<html lang="en">
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<!-- Page Title Here -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="" />
<meta name="author" content="" />
<meta name="robots" content="" />
<meta name="description" content="" />
<meta property="og:description" content="" />
<meta property="og:image" content="social-image.png" />
<meta name="format-detection" content="telephone=no">
<!-- Favicons Icon -->
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<!-- Page Title Here -->
<title>Car Expert System</title>
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
	<![endif]-->
<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/fontawesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/flaticon/css/flaticon.min.css">
<link rel="stylesheet" type="text/css" href="plugins/themify/themify-icons.css">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
<link rel="stylesheet" type="text/css" href="css/animate.min.css">
<link rel="stylesheet" type="text/css" href="plugins/rangeslider/rangeslider.css">
<link rel="stylesheet" type="text/css" href="plugins/scroll/scrollbar.min.css">
<link rel="stylesheet" type="text/css" href="css/style.min.css">
<link rel="stylesheet" type="text/css" href="css/templete.css">
<link class="skin" rel="stylesheet" type="text/css" href="css/skin/skin-1.css">
<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Open+Sans:300,400,600,700,800|Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">

<!-- Google Analytic Code -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120204426-2"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-120204426-2');
	</script>
<!-- Google Analytic Code --><!-- Revolution Slider Css -->
<link rel="stylesheet" type="text/css" href="plugins/revolution/v5.4.3/css/settings.css">
<!-- Revolution Navigation Style -->
<link rel="stylesheet" type="text/css" href="plugins/revolution/v5.4.3/css/navigation.css">	
</head>
<body id="bg">

<div class="page-wraper">
<div id="loading-area"></div>
    <!-- header -->
    <header class="site-header header-transparent">
		<div class="top-bar">
			<div class="container">
				<div class="row">
					<div class="dlab-topbar-left">
						<ul>
							<li><a href="#"> Ask a Question</a></li>
						</ul>
					</div>
					<div class="dlab-topbar-right topbar-social">
						<ul>
							<li>
								<a href="javascript:void(0);"><i class="fa fa-envelope-o"></i> Support@carexpert.com</a>
							</li>
							<li><a href="#" class="site-button-link facebook hover"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="site-button-link google-plus hover"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#" class="site-button-link twitter hover"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="site-button-link linkedin hover"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- main header -->
        <div class="sticky-header main-bar-wraper">
            <div class="main-bar clearfix ">
                <div class="container clearfix">
                    <!-- website logo -->
                    <div class="logo-header mostion">
						<a href="."><img src="images/logo-light.png" class="logo" alt=""></a>
					</div>
                    <!-- nav toggle button -->
                    <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed" aria-expanded="false" > 
						<i class="fa fa-bars"></i>
					</button>
                    <!-- extra nav -->
                    <div class="extra-nav">
                        <div class="extra-cell">
                            <button id="quik-search-btn" type="button" class="site-button-link"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <!-- Quik search -->
                    <div class="dlab-quik-search bg-primary ">
                        <form action="#">
                            <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                            <span id="quik-search-remove"><i class="fa fa-close"></i></span>
                        </form>
                    </div>
                    <!-- main nav -->
                    <div class="header-nav navbar-collapse collapse">	
						<ul class="nav navbar-nav">
							<li class="active has-mega-menu demos"> <a href=".">Home</a></li>
							<li><a href="javascript:;">Account<i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li> <a href="adm/sign-up">Sign Up <i class="fa fa-angle-right"></i></a></li>
									<li> <a href="adm/login">Login <i class="fa fa-angle-right"></i></a></li>
											
							</li>
							
						
						</ul>
					</div>
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
    <!-- header END -->
    <!-- Content -->
    <div class="page-content">
        <!-- Slider -->
        <div class="main-slider style-two default-banner">
            <div class="tp-banner-container">
                <div class="tp-banner" >
                    <div id="dz_rev_slider_4_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="news-gallery36" data-source="gallery" style="margin:0px auto;background-color:#ffffff;padding:0px;margin-top:0px;margin-bottom:0px;">
                        <!-- START REVOLUTION SLIDER 5.3.0.2 fullwidth mode -->
                        <div id="dz_rev_slider_4" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.3.3">
                            <ul>
                                <!-- SLIDE 1 -->
                                <li data-index="rs-6" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="revolution/assets/100x50_3176d-road-bg.jpg"  data-rotate="0"  data-savepresentation="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="images/main-slider/slide1.jpg"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                    <!-- LAYERS -->
                                    <!-- LAYER NR. 1 -->
									<div class="tp-caption   tp-resizeme" 
										id="slide-2957-layer-5" 
										data-x="502" 
										data-y="center" 
										data-voffset="130" 
										data-width="['none','none','none','none']"
										data-height="['none','none','none','none']"
										data-transform_idle="o:1;"
										data-transform_in="x:50px;opacity:0;s:1500;e:Power3.easeOut;" 
										data-transform_out="opacity:0;s:300;" 
										data-start="1200" 
										data-responsive_offset="on" 
										style="z-index: 11;">
											<img src="images/car2.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> 
									</div>	
                                </li>
                                <!-- SLIDE 2 -->
								<!-- SLIDE  -->
                                <li data-index="rs-5" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="revolution/assets/100x50_3176d-road-bg.jpg"  data-rotate="0"  data-savepresentation="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="images/main-slider/slide2.jpg"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                    <!-- LAYERS -->
                                    <!-- LAYER NR. 1 -->
									<div class="tp-caption   tp-resizeme" 
										id="slide-2957-layer-4" 
										data-x="502" 
										data-y="center" 
										data-voffset="130" 
										data-width="['none','none','none','none']"
										data-height="['none','none','none','none']"
										data-transform_idle="o:1;"
										data-transform_in="x:50px;opacity:0;s:1500;e:Power3.easeOut;" 
										data-transform_out="opacity:0;s:300;" 
										data-start="1200" 
										data-responsive_offset="on" 
										style="z-index: 11;">
											<img src="images/car3.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> 
									</div>	
                                </li>
                                
                            </ul>
                            <div class="tp-bannertimer tp-bottom bg-primary" style="height: 5px; "></div>
                        </div>
                    </div>
                    <!-- END REVOLUTION SLIDER -->
                </div>
            </div>
			<!-- Form -->	
			<div class="form-slide setResizeMargin">
				<form class="search-car" action="#" onsubmit="return false" method="post">
					<div class="form-head">
						<h2>Get the right Solution</h2>
					</div>
					<!-- TABS -->
					<div class="form-find-area">
						<ul class="nav theme-tabs">
							<li style="width: 100%" role="presentation" class="active"><a data-toggle="tab"  aria-controls="new-car"  href="#new-car">Ask Expert</a></li>
						
						</ul>
						<div class="tab-content">
							<!-- NEW CAR -->
							<div id="new-car"  class="tab-pane active clearfix">
                                
                            <ul class="nav text-center check-nav">  

                                    <li>
										<input id="radio1" type="radio" name="new_search" checked="checked" value="budget"/>
										<label for="radio1">Mercedes benz</label>
									</li>
                                
                          
                            
                                </ul>
                
								<div  id="budgetDiv" class="new_form_div">
									<div class="input-group">
										<select class="form-control" id="model" onchange="loadsymptoms()">
                                            <option value=""> Select Car Model </option>
                                            <?php echo $model_list;?>
										</select>
                                    </div>
                                    
                                    
									<div class="input-group">
                                    <span id="symptom_loader" style="color:orange"></span>
                                            <div id="span_symp">
                                        <select class="form-control" id="symptoms_cont"  onchange="loadproblem()"> <option>   Select Models First </option>	</select>
                                    </div>
									</div>


									<div class="input-group">
                                            <div id="span_prob">
										<select class="form-control" id="problem">
											<option value=""> Select Symptoms First</option>
                                        </select>
                                        </div>
                                    </div>                

								</div>
																
                                        <a href="#" data-toggle="modal" id="open-modal" data-target="#basicExampleModal2" class="property__link">
                                                <i class="ion-android-share-alt property__icon"></i> </a> 
								<div class="input-group">
									<button class="site-button button-lg btn-block" type="submit" id="btn_solution" onclick="getsolution()"> Get Solution </button>
								</div>
				
							</div>
							<!-- USED CAR -->
							
						</div>
					</div>
				</form>
			</div>	
			<!-- Form END -->	
	   </div>
        <!-- Slider END -->
		<!-- New Car -->
			
		<!-- About Us -->
		
		<!-- About Us END -->
		<!-- For Your Quick Look -->
        
        <!-- For Your Quick Look END -->
		<!-- Car Find And Sale -->
        
		<!-- Testimonial -->
        
        <!-- Latest News -->
	
		<!-- Latest News END-->
		
		<!-- Client logo Carousel -->
		<div class="section-full bg-img-fix p-t30 p-b30 ">
			<div class="container">
				<div class="section-content">
					<div class="client-logo-carousel owl-carousel mfp-gallery gallery owl-btn-center-lr">
						<div class="item">
							<div class="ow-client-logo">
								<div class="client-logo"><a href="#"><img src="images/client-logo/logo1.jpg" alt=""></a></div>
							</div>
						</div>
						<div class="item">
							<div class="ow-client-logo">
								<div class="client-logo"> <a href="#"><img src="images/client-logo/logo2.jpg" alt=""></a> </div>
							</div>
						</div>
						<div class="item">
							<div class="ow-client-logo">
								<div class="client-logo"> <a href="#"><img src="images/client-logo/logo3.jpg" alt=""></a> </div>
							</div>
						</div>
						<div class="item">
							<div class="ow-client-logo">
								<div class="client-logo"> <a href="#"><img src="images/client-logo/logo4.jpg" alt=""></a> </div>
							</div>
						</div>
						<div class="item">
							<div class="ow-client-logo">
								<div class="client-logo"> <a href="#"><img src="images/client-logo/logo5.jpg" alt=""></a> </div>
							</div>
						</div>
						<div class="item">
							<div class="ow-client-logo">
								<div class="client-logo"> <a href="#"><img src="images/client-logo/logo2.jpg" alt=""></a> </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Client logo Carousel END -->
		<!-- Content END-->
    </div>
    <!-- Footer -->
    		    <footer class="site-footer">
        <div class="footer-top">
             <div class="container">
                
				<div class="clearfix">
					<ul class="full-social-icon clearfix">
						<li class="fb col-md-3 col-sm-6 col-xs-6 m-b30">
							<a href="#"><i class="fa fa-facebook"></i> Share On Facebook </a>
						</li>
						<li class="tw col-md-3 col-sm-6 col-xs-6 m-b30">
							<a href="#"><i class="fa fa-twitter"></i> Tweet About it </a>
						</li>
						<li class="gplus col-md-3 col-sm-6 col-xs-6 m-b30">
							<a href="#"><i class="fa fa-google-plus"></i> Google Plus | 78+ </a>
						</li>
						<li class="linkd col-md-3 col-sm-6 col-xs-6 m-b30">
							<a href="#"><i class="fa fa-linkedin"></i> Linkedin | 21k </a>
						</li>
					</ul>
				</div>
            </div>
        </div>
        <!-- footer bottom part -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 text-left"> © carexpert Developed By <span class="text-primary"> samuel</span> </div>
                    <div class="col-md-6 col-sm-6 text-right "> 
						<a href=""> About Us</a> | 
						<a href=""> Contact Us</a> | 
						<a href=""> Privacy Policy</a> 
					</div>
                </div>
            </div>
        </div>
    </footer>
    
<!-- Modal -->
<div class="modal fade" id="basicExampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <div class="modal-header" style="background-color: rgb(168, 14, 14);">
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
    <!-- Footer END-->
    <!-- scroll top button -->
    <button class="scroltop fa fa-chevron-up" ></button>
</div>
<!-- JavaScript  files ========================================= -->
			<script src="js/combine.js"></script>	<script src="js/wow.js"></script>
	<!-- wow.min js -->
	<script src="js/dz.ajax.js"></script>
<!-- revolution JS FILES -->
<script src="plugins/revolution/v5.4.3/js/jquery.themepunch.tools.min.js"></script>
<script src="plugins/revolution/v5.4.3/js/jquery.themepunch.revolution.min.js"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="plugins/revolution/v5.4.3/js/extensions/revolution.extension.actions.min.js"></script>
<script src="plugins/revolution/v5.4.3/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="plugins/revolution/v5.4.3/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="plugins/revolution/v5.4.3/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="plugins/revolution/v5.4.3/js/extensions/revolution.extension.migration.min.js"></script>
<script src="plugins/revolution/v5.4.3/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="plugins/revolution/v5.4.3/js/extensions/revolution.extension.video.min.js"></script>
<script src="plugins/revolution/v5.4.3/js/extensions/revolution.extension.slideanims.min.js"></script>
<script  src="js/rev.slider.js"></script>

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
    var ajax = ajaxObj("POST", "aj/proccess.php");
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
            var ajax = ajaxObj("POST", "aj/proccess.php");
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
            dispay.innerHTML = '<div align="center"> Loading Posible Solutions.. <br/><img src="images/ajax-loader12.gif"></div>';
            _('open-modal').click();	
            var ajax = ajaxObj("POST", "aj/proccess.php");
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
                

<!-- custom fuctions  -->
<script>
jQuery(document).ready(function() {
	var dzrevapi;
    var dzQuery =jQuery;
	 if(dzQuery("#dz_rev_slider_3").revolution == undefined){
		revslider_showDoubleJqueryError("#dz_rev_slider_4");
	}else{
		dzrevapi = dzQuery("#dz_rev_slider_4").show().revolution({
			sliderType:"standard",
			jsFileLocation:"//carzone.dexignlab.com/xhtml/plugins/revolution/v5.4.3/js/",
			sliderLayout:"fullwidth",
			dottedOverlay:"none",
			delay:9000,
			navigation: {
				  keyboardNavigation:"off",
				  keyboard_direction: "horizontal",
				  mouseScrollNavigation:"off",
								 mouseScrollReverse:"default",
				  onHoverStop:"off",
				  bullets: {
					enable:true,
					hide_onmobile:false,
					style:"hermes",
					hide_onleave:false,
					direction:"horizontal",
					h_align:"center",
					v_align:"bottom",
					h_offset:0,
					v_offset:20,
									space:10,
					tmp:''
				  }
				},
			responsiveLevels:[1240,1024,778,480],
			visibilityLevels:[1240,1024,778,480],
			gridwidth:[1240,1024,778,480],
			gridheight:[800,700,750	,800],
			lazyType:"none",
			parallax: {
				type:"scroll",
				origo:"enterpoint",
				speed:400,
				levels:[5,10,15,20,25,30,35,40,45,50,46,47,48,49,50,55],
				type:"scroll",
			},
			shadow:0,
			spinner:"off",
			stopLoop:"off",
			stopAfterLoops:-1,
			stopAtSlide:-1,
			shuffle:"off",
			autoHeight:"off",
			hideThumbsOnMobile:"off",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				nextSlideOnWindowFocus:"off",
				disableFocusListener:false,
			}
		});
	}	
});	/*ready*/
</script>
</body>

</html>