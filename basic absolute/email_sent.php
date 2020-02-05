<?php
require_once("class/config.inc.php");
require_once("class/class.post.php");
extract($_REQUEST);
$ajax=new PHPLiveX();
$auth = new Authentication();
$notice = new Notification();
$allpost = new Manage_post();
$home =  new Homepage();
$user = new User();
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
				
				<?php
					if($_SESSION['id']=='')
					{
                    $home->Top_Login_Header();
					}
					else
					{
					$home->Top_User_Header();
					}
				?><!-- .login_social -->
			
				<?php $home->logo('text'); ?><!--/ #logo-->
			
				<nav id="kids_main_nav">
					<div class="menu-button">
						<span class="menu-button-line"></span>
						<span class="menu-button-line"></span>
						<span class="menu-button-line"></span>
					</div>
					<?php $home->Main_Menu();?>				
				</nav><!-- #kids_main_nav -->
				<div class="kids_clear"></div>
			</div><!--/ .l-page-width--> 
			
		</header><!--/ #kids_header-->               
		
	</div><!-- .bg-level-1 -->

	<div id="kids_middle_container">

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
					

					<div class="entry-container">

						<div id="post-content">
                        
						<?php /*?><div class="one_half">

							<h1>Login</h1>

							<?php
							if($submited2=='Login')
							{
								$user->Login('server','loginpage');
							}
							else
							{
								$user->Login('local','loginpage');
							}
							
							
							?>

						</div><?php */?>
                        
                        
                        <div class="one_half">

							<h1>Confirmation Message</h1>
							<p>A Confirmation Email Has Been Send To Your Email Click the Link On the Confirm Email to activate your Account.</p>

							<!--/ highlighter -->

						</div>
                        
                        
                        </div>


						<!--/ sidebar-right-->

						<div class="kids_clear"></div>   

					</div><!-- .gallery_container -->

				</section><!-- .bottom_content_container -->

				<div class="bg-level-2-left" id="bg-level-2-left"></div> <!-- .left_patterns -->
				<div class="bg-level-2-right" id="bg-level-2-right"></div><!-- .right_patterns -->

			</div>

		</div>

	</div><!-- .end_content -->
        
	<?php $home->footer(); ?><!-- .kids_bottom_container -->

	<?php /*?><div id="kids_theme_control_panel">
		<a href="#" id="kids_theme_control_label"></a>
	</div><?php */?><!-- #kids_theme_control_panel -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
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