<?php
require_once("class/config.inc.php");
require_once("class/class.post.php");
extract($_REQUEST);
$ajax=new PHPLiveX();
$auth = new Authentication();
$notice = new Notification();
$allpost = new Manage_post();
$home =  new Homepage();
$ajax->AjaxifyObjects(array("home"));
?>
<!DOCTYPE html>
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if IE 9]>					<html class="ie9 no-js" lang="en">     <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->	<html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>
	
	<link href='http://fonts.googleapis.com/css?family=Salsa|Rancho|Jockey+One|Oswald|Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
	<meta charset="utf-8" />
	
	<title><?php $home->websiteTitle('Student Development Portal'); ?></title>
	
	<link rel="stylesheet" href="css/styles.css" />
	<link rel="stylesheet" href="css/camera.css" />
	<link rel="stylesheet" href="css/video-js.css" />
	<link rel="stylesheet" href="css/prettyPhoto.css" />
	<link rel="stylesheet" href="css/flexnav.css" />
	<link rel="stylesheet" href="themeChanger/css/colorpicker.css" />
	<link rel="stylesheet" href="themeChanger/css/themeChanger.css" />
	
	<!-- HTML5 Shiv -->
	<script src="js/modernizr.custom.js"></script>
	<?php $ajax->Run('liveX/phplivex.js'); ?>
</head>
<body class="t-peachy t-pattern-2 kids-front-page t-menu-1 t-header-1 t-text-1">
	
	<div class="top-panel">
		<div class="l-page-width">
			<div class="tweets"></div>
		</div>
	</div><!--/ .top-panel-->	
	
	<div class="kids-bg-level-1">
		
		<header id="kids_header">
			
			<div class="l-page-width clearfix">
				
				<div class="bg-level-1-left" id="bg-level-1-left"></div>
				<div class="bg-level-1-right" id="bg-level-1-right"></div>
				
			<?php /*?>	<?php
					if($_SESSION['id']=='')
					{
                    $home->Top_Login_Header();
					}
					else
					{
					$home->Top_User_Header();
					}
					?><?php */?><!-- .login_social -->
					
					<div id="kids_logo_block" style="margin:13px 0 15px;">
						<a id="kids_logo_text" title="Absolute Study">
							<img src="images/logo.png" alt="" />
						</a>
					</div>
					
					<nav id="kids_main_nav" style="height:215px;">
						<div class="menu-button">
							<span class="menu-button-line"></span>
							<span class="menu-button-line"></span>
							<span class="menu-button-line"></span>
						</div>
						<?php //$home->Main_Menu();?>
					</nav><!-- #kids_main_nav -->
					<div class="kids_clear"></div>
				</div><!--/ .l-page-width--> 
				
			</header><!--/ #kids_header-->           
			
		</div><!-- .bg-level-1 -->

		<div id="kids_middle_container"><!-- .content -->

			<div class="kids_top_content">

				<div class="kids_top_content_head">
					<div class="kids_top_content_head_body"></div>
				</div><!-- .kids_top_content_head -->

				<div class="kids_top_content_middle">

					<div class="l-page-width">     
						<!-- .kids_posts_container -->
					</div>

				</div><!-- .kids_top_content_middle -->

				<div class="kids_top_content_footer"></div>

			</div><!-- .end_middle_cloud  -->

			<div class="bg-level-2-full-width-container kids_bottom_content">
				<div class="bg-level-2-page-width-container l-page-width no-padding">
					<section class="kids_bottom_content_container">
						
						<h3>
                                    <?php //echo $_SESSION['user_ans'];
                                    unset($_SESSION['user_ans']);
                                    
                                    ?>Thank you.
                                    <a target="_blank" href="http://absolute.logimetrix.info/absolute/student_report.php?index=quizreport&examid=<?php echo $_REQUEST['test_Id'];?>" style="color:#000; text-decoration:underline;">View Report</a></h3><!-- .entry-container -->
                                </section><!-- .bottom_content_container -->
                                <div id="bg-level-2-left" class="bg-level-2-left"></div> <!-- .left_patterns -->
                                <div id="bg-level-2-right" class="bg-level-2-right"></div><!-- .right_patterns -->
                            </div>
                        </div>

                    </div><!-- .end_content -->
                    
                    <?php //$home->footer(); ?><!-- .kids_bottom_container -->

	<?php /*?><div id="kids_theme_control_panel">
		<a href="#" id="kids_theme_control_label"></a>
	</div><?php */?><!-- #kids_theme_control_panel -->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<!--[if lt IE 9]>
	<script src="js/selectivizr-and-extra-selectors.min.js"></script>
<![endif]-->
<script src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="js/jquery.easing-1.3.min.js"></script>
<script src="js/camera.min.js"></script>
<script src="js/jquery.jcarousel.min.js"></script>
<script src="js/video.js"></script>
<script src="js/jquery.flexnav.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/jquery.tweet.js"></script>
<script src="js/scripts.js"></script>
<script src="themeChanger/js/colorpicker.js"></script>
<script src="themeChanger/js/themeChanger.js"></script>
</body>
</html>