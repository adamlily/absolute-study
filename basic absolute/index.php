<?php
ob_start();
require_once("class/config.inc.php");
extract($_REQUEST);
$auth = new Authentication();
$notice = new Notification();
$ajax=new PHPLiveX();
$user = new User();
$ajax->AjaxifyObjects(array("user")); 
$rpage='index';
$home =  new Homepage();
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html lang="en" class="ie7 oldie"></html><![endif]--><!--[if IE 8]>
<html lang="en" class="ie8 oldie"></html><![endif]-->
<!-- [if gt IE 8] <!-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if IE 9]>					<html class="ie9 no-js" lang="en">     <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->	<html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>
	<link href='http://fonts.googleapis.com/css?family=Salsa|Rancho|Jockey+One|Oswald|Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
	<meta charset="utf-8" />	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php $home->websiteTitle('Student Development Portal'); ?></title>
	
	<link rel="stylesheet" href="css/styles.css" />
	<link rel="stylesheet" href="css/camera.css" />
	<link rel="stylesheet" href="css/video-js.css" />
	<link rel="stylesheet" href="css/prettyPhoto.css" /><!-- HTML5 Shiv -->
	<link rel="stylesheet" href="css/flexnav.css" />
	<link rel="stylesheet" href="themeChanger/css/colorpicker.css" />
	<link rel="stylesheet" href="themeChanger/css/themeChanger.css" />

	<script src="js/modernizr.custom.js"></script>
	<?php $ajax->Run('liveX/phplivex.js'); ?>	
</head>
<body class="t-peachy t-pattern-2 kids-front-page t-menu-1 t-header-1 t-text-1">
	<div id="my-contact-div"><!-- contactable html placeholder --></div>

	<link rel="stylesheet" href="contactable.css" type="text/css" />

	<script type="text/javascript" src="jquery1.7.min.js"></script>
	<script type="text/javascript" src="jquery.contactable.js"></script>

	<script>
		jQuery(function(){
			jQuery('#my-contact-div').contactable(
			{
				subject: 'feedback URL:'+location.href,
				url: 'mail.php',
				name: 'Name',
				email: 'Email',
				dropdownTitle: 'Issue',
				dropdownOptions: ['General', 'About Quiz', 'About Blogs'],
				message : 'Message',
				submit : 'SEND',
				recievedMsg : 'Thank you for your message',
				notRecievedMsg : 'Sorry but your message could not be sent, try again later',
				disclaimer: 'Please feel free to get in touch, we value your feedback',
				hideOnSubmit: true
			});
		});
	</script>
	
	<div class="top-panel">
		<div class="l-page-width">
			
		</div>
		
	</div><!--/ .top-panel-->
	
	<div class="kids-bg-level-1">
		
		<header id="kids_header">
			
			<div class="l-page-width clearfix">
				
				<div class="bg-level-1-left" id="bg-level-1-left"></div>
				<div class="bg-level-1-right" id="bg-level-1-right"></div>
				
			<!-- 	<?php
				if(isset($_SESSION['id']) && $_SESSION['id']=='')
				{
					$home->Top_Login_Header();
				}
				else
				{
					$home->Top_User_Header();
				}
				?><!-- .login_s --><!-- ocial --> -->
				<div class="kids_clear"></div>
				<?php $home->logo(); ?><!--/ #kids_logo_block-->
				
				<nav id="kids_main_nav">
					<div class="menu-button">
						<span class="menu-button-line"></span>
						<span class="menu-button-line"></span>
						<span class="menu-button-line"></span>
					</div>
					<?php $home->Main_Menu('home');?>
				</nav><!-- #kids_main_nav -->
				<div class="kids_clear"></div>
			</div><!--/ .l-page-width--> 
			
		</header><!--/ #kids_header-->     
		
		
		<div class="bg-level-2-page-width-container l-page-width">
			
			<div class="kids_slider_bg">

				<div class="kids_slider_wrapper">

					<div class="kids_slider_inner_wrapper">

						<?php $auth->newlogin(); ?><!-- #camera_wrap -->

					</div><!--/ .kids_slider_inner_wrapper-->

				</div><!--/ .kids_slider_wrapper-->

			</div><!--/ .kids_slider_bg--> 
			
			<br />

			<div class="bg-level-2-left" id="bg-level-2-left"></div>
			<div class="bg-level-2-right" id="bg-level-2-right"></div>
			
		</div><!-- .l-page-width -->
		
	</div><!-- .bg-level-1 -->

	<div id="kids_middle_container">

		<div class="kids_top_content">

			<div class="kids_top_content_head">

				<div class="kids_top_content_head_body"></div>

			</div><!-- .kids_top_content_head -->

			<div class="kids_top_content_middle">
				
				<div class="l-page-width"> 

					<section class="kids_posts_container clearfix">
						
						<?php $home->indexpagebottoms_tab('Personality-Development')?>
						<?php $home->indexpagebottoms_tab('Aptitude-Development')?>
						<?php $home->indexpagebottoms_tab('Interest-Development')?>
						
					</section><!-- .kids_posts_container -->

				</div><!--/ l-page-width-->

			</div><!-- .kids_top_content_middle -->

			<div class="kids_top_content_footer"></div>

		</div><!-- .kids_top_content -->
		

		<div class="kids_bottom_content">
			
			<div class="l-page-width">

				<div class="kids_bottom_content_container clearfix">
					<div class="one_half">	
						<div class="recent_projects">

							<h3 class="section-title">Recent Post</h3>
							<div class="kids_clear"></div>
							<?php $home->Upcoming_Events(); ?><!--/ .projects-carousel -->

						</div><!--/ .work-carousel-->	
					</div>	
					
					<div class="one_half" style="margin-top:47px;">
						<iframe width="560" height="365" src="//www.youtube.com/embed/qU-4TEDg3Hg" frameborder="0" allowfullscreen></iframe>
						
					</div>

				</div><!--/ .kids_bottom_content_container-->
			</div><!--/ .l-page-width-->

		</div><!--/ .kids_bottom_content-->
		
		
	</div><!-- #kids_middle_container -->
	
	<?php $home->footer(); ?><!-- .kids_bottom_container -->
    <!--<div id="kids_theme_control_panel">
		<a href="#" id="kids_theme_control_label"></a>
	</div>--><!-- #kids_theme_control_panel -->
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->

<!--[if lt IE 9]>
	<script src="js/selectivizr-and-extra-selectors.min.js"></script>
<![endif]-->
<script type="text/javascript" src="jst/tweetable.jquery.js"></script>
<script type="text/javascript" src="jst/jquery.timeago.js"></script>
<script type="text/javascript">
	jQuery(function(){
		jQuery('#tweets').tweetable({
			username: 'absolutestudy', 
			time: true,
			rotate: false,
			speed: 4000, 
			limit: 2,
			replies: false,
			position: 'append',
			failed: "Sorry, twitter is currently unavailable for this user.",
			loading: "Loading tweets...",
			html5: true,
			onComplete:function($ul){
				$('time').timeago();
			}
		});
		
	});
</script>
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