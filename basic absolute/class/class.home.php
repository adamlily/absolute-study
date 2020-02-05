<?php

class Homepage{
	
	var $user_id;


	function __construct(){
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		$this->validity = new ClsJSFormValidation();
		$this->Form = new ValidateForm();
		$this->auth=new Authentication();
		$this->objMail=new PHPMailer();
		$this->userlogin = new User();
	}
	
	function websiteTitle($subjectString='')
	{
		echo 'Absolute Study '.$subjectString.'';
	}

	function logo($page='')
	{
		?>
		<div id="kids_logo_block" <?php if ($page=='text') { echo 'style="margin: 5px 0 7px;" '; }?> >
			<a id="kids_logo_text" href="index.php" title="Absolute Study">
				<img src="images/logo.png" alt="" />
			</a>
		</div>
		<?php 
		if(isset($_SESSION['id'])=='1'){
			?>	
			<div style=" background:url(images/pencile_div.png) no-repeat; width:300px; height:80px; overflow:hidden; float:right; padding:10px; <?php if ($page=='text') { echo 'margin: 0 0 25px 82px; '; }?> ">
				<div style="margin-top:8px; padding:0px 0px 2px 17px; color:#E3703E; cursor:pointer;" onclick="window.location='login.php'">
					<h1>Register With us</h1>
					<p>And Subscribe for National Quiz ...!!!</p>
				</div>
			</div>
		<?php } ?>
		<?php   
	}

	function CSSforHeader()
	{
		echo 'style="background-attachment: fixed; background-image: url(images/headers/39.jpg); background-position: center top; background-repeat: no-repeat;"';
	}

	function BuyQuizPool($quizId)
	{
		$sql="select * from ".TBL_QUIZ_POOL." where id='1".$quizId."'" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
	  //$row = $this->db->fetch_array($result);
		$x=1;
		?>
		<table class="custom-table2">
			<tr>
				<th width="37">S.No.</th>
				<th width="96">Quiz Pool Name</th>
				<th width="155">Quiz Pool Description</th>
				<th width="63">&nbsp;</th>
			</tr> 
			<?php
			while($row_post= $this->db->fetch_array($result))
			{
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $row_post['quiz_pool_name'];?></td>
					<td><?php echo $row_post['quiz_pool_description'];?></td>
					<td><a class="fancybox" href="#inline1" onclick="javascript: home.sendreuest('<?php echo $row['id'];?>',{ target:'inline1'} ); return false;">Buy</a></td>
				</tr> 
				<?php
				$x++;
			}

			?>
		</table>
		<?php 
	}


	function sendreuest()
	{
		ob_start();
		$FormName = "frm_buyform";
		$ControlNames=array("full_name"        =>array('full_name',"''","Please enter your name","span_full_name"),
			"email"        =>array('email',"EMail","Please enter your email","span_email"),
			"contact"        =>array('contact',"Mobile","Please enter contact number","span_contact")

		);
		$ValidationFunctionName="CheckcategoryValidity";

		$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
		echo $JsCodeForFormValidation;

		?>

		<style>
			.inp
			{
				background: none repeat scroll 0 0 #FAFDFE;
				border: 1px solid #9BC0DD;
				border-radius: 2px 2px 2px 2px;
				height: 28px;
				line-height: 28px;
				padding: 0 10px;
				width:215px;
			}
			.txt
			{
				border: 1px solid #9BC0DD;
				border-radius: 2px 2px 2px 2px;
				font-family: Arial;
				font-size: 13px;

				max-height: 500px;
				min-height: 128px;
				padding: 10px;
				width: 418px !important;
			}
			.but
			{
				background-color: #D5EBF4;
				border-color: #3D7BB3;
				color: #3D7BB3;
				text-shadow: 1px 1px 0 #FFFFFF;
				border-radius: 7px 7px 7px 7px;
				transition: all 0.25s linear 0s;
				font-size: 14px;
				margin-bottom: 1.4em;
				padding: 0.35em 1.7em;
				border-style: solid;
				border-width: 0 1px 1px 0;
				cursor: pointer;
				display: block;
				float: right;
				margin-right:139px;
				font-family: Arial;
				font-style: normal !important;
				line-height: 1.4;
				margin-bottom: 20px;
				margin-top: 0;
				text-align: center;
				text-decoration: none !important;
			}
		</style>
		<?php
		$sql="select * from ".TBL_REGISTER." where user_id='".$_SESSION['id']."'" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$row = $this->db->fetch_array($result);
		?>
		<div id="form1">
			<h1 style="margin-bottom:0px; padding:10px; height:42px;" class="contact-us type-2 widget" >Send A Request</h1>
			<form  method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName;?>">
				<div class="one_half" style="width:250px; float:left; background:#FFA980; padding:10px;">

					<h4 style="margin-bottom:3px! important;">Name:</h4>

					<p style="margin-bottom:1px;">

						<input type="text" name="full_name" class="inp" value="<?php echo $row['username']?>"/>  
						<span style="color:#900;" id="span_full_name"></span>
					</p>



				</div>

				<div class="one_half"  style="width:250px; float:left; background:#FFA980; padding:10px;">

					<h4 style="margin-bottom:3px! important;">Contact No: </h4>

					<p style="margin-bottom:1px;">
						<input type="text" name="contact" class="inp"  value="<?php echo $row['mobile']?>"/> 
						<span style="color:#900;" id="span_contact"></span>
					</p>



				</div>
				<div class="kids_clear"></div>
				<div class="one_half"  style="width:580px; float:left; background:#FFA980; padding:10px;">

					<h4 style="margin-bottom:3px! important;">Email Id: </h4>

					<p style="margin-bottom:1px;">
						<input type="text" name="email"  class="inp" style="width:430px;" value="<?php echo $row['email']?>"/> <br/>
						<span style="color:#900;" id="span_email"></span>

					</p>



				</div>
				<div class="kids_clear"></div>
				<div class="one_half"  style="width:580px; float:left; background:#FFA980; padding:10px;">

					<h4 style="margin-bottom:3px! important;">Details: </h4>

					<p style="margin-bottom:1px;">
						<textarea class="txt" name="details">I want to buy a quiz please contact me.</textarea> 
					</p>


				</div>
				<div class="one_half"  style="width:580px; float:left; background:#FFA980; padding:10px;">



					<p style="margin-bottom:1px;">
						<button value="send" class="but" type="button" onclick=" if(<?php echo $ValidationFunctionName ?>()) { home.submitrequest(this.form.full_name.value,this.form.email.value,this.form.contact.value,this.form.details.value,{target:'form1'}); } ">Confirm Order</button>
					</p>
				</div>

			</form>
		</div>

		<?php
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	function submitrequest($f_name,$email,$cnt,$msg)
	{

		ob_start();

		$this->f_name = $f_name;
		$this->email = $email;
		$this->cnt = $cnt;
		$this->msg = $msg;


		$sql="select * from ".TBL_REGISTER." where user_id='".$_SESSION['id']."'" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$row = $this->db->fetch_array($result);

		$this->objMail->IsHTML(true);
		$this->objMail->From = "info@absolutestudy.com";
		$this->objMail->FromName = "Team Absolute Study";
		$this->objMail->Sender = 'info@absolutestudy.com';
		$this->objMail->AddAddress($row['email']);
		$this->objMail->Subject = 'Order for buy a package form Absolute Study';

		$this->objMail->Body .='<b>This is an auto-generated email. Please do not reply to this email.</b><br/><br/>';
		$this->objMail->Body .='Dear '.$row['username'];
		$this->objMail->Body .= 'Thanks for your interest in Absolute Study. We will contact you soon to confirm the module you want to subscribe with us.<br/><br/>';
		$this->objMail->Body .= 'Kindly note, we will send you a subscription code via mail/SMS once your purchase is confirmed. You can use the code to activate the module.<br/><br/>';
		$this->objMail->Body .= 'Looking forward to associate with you.<br/><br/>';

		$this->objMail->Body .= 'Regards,<br/>';
		$this->objMail->Body .= 'Admin- <a href="http://absolute.logimetrix.info/" style="color:#039; text-decoration:underline;">www.absolute.logimetrix.info</a><br/>';
		$this->objMail->Body .= '<b>Note:-</b> Kindly fill in the feedback form available on our site for any query<br/>';
		$this->objMail->WordWrap = 50;
		$this->objMail->Send();


		$insert_sql_array = array();
		$insert_sql_array['name'] = $this->f_name;
		$insert_sql_array['email'] = $this->email;
		$insert_sql_array['phone'] = $this->cnt;
		$insert_sql_array['details'] = $this->msg;
		$insert_sql_array['date'] = date("Y-m-d");
		$insert_sql_array['user_id'] = $_SESSION['id'];

		$this->db->insert(TBL_PLAN_ORDERS,$insert_sql_array);
		?>
		<div style="background-color:#FFA980; font-size:35px;  color:#385EA7; padding:15px; border-radius:10px; height:350px;">
			Thanks for your interest in absolute study, we will contact you soon.
		</div>
		<?php 

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}


	function getQuizPool()
	{
		$sql="select * from ".TBL_REGISTER." where user_id='".$_SESSION['id']."'" ;
		$result= $this->db->query($sql,__FILE__,__LINE__);
		$row = $this->db->fetch_array($result);
		
		
		?>
		<table class="custom-table2">
			<tr>
				<th width="37">S.No.</th>
				<th width="96">Quiz Pool Name</th>
				<th width="155">Quiz Pool Description</th>
				<th width="63">&nbsp;</th>
			</tr>    
			<?php 
			$x=1;
			$sql_post="select * from ".TBL_CLASS_QUIZ_POOLS." where student_id='".$_SESSION['id']."' ";
			$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
			while($row_post= $this->db->fetch_array($result_post))
			{
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $this->getquizpoolname($row_post['quizpool']);?></td>
					<td><?php echo $this->getquizpooldes($row_post['quizpool']);?></td>
					<td><a href="http://absolute.logimetrix.info/test_start.php?student_id=<?php echo $_SESSION['id'];?>&quizId=<?php echo $row_post['quizpool'];?>" target="_blank">Take Quiz</a></td>
				</tr> 
				<?php
				$x++;
			}
			?>
			</table><?php 

		}

		function getquizpoolname($id)
		{
			$sql="select * from ".TBL_QUIZ_POOL." where id='".$id."'" ;
			$result= $this->db->query($sql,__FILE__,__LINE__);
			$row = $this->db->fetch_array($result);
			return $row['quiz_pool_name'];
		}

		function getquizpooldes($id)
		{
			$sql="select * from ".TBL_QUIZ_POOL." where id='".$id."'" ;
			$result= $this->db->query($sql,__FILE__,__LINE__);
			$row = $this->db->fetch_array($result);
			return $row['quiz_pool_description'];
		}

		function Top_Login_Header()
		{
			?>
			<ul class="kids_social">
				<li style="display:block !important;">


					<!--/ #search-form-->
					<?php
					extract($_REQUEST);

					if($submited=='Sign in')
					{
						$this->userlogin->Login('server');
					}
					else
					{
						$this->userlogin->Login('local');
					}
					?>

				</li>
				<li class="search"><a href="#" title="Login"></a></li>
				<!--<li class="vimeo"><a href="#" title="Vimeo"></a></li>-->
				<li class="twitter"><a href="#" title="Twitter"></a></li>
				<li class="facebook"><a href="#" title="Facebook"></a></li>
				<!--<li class="rss"><a href="#" title="RSS"></a></li>-->
				<li class="openbtn"><a href="#"></a></li>
			</ul>    

			<?php
		}

		function Top_User_Header()
		{
			?>
			<ul class="kids_social">

				<li style="font-size:14px; font-weight:600;">Welcome! --> |</li>

				<li><input type="button" value="My Account" class="button medium button-style2 align-btn-right" onclick="window.location='myaccount.php'" /> | </li>
				<li> <input type="button" class="button medium button-style2 align-btn-right" value="Logout" onclick="window.location='logout.php'" /></li>
				<li class="search"><a href="#" title="Login"></a></li>
				<!--<li class="vimeo"><a href="#" title="Vimeo"></a></li>-->
				<li class="twitter"><a href="#" title="Twitter"></a></li>
				<li class="facebook"><a href="#" title="Facebook"></a></li>
				<!--<li class="rss"><a href="#" title="RSS"></a></li>-->
				<li class="openbtn"><a href="#"></a></li>
			</ul>    

			<?php
		}


		function Advertise_header()
		{
			?>
			<div class="image">
				<a href="#"><img id="ad-728" src="images/banners/728x90_default.png" alt="Advertising" /></a>
			</div>
			<?php
		}

		function Main_Menu($page='')
		{
			?>
			<ul <?php if($page=='home') { echo 'class="clearfix flexnav" data-breakpoint="800"';} else { echo 'class="clearfix flexnav" data-breakpoint="800"';}?>>
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Curriculum</a>
					<ul>
						<?php 
						$sql_cur1="select * from ".TBL_BOARDS." where front='on' order by id asc";
						$result_cur1= $this->db->query($sql_cur1,__FILE__,__LINE__);
						while($row_cur1= $this->db->fetch_array($result_cur1))
						{
							?>
							<li><a href="#"><?php echo $row_cur1['name']; ?></a>
								<ul>
									<?php 
									$sql_cur2="select * from ".TBL_CLASSES." where front='on' and board_id='".$row_cur1['id']."' order by name";
									$result_cur2= $this->db->query($sql_cur2,__FILE__,__LINE__);
								//$row_cur2= mysqli_fetch_assoc($result_cur2);

									while($row_cur2= $this->db->fetch_array($result_cur2))
									{
								//print_r($row_cur2);	
								//exit();
										?>
										<li><a href="#"><?php echo $row_cur2['name']; ?></a>
											<ul>
												<li><a href="quiz.php?index=demo&cid=<?php echo $row_cur2['id']; ?>">Demo Quiz</a></li>
												<?php 
												$sql_cur3="select * from ".TBL_QUIZ_POOL." where class_id='".$row_cur2['id']."' and showatfront='ON' order by id asc";
												$result_cur3= $this->db->query($sql_cur3,__FILE__,__LINE__);
												while($row_cur3= $this->db->fetch_array($result_cur3))
													{?>
														<li><a href="quiz.php?index=buy&quizid=<?php echo $row_cur3['id']; ?>"><?php echo $row_cur3['quiz_pool_name']; ?></a></li>
													<?php } ?>
												</ul>
											</li>
											<?php 
										} ?>
									</ul>
									</li><?php 
								}
								?>
							</ul>
						</li>
						<?php                    
						$sql_post="select * from ".TBL_MENU." order by sort_order asc";
						$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
						while($row_post= $this->db->fetch_array($result_post))
						{
							?>	

							<li><a href="<?php echo $row_post['page_type'];?>?pagename=<?php echo $row_post['page_name'];?>"><?php echo $row_post['tab_name'];?></a>
								<?php
								$sql_check="select * from ".TBL_PAGE." where parent_id='".$row_post['page_id']."'";
								$result_check= $this->db->query($sql_check,__FILE__,__LINE__);
								$no_of_page = $this->db->num_rows($result_check);
								if($no_of_page>0 and $no_of_page<6)
								{
									$sql_subpage="select * from ".TBL_PAGE." where parent_id='".$row_post['page_id']."'" ;
									$result_subpage= $this->db->query($sql_subpage,__FILE__,__LINE__);
									?>
									<ul>
										<?php
										while($row_subpage = $this->db->fetch_array($result_subpage))
										{
											?>
											<li><a href="<?php echo $row_subpage['page_type'];?>?pagename=<?php echo $row_subpage['page_name'];?>"><?php echo $row_subpage['tab_name'];?></a></li>
											<?php
										}
										?>
									</ul>
									<?php
								}
								?></li>
								<?php
							}
							?>

                       <?php /*?> <li><a href="#">Individual Development</a>
                        <ul>
                        <li><a href="blog.php?categoryname=Individual Devlopment&subcategoryname=Personality Development">Personality Development</a></li>
                        <li><a href="blog.php?categoryname=Individual Devlopment&subcategoryname=Aptitude Development">Aptitude Development</a></li>
                        <li><a href="blog.php?categoryname=Individual Devlopment&subcategoryname=Interest Development">Interest Development</a></li>
                        
                        </ul>
                        </li>
                        <li><a href="#">Leisure Camps</a>
                        <ul>
                        <li><a href="blog.php?categoryname=Leisure Camps&subcategoryname=Summer Vacation">Summer Vacation</a></li>
                        <li><a href="blog.php?categoryname=Leisure Camps&subcategoryname=Diwali Holidays">Diwali Holidays</a></li>
                        <li><a href="blog.php?categoryname=Leisure Camps&subcategoryname=Holi Holidays">Holi Holidays</a></li>
                        <li><a href="blog.php?categoryname=Leisure Camps&subcategoryname=Sunday Competitions">Sunday Competitions</a></li>
                        
                        </ul>
                        </li>
                        <li><a href="#">Your Creations</a>
                        <ul>
                     
                        <li><a href="blog.php?categoryname=Your Creation&subcategoryname=Painting">Painting</a></li>
                        <li><a href="blog.php?categoryname=Your Creation&subcategoryname=Photography">Photography</a></li>
                        <li><a href="blog.php?categoryname=Your Creation&subcategoryname=Gardening">Gardening</a></li>
                        
                        </ul>
                        </li>
                        <li><a href="package.php">Our Programs</a></li><?php */?>
                        
                    </ul>
                    <?php
                }


                function Slider()
                {
                	?>

                	<div class="camera_wrap camera_azure_skin" id="camera_wrap">
                		<?php                    
                		$sql_post="select * from ".TBL_SLIDER." order by timestamp";
                		$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                		while($row_post= $this->db->fetch_array($result_post))
                		{
                			?>				
                			<div data-src="../gallery/<?php echo $row_post['slider1'];?>"></div>
                			<?php
                		}
                		?>
                	</div>
                	<?php
                }

                function Header_Search_Bar()
                {
                	?>
                	<form action="#" method="post" class="form-inline">
                		<div class="input-append">
                			<input name="searchword" maxlength="20" class="inputbox input-xlarge" type="text" size="20" value="" placeholder="What are you looking for?" />
                			<button class="btn" data-toggle="tooltip" title="Random Search"><i class="icon-random"></i></button>
                			<button class="btn" data-toggle="tooltip" title="Advanced Search"><i class="icon-tasks"></i></button>
                			<button class="btn"><i class="icon-search"></i> <span class="hidden-phone">Search</span></button>
                		</div>
                	</form>
                	<?php
                }


                function Upcoming_Events()
                {
                	?>

                	<ul class="projects_carousel clearfix">
                		<?php                    
                		$sql_post="select * from ".TBL_PAGE." where parent_id=26";
                		$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                		while($row_post= $this->db->fetch_array($result_post))
                		{
                			?>

                			<li style="width:180px! important;">
                				<div class="border-shadow">
                					<figure>
                						<?php
                						$sql_post_img="select * from ".TBL_PAGE_IMAGE." where page_id='".$row_post['id']."' order by timestamp desc";
                						$result_post_img= $this->db->query($sql_post_img,__FILE__,__LINE__);
                						$row_pos_img= $this->db->fetch_array($result_post_img);

                						if($row_pos_img['image']=='')
                						{
                							?>
                							<a class="prettyPhoto kids_picture" href="images/dummy.jpg" title="<?php echo substr(strip_tags($row_post['heading'],''),0,25);?>...">
                								<img src="images/dummy.jpg" alt="<?php echo  strip_tags($row_post['heading'],''); ?>" style="height:150px; width:173px" /></a>
                								<?php
                							}
                							else
                							{
                								?>
                								<a class="prettyPhoto kids_picture" href="../gallery/<?php echo $row_pos_img['image']?>" title="<?php echo substr(strip_tags($row_post['heading'],''),0,25);?>...">
                									<img src="../gallery/<?php echo $row_pos_img['image']?>" alt="<?php echo  strip_tags($row_post['heading'],''); ?>" style="height:150px; width:173px" /></a>
                									<?php
                								}
                								?>

                							</figure>
                						</div>
                						<h1 class="title" style="width:182px; overflow:hidden;" title="<?php echo $row_post['heading']; ?>"><?php echo substr($row_post['heading'],0,15); ?></h1>
                						<p align="justify"><?php echo substr(strip_tags($row_post['content'],''),0,190);?> ...</p>
                						<footer class="aligncenter">
                							<a href="<?php echo $row_post['page_type']?>?pagename=<?php echo $row_post['page_name']?>" class="button button-centering medium button-style1">More</a>
                						</footer>
                					</li>

                				<?php } 
                				?></ul><?php 
                			}


                			function footer()
                			{
                				?>
                				<div class="kids_bottom_container">

                					<div class="l-page-width clearfix">

                						<div class="one_fourth">

                							<div class="widget_recent_entries">

                								<h3 class="widget-title">Latest Posts</h3>

                								<ul>
                									<?php
                									$sql_post="select * from ".TBL_PAGE." where parent_id=26";
                									$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                									while($row_post= $this->db->fetch_array($result_post))
                									{
                										?>
                										<li>
                											<a href="<?php echo $row_post['page_type']?>?pagename=<?php echo $row_post['page_name']?>"><?php echo  substr(strip_tags($row_post['heading'],''),0,20); ?>...</a>
                										</li>
                									<?php } ?>

                								</ul>	

                							</div><!--/ .widget_recent_entries-->

                						</div><!--/ one_fourth-->

                						<div class="one_fourth">

                							<div class="widget_archive">

                								<h3 class="widget-title">More Links</h3>

                								<ul>
                									<?php
                									$sql_post1="select * from ".TBL_PAGE." where parent_id=19";
                									$sql_post1 .= " or parent_id=18";
                									$result_post1= $this->db->query($sql_post1,__FILE__,__LINE__);
                									while($row_post1= $this->db->fetch_array($result_post1))
                									{
                										?>
                										<li>
                											<a href="<?php echo $row_post1['page_type']?>?pagename=<?php echo $row_post1['page_name']?>"><?php echo $row_post1['tab_name']; ?></a>
                										</li>
                									<?php } ?>
                								</ul>

                							</div><!--/ .widget_archive-->

                						</div><!--/ one_fourth-->
                						<script>
                							(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                								(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                								m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                							})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                							ga('create', 'UA-56186841-1', 'auto');
                							ga('send', 'pageview');

                						</script>






                						<div class="one_fourth">

                							<div class="widget_twitter">

                								<h3 class="widget-title">Twitter Updates</h3>

                								<!--<div id="tweets"></div>-->


                							</div><!--/ .widget_twitter-->

                						</div><!--/ one_fourth-->

                						<div class="one_fourth_last">

                							<div class="">

                								<h3 class="widget-title">Facebook</h3>

                								<center>
                									<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like-box href="https://www.facebook.com/Abs.study" width="250" height="250" show_faces="true" border_color="" stream="false" header="true"></fb:like-box>
                								</center>

                							</div><!--/ .widget_flickr_feed-->

                						</div><!--/ one_fourth_last-->

                					</div><!--/ l-page-width-->

                				</div>                      
                				<?php
                			}


                			function Tweet()
                			{
                				?>
                				<div class="ticker">
                					<div class="container">
                						<div class="row">
                							<div class="span12">
                								<div id="flexslider-ticker" class="tweet flexslider" data-selector=".tweet_list > li" data-animation="slide" data-direction="vertical" data-controlnav="false">
                									<i class="icon-refresh icon-spin"></i> Loading tweets...
                								</div>
                							</div>
                						</div>
                					</div>
                				</div>
                				<?php
                			}

                			function LeftPostPanel()
                			{
                				$sql_post="select * from ".TBL_POST." where category='Leisure Camps' order by timestamp desc limit 0,1";
                				$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                				$row_post= $this->db->fetch_array($result_post);
                				?>
                				<div class="page-header">
                					<h2><a href="#"><i class="icon-star"></i> <span>Leisure Camps</span></a></h2>
                				</div>    
                				<section id="tips-of-the-day">
                					<div class="article">
                						<figure>
                							<div id="flexslider-tips" class="simple-flexslider flexslider" data-animation="slide" data-animationspeed="500">
                								<ul class="slides unstyled">
                									<?php 
                									$sql_post_img="select * from ".TBL_BLOGIMAGE." where blog_id='".$row_post['id']."' order by timestamp desc";
                									$result_post_img= $this->db->query($sql_post_img,__FILE__,__LINE__);
                									while($row_pos_imgt= $this->db->fetch_array($result_post_img))
                									{
                										?>
                										<li><a href="details.php?post_Id=<?php echo $row_post['id']?>"><img src="gallery/<?php echo $row_pos_imgt['image_path']; ?>" alt="<?php echo  strip_tags($row_post['heading'],''); ?>" title="<?php echo  strip_tags($row_post['heading'],''); ?>" style="height:277px; width:370px;" /></a></li>
                									<?php } ?>    
                								</ul>
                							</div>
                						</figure>
                						<h4><a href="details.php?post_Id=<?php echo $row_post['id']?>"><?php echo  substr(strip_tags($row_post['heading'],''),0,100); ?></a></h4>
                						<p><?php echo substr(strip_tags($row_post['description'],''),0,300);?></p>
                						<small><i class="icon-calendar"></i> <time datetime="2013-04-25T09:00:08+00:00"><?php echo date('l jS F Y', strtotime($row_post['timestamp']));?></time></small>
                					</div>

                					<?php 
                					$sql_post="select * from ".TBL_POST." where category='Leisure Camps' order by timestamp desc limit 1,2";
                					$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                					while($row_post= $this->db->fetch_array($result_post))
                					{
                						?>
                						<article>
                							<figure>
                								<a href="details.php?post_Id=<?php echo $row_post['id']?>"><img src="gallery/<?php echo $row_post['image_path']; ?>" alt="<?php echo  strip_tags($row_post['heading'],''); ?>" title="<?php echo  strip_tags($row_post['heading'],''); ?>" style="height:50px; width:50px;"/></a>
                							</figure>
                							<h5>
                								<a href="details.php?post_Id=<?php echo $row_post['id']?>"><?php echo  substr(strip_tags($row_post['heading'],''),0,50); ?></a>
                								<small class="pull-right">85 <i class="icon-comments"></i></small>
                							</h5>
                							<small><i class="icon-calendar"></i> <time datetime="2013-04-24T09:00:08+00:00"><?php echo date('l jS F Y', strtotime($row_post['timestamp']));?></time></small>
                						</article>
                					<?php } ?>



                				</section>
                				<?php 	
                			}

                			function RightPostPanel()
                			{
                				$sql_post="select * from ".TBL_POST." where category='Your Creation' order by timestamp desc limit 0,1";
                				$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                				$row_post= $this->db->fetch_array($result_post);
                				?>	
                				<div class="page-header">
                					<h2><a href="#"><i class="icon-star"></i> <span>Creative</span> Arts</a></h2>
                				</div>

                				<section id="delicious-recipes">
                					<div class="article">
                						<figure>
                							<div id="flexslider-recipes" class="simple-flexslider flexslider" data-animation="slide" data-animationspeed="500">
                								<ul class="slides unstyled">
                									<?php 
                									$sql_post_img="select * from ".TBL_BLOGIMAGE." where blog_id='".$row_post['id']."' order by timestamp desc";
                									$result_post_img= $this->db->query($sql_post_img,__FILE__,__LINE__);
                									while($row_pos_imgt= $this->db->fetch_array($result_post_img))
                									{
                										?>
                										<li><a href="details.php?post_Id=<?php echo $row_post['id']?>"><img src="gallery/<?php echo $row_pos_imgt['image_path']; ?>" alt="<?php echo  strip_tags($row_post['heading'],''); ?>" title="<?php echo  strip_tags($row_post['heading'],''); ?>" style="height:277px; width:370px;" /></a></li>
                									<?php } ?>
                								</ul>
                							</div>
                						</figure>
                						<h4><a href="details.php?post_Id=<?php echo $row_post['id']?>"><?php echo  substr(strip_tags($row_post['heading'],''),0,100); ?></a></h4>
                						<p><?php echo substr(strip_tags($row_post['description'],''),0,300);?></p>
                						<small><i class="icon-calendar"></i> <time datetime="2013-04-25T09:00:08+00:00"><?php echo date('l jS F Y', strtotime($row_post['timestamp']));?></time></small>
                					</div>

                					<?php 
                					$sql_post="select * from ".TBL_POST." where category='Your Creation' order by timestamp desc limit 1,2";
                					$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                					while($row_post= $this->db->fetch_array($result_post))
                					{
                						?>
                						<article>
                							<figure>
                								<a href="details.php?post_Id=<?php echo $row_post['id']?>"><img src="gallery/<?php echo $row_post['image_path']; ?>" alt="<?php echo  strip_tags($row_post['heading'],''); ?>" title="<?php echo  strip_tags($row_post['heading'],''); ?>" style="height:50px; width:50px;"/></a>
                							</figure>
                							<h5>
                								<a href="details.php?post_Id=<?php echo $row_post['id']?>"><?php echo  substr(strip_tags($row_post['heading'],''),0,50); ?></a>
                								<small class="pull-right">85 <i class="icon-comments"></i></small>
                							</h5>
                							<small><i class="icon-calendar"></i> <time datetime="2013-04-24T09:00:08+00:00"><?php echo date('l jS F Y', strtotime($row_post['timestamp']));?></time></small>
                						</article>
                					<?php } ?>

                				</section>		
                				<?php     
                			}

                			function FetaturedNews()
                			{
                				$sql_post="select * from ".TBL_POST." where category='News'and subcategory='Featured News'  order by timestamp desc limit 0,1";
                				$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                				$row_post= $this->db->fetch_array($result_post);
                				?>	
                				<div class="page-header">
                					<h2><a href="#"><i class="icon-file-alt"></i> <span>Featured</span> News</a></h2>
                				</div>
                				<section id="featured-news">
                					<div class="featured-news">
                						<div class="show-all">
                							<a href="blog.php?categoryname=News&subcategoryname=Featured News"><i class="icon-double-angle-right"></i> Show All</a>
                						</div>
                						<div class="row">
                							<div class="span4">
                								<figure>
                									<a href="details.php?post_Id=<?php echo $row_post['id']?>"><img src="gallery/<?php echo $row_post['image_path']?>" alt="<?php echo  strip_tags($row_post['heading'],''); ?>"></a>
                								</figure>
                								<article>
                									<h4><a href="details.php?post_Id=<?php echo $row_post['id']?>"><?php echo  substr(strip_tags($row_post['heading'],''),0,50); ?></a></h4>
                									<p><?php echo substr(strip_tags($row_post['description'],''),0,300);?></p>
                									<ul class="unstyled">
                										<li><small><i class="icon-calendar"></i> Published on <?php echo date('l jS F Y', strtotime($row_post['timestamp']));?></small></li>
                										<?php /*?><li><small><i class="icon-user"></i> by <a href="#">John Smith</a></small></li><?php */?>
                									</ul>
                								</article>
                							</div>
                							<hr class="dotted visible-phone">

                							<div class="span4">
                								<div class="news-thumbs">
                									<?php 
                									$sql_post="select * from ".TBL_POST." where category='News'and subcategory='Featured News'  order by timestamp desc limit 1,4";
                									$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                									while($row_post= $this->db->fetch_array($result_post))
                									{
                										?>
                										<div class="news-item">
                											<figure>
                												<a href="details.php?post_Id=<?php echo $row_post['id']?>"><img src="gallery/<?php echo $row_post['image_path']?>" alt="<?php echo  strip_tags($row_post['heading'],''); ?>"></a>
                											</figure>
                											<article>
                												<h4><a href="details.php?post_Id=<?php echo $row_post['id']?>"><?php echo  substr(strip_tags($row_post['heading'],''),0,50); ?></a></h4>
                												<ul class="unstyled hidden-tablet">
                													<li><small><i class="icon-calendar"></i> Published on <?php echo date('l jS F Y', strtotime($row_post['timestamp']));?></small></li>
                													<?php /*?><li><small><i class="icon-user"></i> by <a href="#">John Doe</a></small></li><?php */?>
                												</ul>
                											</article>
                										</div>

                									<?php } ?>


                								</div>
                							</div>
                						</div>
                					</div>
                				</section>	
                				<?php 
                			}

                			function Latest_Blog()
                			{
                				?>
                				<div class="page-header">
                					<h2><i class="icon-time"></i> <span>Latest from </span> Blog</h2>
                				</div>
                				<?php         
                				$i=1;
                				$sql_post="select * from ".TBL_POST." where category='Blog' order by timestamp desc limit 0,2";
                				$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                				while($row_post= $this->db->fetch_array($result_post))
                				{
                					?>
                					<article>
                						<a href="details.php?post_Id=<?php echo $row_post['id']?>"><span class="icon"><?php echo $i; ?></span></a>
                						<h3><a href="details.php?post_Id=<?php echo $row_post['id']?>"><?php echo  substr(strip_tags($row_post['heading'],''),0,25); ?>..</a> <small><?php echo date('l jS F Y', strtotime($row_post['timestamp']));?></small></h3>
                						<p><?php echo substr(strip_tags($row_post['description'],''),0,120);?></p>
                					</article>
                					<?php
                					$i++;
                				}
                			}

                			function Latest_News()
                			{
                				?>
                				<div class="page-header">
                					<h2><i class="icon-bar-chart"></i> <span>Top</span> News</h2>
                				</div>
                				<?php 
                				$i=1;
                				$sql_post="select * from ".TBL_POST." where category='News'and subcategory='Top News'  order by timestamp desc limit 0,3";
                				$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                				while($row_post= $this->db->fetch_array($result_post))
                				{
                					?>
                					<li>
                						<a href="details.php?post_Id=<?php echo $row_post['id']?>"><span class="number"><?php echo $i; ?></span></a>
                						<div class="name" align="justify" style="padding-right:3px;">
                							<small><?php echo  substr(strip_tags($row_post['heading'],''),0,60); ?>..</small>
                							<a href="details.php?post_Id=<?php echo $row_post['id']?>"><i class="icon-play-circle"></i> <?php echo substr(strip_tags($row_post['description'],''),0,120);?>..</a>
                						</div>
                					</li>
                					<?php 
                					$i++;
                				} 


                			}

                			function topnews()
                			{

                				$sql_post="select * from ".TBL_POST." where category='News'and subcategory='Top News'  order by timestamp desc limit 0,5";
                				$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                				while($row_post= $this->db->fetch_array($result_post))
                				{
                					?>

                					<li>
                						<a href="#"><img style="width:80px; height:80px;" src="gallery/<?php echo $row_post['image_path']?>" alt="" class="pull-left"></a>

                						<h5><a href="#"><?php echo $row_post['heading']?></a></h5>

                						<small><i class="icon-calendar"></i> <time datetime="2013-04-26T09:00:08+00:00"><?php echo date('d-m-Y', strtotime($row_post['timestamp']));?></time></small>
                					</li>

                					<?php
                				}
                			}

                			function featurednews()
                			{

                				?>
                				<div class="widget_popular_posts widget">

                					<h3>Featured News</h3>

                					<ul>
                						<?php

                						$sql_news="select * from ".TBL_POST." where category='News'and subcategory='Featured News'  order by timestamp desc limit 1,3";
                						$result_news= $this->db->query($sql_news,__FILE__,__LINE__);
                						while($row_news= $this->db->fetch_array($result_news))
                						{
                							?>
                							<li>
                								<div class="entry">
                									<div class="kids_image_wrapper kids_mini_audio">
                										<a class="prettyPhoto" href="../gallery/<?php echo $row_news['image_path']?>" 
                											title="<?php echo strip_tags($row_news['description'],'')?>"><img 
                											alt="<?php echo $row_news['heading']?>" src="../gallery/<?php echo $row_news['image_path']?>" style="width:200px;" title="<?php echo $row_news['heading']?>" /></a>
                										</div><!--/ kids_image_wrapper-->
                										<div class="excerpt">
                											<strong><a href="details.php?post_Id=<?php echo $row_news['id']?>"><?php echo $row_news['heading']?></a></strong>
                											<span class="recent-posts-date">Posted: <?php echo date('F d, Y', strtotime($row_news['timestamp']));?></span>
                										</div><!--/ excerpt-->	
                									</div><!--/ entry-->
                								</li>
                								<?php
                							}
                							?>
                						</ul>

                					</div>
                					<?php 

                				}


                				function latestblog()
                				{

                					$sql_blog="select * from ".TBL_POST." where category='Blog' and subcategory='Default' ";

                					$sql_blog .="limit 0,4";

                					$result_blog= $this->db->query($sql_blog,__FILE__,__LINE__);

                					while($row_blog= $this->db->fetch_array($result_blog))
                					{
                						?>

                						<li>

                							<a href="#"><img style="width:80px; height:80px;" src="gallery/<?php echo $row_blog['image_path']?>" alt="" class="pull-left"></a>

                							<h5><a href="details.php?post_Id=<?php echo $row_blog['id']?>"><?php echo $row_blog['heading']?></a></h5>

                							<small><i class="icon-calendar"></i> <time datetime="2013-04-18T09:00:08+00:00"><?php echo date('d-m-Y', strtotime($row_blog['timestamp']));?></time></small>
                						</li>
                						<?php
                					}

                				}



                				function OurPackages()
                				{
                					?>
                					<section id="pricing">
                						<div class="page-header">
                							<h1>Our Programs <?php /*?><small>Clean and Responsive Price Table.</small><?php */?></h1>
                						</div>
                						<?php
                						$sql_basic="select * from ".TBL_PACKAGE." where plan_id='1'" ;
                						$result_basic= $this->db->query($sql_basic,__FILE__,__LINE__);
                						$row_basic = $this->db->fetch_array($result_basic)
                						?>
                						<div class="bs-docs-example">
                							<!-- Prices -->
                							<div class="prices tree-columns">
                								<div class="price-column">
                									<ul class="unstyled">
                										<li class="row-title">
                											<h3><?php echo $row_basic['plan_name']?></h3>
                										</li>
                										<li class="row-price">
                											<h3><?php echo $row_basic['totalquiz']?><small style="font-size:19px! important;"><?php echo $row_basic['plan_duration']?></small></h3>
                										</li>
                										<?php
                										if($row_basic['plan_price']!='')
                										{
                											?>
                											<li><?php echo $row_basic['plan_price']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_basic['individual_development']!='')
                										{
                											?>
                											<li><div><?php echo $row_basic['individual_development']?></div></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_basic['report']!='')
                										{
                											?>
                											<li><?php echo $row_basic['report']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_basic['leisure_camps']!='')
                										{
                											?>
                											<li><?php echo $row_basic['leisure_camps']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_basic['offer']!='')
                										{
                											?>
                											<li><?php echo $row_basic['offer']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_basic['tour']!='')
                										{
                											?>
                											<li><?php echo $row_basic['tour']?></li>
                											<?php
                										}
                										?>


                										<li class="row-button"><a href="package_order.php?pakage_id=<?php echo $row_basic['plan_id']?>" class="btn btn-inverse btn-large">Order Now</a></li>
                									</ul>
                								</div>
                								<?php
                								$sql_silver="select * from ".TBL_PACKAGE." where plan_id='2'" ;
                								$result_silver= $this->db->query($sql_silver,__FILE__,__LINE__);
                								$row_silver = $this->db->fetch_array($result_silver)
                								?>
                								<div class="price-column featured">
                									<ul class="unstyled">
                										<li class="row-featured">Recommended</li>
                										<li class="row-title">
                											<h3><?php echo $row_silver['plan_name']?></h3>
                										</li>
                										<li class="row-price">
                											<h3><?php echo $row_silver['totalquiz']?><small style="font-size:19px! important;"><?php echo $row_silver['plan_duration']?></small></h3>
                										</li>
                										<?php
                										if($row_silver['plan_price']!='')
                										{
                											?>
                											<li><?php echo $row_silver['plan_price']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_silver['individual_development']!='')
                										{
                											?>
                											<li><p><?php echo $row_silver['individual_development']?></p></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_silver['report']!='')
                										{
                											?>
                											<li><?php echo $row_silver['report']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_silver['leisure_camps']!='')
                										{
                											?>
                											<li><?php echo $row_silver['leisure_camps']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_silver['offer']!='')
                										{
                											?>
                											<li><?php echo $row_silver['offer']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_silver['tour']!='')
                										{
                											?>
                											<li><?php echo $row_silver['tour']?></li>
                											<?php
                										}
                										?>

                										<li class="row-button"><a href="package_order.php?pakage_id=<?php echo $row_silver['plan_id']?>" class="btn btn-warning btn-large">Order Now</a></li>
                									</ul>
                								</div>
                								<?php
                								$sql_gold="select * from ".TBL_PACKAGE." where plan_id='3'" ;
                								$result_gold= $this->db->query($sql_gold,__FILE__,__LINE__);
                								$row_gold = $this->db->fetch_array($result_gold)
                								?>
                								<div class="price-column last">
                									<ul class="unstyled">
                										<li class="row-title">
                											<h3><?php echo $row_gold['plan_name']?></h3>
                										</li>
                										<li class="row-price">
                											<h3><?php echo $row_gold['totalquiz']?><small style="font-size:19px! important;"><?php echo $row_gold['plan_duration']?></small></h3>
                										</li>
                										<?php
                										if($row_gold['plan_price']!='')
                										{
                											?>
                											<li><?php echo $row_gold['plan_price']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_gold['individual_development']!='')
                										{
                											?>
                											<li><div><?php echo $row_gold['individual_development']?></div></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_gold['report']!='')
                										{
                											?>
                											<li><?php echo $row_gold['report']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_gold['leisure_camps']!='')
                										{
                											?>
                											<li><?php echo $row_gold['leisure_camps']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_gold['offer']!='')
                										{
                											?>
                											<li><?php echo $row_gold['offer']?></li>
                											<?php
                										}
                										?>
                										<?php
                										if($row_gold['tour']!='')
                										{
                											?>
                											<li><?php echo $row_gold['tour']?></li>
                											<?php
                										}
                										?>

                										<li class="row-button"><a href="package_order.php?pakage_id=<?php echo $row_gold['plan_id']?>" class="btn btn-primary btn-large">Order Now</a></li>
                									</ul>
                								</div>
                							</div>
                							<!-- End Prices -->
                						</div>
                					</section>
                					<?php
                				}


                				function order_form($pakage_id)
                				{
                					$this->pkg_Id = $pakage_id;
                					$FormName = "order_form2";
                					$ControlNames=array("fullname"		=>array('fullname',"''","Please Enter Your Name","span_fullname"),
                						"email_contact"			=>array('email_contact',"EMail","Please Enter Email","span_email_contact"),
                						"mobile_contact" =>array('mobile_contact',"Mobile","Enter your contact details","span_mobile_contact")
                					);

                					$ValidationFunctionName="CheckneworderValidity";

                					$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
                					echo $JsCodeForFormValidation;

                					$sql_gold="select * from ".TBL_PACKAGE." where plan_id='".$this->pkg_Id."'" ;
                					$result_gold= $this->db->query($sql_gold,__FILE__,__LINE__);
                					$row_gold = $this->db->fetch_array($result_gold)
                					?>

                					<div id="contact">
                						<div class="page-header">
                							<h2><i class="icon-envelope"></i> <span>Order</span> Form</h2>
                						</div>
                						<div class="bs-docs-example">
                							<!-- Contact Widget -->
                							<div class="contact-widget" id="order_frm">
                								<p style="margin-bottom:5px! important; color:#000;"> This is our <?php echo $row_gold['plan_name'];?> package.</p>
                								<p style="color:#000;"> In this package you will get <?php echo $row_gold['totalquiz'];?> <?php echo $row_gold['plan_duration'];?>.</p>

                								<form  name="<?php echo $FormName;?>" enctype="multipart/form-data" action="" method="post">
                									<div class="row-fluid">
                										<div class="span6">
                											<input type="text" name="fullname" id="fullname" placeholder="Name" class="input-block-level">
                											<br/> <span style="color:#900;" id="span_fullname"></span>
                										</div>
                										<div class="span6">
                											<input type="email" placeholder="Mobile" name="mobile_contact" id="mobile_contact" class="input-block-level">
                											<br/> <span style="color:#900;" id="span_mobile_contact"></span>
                										</div>
                									</div>

                									<input type="text" placeholder="Email" name="email_contact" id="email_contact" class="input-block-level">
                									<br/> <span style="color:#900;" id="span_email_contact"></span>
                									<textarea placeholder="Message" name="message" id="message" class="input-block-level" rows="3" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 87px;"></textarea>

                									<div class="row-fluid">
                										<div class="span6">
                											<button class="icon-angle-right" value="Order"  name="submitorder" onclick=" if(<?php echo $ValidationFunctionName ?>()) { home.order_submit(this.form.fullname.value,this.form.email_contact.value,this.form.mobile_contact.value,this.form.message.value,'<?php echo $this->pkg_Id;?>',{target:'order_frm'}); } " type="button"><i class="icon-angle-right"></i>Order</button></div>

                										</div>

                									</div>
                								</form>
                							</div>
                							<!-- End Contact Widget -->
                						</div>

                					</div>
                					<?php
                				}


                				function order_submit($full_name,$email,$mobile,$msg,$order_id)
                				{
                					ob_start();

                					$insert_sql_array = array();
                					$insert_sql_array['fullname'] = $full_name;
                					$insert_sql_array['email'] = $email;
                					$insert_sql_array['mobile'] = $mobile;
                					$insert_sql_array['message'] = $msg;
                					$insert_sql_array['package_id'] = $order_id;
                					$this->db->insert(TBL_ORDER,$insert_sql_array);		

                					?>
                					<div style="background-color:#FF8F00; color:#000; width: 310px; padding:15px; border-radius:10px;">
                						<h4>You Order has been sent successfully.<br />
                							we will contact you as soon as possible.<br /></h4>
                							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h2>Thank you.</h2>

                						</div>
                						<?php 



                						$html = ob_get_contents();
                						ob_end_clean();
                						return $html;
                					}



                					function indexpagebottoms_tab($pagename)
                					{
                						$sql_post="select * from ".TBL_PAGE." where page_name='".$pagename."' order by timestamp desc limit 0,1";
                						$result_post= $this->db->query($sql_post,__FILE__,__LINE__);
                						$row_post= $this->db->fetch_array($result_post);


                						$sql_post_img="select * from ".TBL_PAGE_IMAGE." where page_id='".$row_post['id']."' order by timestamp desc";
                						$result_post_img= $this->db->query($sql_post_img,__FILE__,__LINE__);
                						$row_pos_img= $this->db->fetch_array($result_post_img);
                						?>

                						<article class="kids_post_block l-grid-4">


                							<h2>

                								<a class="link" href="<?php echo $row_post['page_type']?>?pagename=<?php echo $row_post['page_name']?>"><?php echo $row_post['tab_name'];?></a></h2>

                								<div class="kids_post_content">
                									<div class="border-shadow">
                										<figure>
                											<img alt="" src="../gallery/<?php echo $row_pos_img['image']?>" style="height:150px; width:241px;"><span class="kids_curtain">&nbsp;</span>
                										</figure>
                									</div>
                									<p align="justify"><?php echo substr(strip_tags($row_post['content'],''),0,200);?>...</p> <h3 class="l-float-right">
                										<a class="link" href="<?php echo $row_post['page_type']?>?pagename=<?php echo $row_post['page_name']?>">Learn More</a>
                									</h3>
                								</div>
                							</article>
                							<?php
                						}



                					}
                					?>