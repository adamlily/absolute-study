
<?php
 /***********************************************************************************

Class Discription : This class will handle the creation and modification
					of User.
					************************************************************************************/

					class User{

						var $user_id;
						var $user;
						var $type;
						var $password;
						var $db;
						var $validity;
						var $Form;
						var $new_pass;
						var $confirm_pass;
						var $auth;


						function __construct(){
							$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
							$this->validity = new ClsJSFormValidation();
							$this->Form = new ValidateForm();
							$this->auth=new Authentication();
							$this->objMail = new PHPMailer();


						}


						function signup($runat)
						{
							switch($runat){
								case 'local':

								$FormName = "usercreate_form";
								$ControlNames=array("username"		=>array('username',"''","Please Enter Your Name","span_username"),
									"email"			=>array('email',"EMail","Please Enter Email","span_email"),
									"password"		=>array('password',"Password","Please Enter Password","span_password"),


									"mobile" =>array('mobile',"Mobile","Enter your contact details","span_mobile"),
									"type"	=>array('type',"''","Enter Type","span_type")




								);

								$ValidationFunctionName="ChecknewUserValidity";

								$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
								echo $JsCodeForFormValidation;
								?>
								<div class="internal-login">
									<form  name="<?php echo $FormName;?>" enctype="multipart/form-data" action="" method="post">						
										<div class="control-group">
											<div class="controls">
												<i class="icon-cogs"></i>
												<select name="type" style="height:38px !important; padding-left:38px !important; padding-top:7px !important; width: 306px !important;">
													<option selected="selected" value="student">Student</option>
													<option value="student">Student</option>
													<option value="school">School</option>
													<option value="parents">Parents</option>
												</select>
												<br/> <span style="color:#900;" id="span_type"></span>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<i class="icon-user"></i>
												<input type="text" class="input-block-level" name="username" placeholder="Name">
												<br/> <span style="color:#900;" id="span_username"></span>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<i class="icon-envelope"></i>
												<input name="email" type="text" class="input-block-level" placeholder="Email">
												<br/> <span style="color:#900;" id="span_email"></span>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<i class="icon-key"></i>
												<input type="password" class="input-block-level" name="password" placeholder="Password">
												<br/> <span style="color:#900;" id="span_password"></span>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<i class="icon-phone"></i>
												<input type="text" name="mobile" class="input-block-level" placeholder="Contact Number"/>
												<br/> <span style="color:#900;" id="span_mobile"></span>
											</div>
										</div>




										<div class="form-actions">
											<ul class="unstyled">
												<li style="font-size:12px;">Already a member ?<br /> <a href="#" style="color:#000; font-size:12px;">Login here</a></li>

											</ul>
											<div class="pull-right">
												<!--<button type="submit" class="btn btn-large">Sign Up</button>-->
												<button type="submit" class="btn btn-large" value="Sign Up"  name="submit"  onclick="return <?php echo $ValidationFunctionName;?>();">Sign Up</button>
											</div>
										</div>
									</form>
								</div>


								<?php 
								break;
								case 'server':
								extract($_POST);

								$this->username = $username;
								$this->password = $password;
								$this->email = $email;
								$this->gender = $gender;
								$this->dob = $dob;
								$this->mobile = $mobile;
								$this->college_name = $college_name;
								$this->email_upadate = $email_upadate;
								$this->type  = $type;		

					//server side validation
								$return =true;
								if($this->Form->ValidField($email,'empty','Email field is Empty or Invalid')==false)
									$return =false;
								if($this->Form->ValidField($password,'empty','Password name field is Empty or Invalid')==false)
									$return =false;	

								

								$sql="select * from ".TBL_REGISTER." where email='".$this->email."'";
								$result= $this->db->query($sql,__FILE__,__LINE__);
								if($this->db->num_rows($result)>0)
								{
									$_SESSION['error_msg'] = 'Email already exist. Please select another Email';
									?>
									<script type="text/javascript">
										window.location = "login.php"
									</script>
									<?php
									exit();
								}
								
								if($return){
									$insert_sql_array = array();
									$insert_sql_array['username'] = $this->username;
									$insert_sql_array['password'] = $this->password;
									$insert_sql_array['email'] = $this->email;
									$insert_sql_array['email_code'] = md5(md5(md5($this->email)));

									$insert_sql_array['gender'] = $this->gender;
									$insert_sql_array['dob'] = $this->dob;
									$insert_sql_array['mobile'] = $this->mobile;
									$insert_sql_array['college_name'] = $this->college_name;
									$insert_sql_array['email_updates']=  $this->email_upadate;
									$insert_sql_array['type']=  $this->type;
									$insert_sql_array['ip']=  $_SERVER['SERVER_ADDR'];

									$this->db->insert(TBL_REGISTER,$insert_sql_array);



									$this->objMail->IsHTML(true);
									$this->objMail->From = "info@absolutestudy.co.in";
									$this->objMail->FromName = "Team Absolute Study";
									$this->objMail->Sender = 'info@absolutestudy.co.in';
									$this->objMail->AddAddress($this->email);
									$this->objMail->Subject = 'Dear '.$this->username.'';							
									$this->objMail->Body = '<br/><br/><br/>Verify your account<br/><br/><br/>';
									$this->objMail->Body .= $this->username.', <br/><br/>';
									$this->objMail->Body .= 'Thank for registering with <span style="color:#039; font-weight:bold; text-decoration:none;">absolutestudy.co.in</span><br/><p><strong>Registered Email ID:</strong> <span style="color:#039; font-weight:bold; text-decoration:none;">'.$this->email.'</p><p><strong>Password:</strong> <span style="color:#000; font-weight:bold; text-decoration:none;">'.$this->password.'</p></div>';
									$this->objMail->Body .= 'Click the link or copy and paste it into your browser to activate your account.<br/><br/>';
									$this->objMail->Body .= 'Link:<br/> ';
									$this->objMail->Body .= '<a href="http://absolutestudy.co.in/user_verify.php?email='.$this->email.'&code='.md5(md5(md5($this->email))).'">http://absolutestudyco.in/user_verify.php?email='.$this->email.'&code='.md5(md5(md5($this->email))).'</a><br/><br/>';
									$this->objMail->Body .= '<p>In case of any queries or assistance, please call us on our 24X5 Helpline 000-00000000 or write to us at <span style="color:#000; font-weight:bold; text-decoration:none;">info@http://absolutestudy.co.in</span></p><p style="color:#3C6;">We look forward to seeing you again on our website.</p>';
									$this->objMail->Body .= 'Regards,<br/>';
									$this->objMail->Body .= 'info@absolutestudy.co.in<br/><br/><br/>';
									$this->objMail->WordWrap = 50;
									$this->objMail->Send();

									?>
									<script type="text/javascript">
										window.location = "email_sent.php"
									</script>
									<?php
									exit();

								} else {
									echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
									$this->signup('local');
								}
								break;
								default 	: 
								echo "Wrong Parameter passed";
							}
						}



						function signupfront($runat)
						{
							switch($runat){
								case 'local':

								$FormName = "usercreate_form2";
								$ControlNames=array("type"		=>array('type',"''","Please Enter Your Name","span_type"),
									"username_front"		=>array('username_front',"''","Please Enter Your Name","span_username_front"),
									"email_front"			=>array('email_front',"EMail","Please Enter Email","span_email_front"),
									"password_front"		=>array('password_front',"Password","Please Enter Password","span_password_front"),
									"mobile_front" =>array('mobile_front',"Mobile","Enter your contact details","span_mobile_front")




								);

								$ValidationFunctionName="ChecknewUser2Validity";
								$SameFields='';
								$ErrorMsgForSameFields='';

								$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
								echo $JsCodeForFormValidation;
								?>
								<form  name="<?php echo $FormName;?>" enctype="multipart/form-data" action="" method="post"  class="contactForm">

									<fieldset>
										<div class="row"> 
											<label for="type">Account Type:</label>
											<select name="type">
												<option value="student" selected="selected">Student</option>
												<option value="school">School</option>
												<option value="parents">Parents</option>
											</select>
											<br/> <span style="color:#900;" id="span_type"></span>
										</div>
										<div class="row">
											<label for="username_front">Name:</label>
											<input type="text" name="username_front" value="" placeholder="Name"/>
											<br/> <span style="color:#900;" id="span_username_front"></span>
										</div>
										<div class="row">
											<label for="email_front">Email:</label>
											<input type="text" name="email_front" value="" placeholder="Email"/>
											<br/> <span style="color:#900;" id="span_email_front"></span>
										</div>
										<div class="row">
											<label for="mobile_front">Phone:</label>
											<input type="text" name="mobile_front" value="" placeholder="Contact Number"/>
											<br/> <span style="color:#900;" id="span_mobile_front"></span>
										</div>
										<div class="row">
											<label for="password_front">Password:</label>
											<input type="password" name="password_front" value="" placeholder="Password"/>
											<br/> <span style="color:#900;" id="span_password_front"></span>

											<button class="button medium button-style1 align-btn-right" value="Sign Up"  name="submit"  onclick="return <?php echo $ValidationFunctionName;?>();">Sign Up</button>

										</div>
									</fieldset>


								</form>


								<?php 
								break;
								case 'server':
								extract($_POST);

								$this->type  = $type;	
								$this->username_front = $username_front;
								$this->password_front = $password_front;
								$this->email_front = $email_front;
								$this->mobile_front = $mobile_front;



					//server side validation
								$return =true;
								if($this->Form->ValidField($email_front,'empty','Email field is Empty or Invalid')==false)
									$return =false;
								if($this->Form->ValidField($password_front,'empty','Password name field is Empty or Invalid')==false)
									$return =false;	

								

								$sql="select * from ".TBL_REGISTER." where email='".$this->email_front."'";
								$result= $this->db->query($sql,__FILE__,__LINE__);
								if($this->db->num_rows($result)>0)
								{
									$_SESSION['error_msg'] = 'Email already exist. Please select another Email';
									?>
									<script type="text/javascript">
										window.location = "registration.php"
									</script>
									<?php
									exit();
								}
								
								if($return){
									$insert_sql_array = array();
									$insert_sql_array['username'] = $this->username_front;
									$insert_sql_array['password'] = $this->password_front;
									$insert_sql_array['email'] = $this->email_front;
									$insert_sql_array['email_code'] = md5(md5(md5($this->email_front)));
									$insert_sql_array['mobile'] = $this->mobile_front;

									$insert_sql_array['type']=  $this->type;
									$insert_sql_array['ip']=  $_SERVER['SERVER_ADDR'];

									$this->db->insert(TBL_REGISTER,$insert_sql_array);



									$this->objMail->IsHTML(true);
									$this->objMail->From = "info@absolutestudy.co.in";
									$this->objMail->FromName = "Team Absolute Study";
									$this->objMail->Sender = 'info@absolutestudy.co.in';
									$this->objMail->AddAddress($this->email_front);
									$this->objMail->Subject = 'Dear '.$this->username_front.'';							
									$this->objMail->Body = '<br/><br/><br/>Verify your account<br/><br/><br/>';
									$this->objMail->Body .= $this->username_front.', <br/><br/>';
									$this->objMail->Body .= 'Thank for registering with <span style="color:#039; font-weight:bold; text-decoration:none;">absolutestudy.co.in</span><br/><p><strong>Registered Email ID:</strong> <span style="color:#039; font-weight:bold; text-decoration:none;">'.$this->email_front.'</p><p><strong>Password:</strong> <span style="color:#000; font-weight:bold; text-decoration:none;">'.$this->password_front.'</p></div>';
									$this->objMail->Body .= 'Click the link or copy and paste it into your browser to activate your account.<br/><br/>';
									$this->objMail->Body .= 'Link:<br/> ';
									$this->objMail->Body .= '<a href="http://absolutestudy.co.in/user_verify.php?email='.$this->email_front.'&code='.md5(md5(md5($this->email_front))).'">http://absolutestudy.co.in/user_verify.php?email='.$this->email_front.'&code='.md5(md5(md5($this->email_front))).'</a><br/><br/>';
									$this->objMail->Body .= '<p>In case of any queries or assistance, please call us on our 24X5 Helpline 000-00000000 or write to us at <span style="color:#000; font-weight:bold; text-decoration:none;">info@absolutestudy.co.in</span></p><p style="color:#3C6;">We look forward to seeing you again on our website.</p>';
									$this->objMail->Body .= 'Regards,<br/>';
									$this->objMail->Body .= 'info@absolutestudy.co.in<br/><br/><br/>';
									$this->objMail->WordWrap = 50;
									$this->objMail->Send();

									?>
									<script type="text/javascript">
										window.location = "email_sent.php"
									</script>
									<?php
									exit();

								} else {
									echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
									$this->signupfront('local');
								}
								break;
								default 	: 
								echo "Wrong Parameter passed";
							}
						}




						function contactinfo()
						{
							$FormName = "contact_form2";
							$ControlNames=array("fullname"		=>array('fullname',"''","Please Enter Your Name","span_fullname"),
								"email_contact"			=>array('email_contact',"EMail","Please Enter Email","span_email_contact"),
								"mobile_contact" =>array('mobile_contact',"Mobile","Enter your contact details","span_mobile_contact")
							);

							$ValidationFunctionName="ChecknewcontactValidity";

							$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
							echo $JsCodeForFormValidation;
							?>
							<div class="span4" id="contact_frm" style="color:#000 !important; min-height:250px !important;">
								<form  name="<?php echo $FormName;?>" enctype="multipart/form-data" action="" method="post">

									<div class="span3"><input type="text" name="fullname" id="fullname" value="" placeholder="Full Name *"/>
										<br/> <span style="color:#900;" id="span_fullname"></span>
									</div>
									<div class="span3"><input type="text" name="email_contact" id="email_contact" value="" placeholder="Email *"/>
										<br/> <span style="color:#900;" id="span_email_contact"></span>
									</div>

									<div class="span3"><input type="text" name="mobile_contact" id="mobile_contact" value="" placeholder="Contact Number *"/>
										<br/> <span style="color:#900;" id="span_mobile_contact"></span>
									</div> 
									<div class="span3"><textarea name="message" id="message" placeholder="Message"></textarea>

									</div>
									<div class="span3" align="right"><button class="btn btn-success" value="Send Message"  name="submitcont" onclick=" if(<?php echo $ValidationFunctionName ?>()) { user.contact_submit(this.form.fullname.value,this.form.email_contact.value,this.form.mobile_contact.value,this.form.message.value,{target:'contact_frm'}); } " type="button" style="margin-right:50px;"><i class="icon-user"></i> Send Message</button></div>
								</form>	
							</div>
							<?php 

						}

						function contact_submit($full_name,$email,$mobile,$msg)
						{
							ob_start();

							$insert_sql_array = array();
							$insert_sql_array['fullname'] = $full_name;
							$insert_sql_array['email'] = $email;
							$insert_sql_array['mobile'] = $mobile;
							$insert_sql_array['message'] = $msg;
							
							$this->db->insert(TBL_CONTACT,$insert_sql_array);		

							?>
							<div style="background-color:#FF8F00; color:#000; width: 310px; padding:15px; border-radius:10px;">
								<h4>You Message has been sent successfully.<br />
									we will contact you as soon as possible.<br /></h4>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h2>Thank you.</h2>

								</div>
								<?php 



								$html = ob_get_contents();
								ob_end_clean();
								return $html;
							}



							function EmailVerify($email,$email_code)
							{	

								$update_array = array();
								$update_array['email_varify'] ='active';
								$this->db->update(TBL_REGISTER,$update_array,'email',$email);

								$_SESSION['msg']='your account Verified  successfully';

								?>
								<script type="text/javascript">
									window.location = "index.php"
								</script>
								<?php

							}


							function Login($runat,$page=''){
								switch($runat){
									case 'local' :


									if($page=='loginpage')
									{

										$FormName = "form_login2";
										$ControlNames=array("emails2"			=>array('emails2',"Email","Please enter User Email","span_emails2"),
											"passwords2"			=>array('passwords2',"''","Please enter Password","span_passwords2")
										);

										$ValidationFunctionName="CheckLoginforLoginPageValidity";

										$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
										echo $JsCodeForFormValidation;
										?>
										<form  name="<?php echo $FormName;?>" enctype="multipart/form-data" action="" method="post"  class="contactForm">
											<fieldset>

												<div class="row">
													<label for="emails2">Email:</label>
													<input type="text" name="emails2" value="" placeholder="Email" style="width:250px !important;"/>
													<br/> <span style="color:#900;" id="span_emails2"></span>
												</div>
												<div class="row">
													<label for="passwords2">Password:</label>
													<input type="password" name="passwords2" value="" placeholder="Password"/>
													<br/> <span style="color:#900;" id="span_passwords2"></span>

													<button class="button medium button-style1 align-btn-right" value="Login"  name="submited2"  onclick="return <?php echo $ValidationFunctionName;?>();">Login</button>

												</div>
											</fieldset>


										</form>
										<?php 
									}
									else
									{
										$FormName = "form_login";
										$ControlNames=array("emails"			=>array('emails',"Email","Please enter User Email","span_emails"),
											"passwords"			=>array('passwords',"''","Please enter Password","span_passwords")
										);
										$SameFields="";
										$ErrorMsgForSameFields='';

										$ValidationFunctionName="CheckLoginValidity";

										$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
										echo $JsCodeForFormValidation;
										?>

										<form action="" method="post" id="search-form" name="<?php echo $FormName ?>" enctype="multipart/form-data" style="width:480px !important;">

											<label class="control-label" for="inputE-mail">E-mail</label>
											<input class="input-medium" type="text"  name="emails" placeholder="Email address">
											<label class="control-label" for="inputPassword">Password</label>
											<input class="input-medium" type="password"  name="passwords" placeholder="Password">

											<button type="submit"  name="submited" value="login"  onclick="return <?php echo $ValidationFunctionName ?>();" class="btn">Sign in</button>


										</form>


										<?php
									}

									break;
									case 'server' :

									extract($_POST);

									if($page=='loginpage')
									{
										$this->emails = $emails2;
										$this->passwords = $passwords2;
									}
									else
									{
										$this->emails = $emails;
										$this->passwords = $passwords;
									}


									$return =true;
									if($this->Form->ValidField($emails,'empty','Please Enter Email')==false)
										$return =false;
									if($this->Form->ValidField($passwords,'empty','Please Enter Your Password')==false)
										$return =false;


									if($return){

										$sql = "select * from ".TBL_REGISTER." where email='".$emails."'";
										$record = $this->db->query($sql,__FILE__,__LINE__);
										$row = $this->db->fetch_array($record);
										if($this->emails == $row['email'] and $this->passwords == $row['password'])
										{
											if($row['email_varify'] == 'block')
											{
												$_SESSION['error_msg']='your account is not verified please varify';
												?>
												<script type="text/javascript">
													window.location="index.php";
												</script>
												<?php
												exit();
											}
											else if($row['status'] == 'block')
											{
												$_SESSION['error_msg']='your account has blocked please contact at shopshift.com ';
												?>
												<script type="text/javascript">
													window.location="index.php";
												</script>
												<?php
												exit();
											}
											else
											{
												$this->uname= $row['username'];
												$this->id= $row['user_id'];
												$this->emails= $row['email'];
												$this->auth->Create_Session($this->uname,$this->id,$this->emails,'','');
												// $_SESSION['id']=$row['id'];
												$_SESSION['msg'] = 'You have  Loged in Successfully';
												?>
												<script type="text/javascript">
													window.location="myaccount.php";
												</script>
												<?php
												exit();
											}
										}
										else
										{
											$_SESSION['error_msg']='Invalid username or password, please try again ...';
										}
										?>
										<script type="text/javascript">
							//window.location="<?php echo $_SERVER['PHP_SELF'] ?>";
						</script>
						<?php
						exit();
					}
					else
					{
						echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
						$this->Login('local');
					}
					break;
					default : echo 'Wrong Paramemter passed';
				}
			}



			function forgetdiv()
			{
				?>
				<link href="pop/facebox.css" media="screen" rel="stylesheet" type="text/css" />
				<script src="pop/jquery.js" type="text/javascript"></script>
				<script src="pop/facebox.js" type="text/javascript"></script>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('a[rel*=facebox]').facebox({
							loadingImage : 'pop/loading.gif',
							closeImage   : 'pop/closelabel.png'
						})
					})
				</script>
				<div id="info" style="display:none; height:150px; background-color:#EEE2FA; ">
					<?php
					extract($_REQUEST);
					if($submit=="Send")
						$this->forgetpass('server');
					else
						$this->forgetpass('local');
					?>
				</div>
				<?php
			}


			function forgetpass($runat)
			{
				switch($runat){
					case 'local':

					$FormName = "frm_forgetPassword";
					$ControlNames=array("email"			=>array('email',"EMail","Please enter Email","span_email"),
				);

					$ValidationFunctionName="CheckUserValidity";
					
					$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
					echo $JsCodeForFormValidation;
					?>
					<form action="" method="post"   name="<?php echo $FormName ?>" enctype="multipart/form-data">
						<label>Enter email to reset your password:</label>
						<div style="width:350px; margin-left:10px; margin-top:15px;">

							<input class="half-input" type="text" style="width:150px;" name="email" value="" /><br />
							<span style="color:#DA3838;" id="span_email"></span>
						</div>
						<div style="width:350px; margin-left:10px; padding-top:10px">
							<input type="submit" class="classname" name="submit" value="Send" style="margin-left:250px;"  onclick="return <?php echo $ValidationFunctionName ?>();"/>
						</div>
					</form>
					<?php 
					break;
					case 'server':
					extract($_POST);
					$this->email = $email;

					$return =true;
					if($this->Form->ValidField($email,'empty','Email field is Empty or Invalid')==false)
						$return =false;

					$sql = "select * from ".TBL_MEMBER;
					$record = $this->db->query($sql,__FILE__,__LINE__);
					$row = $this->db->fetch_array($record);
					if($this->email == $row['email'] )
					{
						if($return)
						{
							
							$this->objMail->IsHTML(true);
							$this->objMail->From = "abhishek@technovibes.in";
							$this->objMail->FromName = "Team Shop Shift";
							$this->objMail->AddAddress($this->email);
							$this->objMail->Subject = 'Hi.....';							
							$this->objMail->Body = '<br/><br/><br/>Reset Password<br/><br/><br/>';
							$this->objMail->Body .= 'Shop Shift has received a request to reset your password by '.$this->email.'<br/><br/>';
							$this->objMail->Body .= 'Click the link or copy and paste it into your browser to Reset Your Password
							If you do not requested for reset of your password, inform us for further action.<br/><br/>';
							$this->objMail->Body .= 'Link:<br/> ';
							$this->objMail->Body .= '<a href="shopshift.com/resetpassword.php?email='.$this->email.'&code='.md5(md5(md5($this->email))).'">'.$this->site_url.'resetpassword.php?email='.$this->email.'&code='.md5(md5(md5($this->email))).'</a><br/><br/>';
							$this->objMail->Body .= 'Ignore this message if you did not create an account with www.shopshift.com using this e-mail.<br/><br/>';
							$this->objMail->Body .= 'Regards,<br/>';
							$this->objMail->Body .= 'Shop Shift<br/><br/><br/>';
							$this->objMail->WordWrap = 50;
							$this->objMail->Send();

							?>
							<script type="text/javascript">
								window.location = 'email-send1.php';
							</script>

							<?php

						}
					}
					else{

						if($return){
							
							$_SESSION['error_msg'] = 'Wrong Email!!! PLz  Correct Email Enter';
							?>

							<script type="text/javascript">
								window.location = "authenticationpanel.php"
							</script>
							<?php
							exit();
							
						} else {
							echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
							$this->forgetpass('local');
						}
					}
					break;
					default 	: 
					echo "Wrong Parameter passed";
				}

			}



			function ResetPasswordMail($runat,$email_code,$email)
			{

				switch($runat)
				{
					case 'local' :
					$FormName = "frm_changePw";
					$ControlNames=array(
						"password"			=>array('password',"''","Please enter Password","spanpassword"),
						"repassword"			=>array('repassword',"RePassword","Password Donot Match","spanrepassword",'password')
					);

					$ValidationFunctionName="CheckPWValidity";
					$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
					echo $JsCodeForFormValidation;

					?>
					<form action="" method="post" id="loginform"  name="<?php echo $FormName ?>" enctype="multipart/form-data">
						<div style="width:350px; margin-left:50px;">
							<label>Password:</label><input class="half-input" type="password" style="width:150px;" name="password" value="" /><br />
							<span style="color:#DA3838;" id="spanpassword"></span>
						</div>
						<p></p>
						<div style="width:350px; margin-left:50px;">
							<label>Re-Password:</label><input class="half-input" type="password" style="width:150px;" name="repassword" value="" />
							<br />
							<span style="color:#DA3838;" id="spanrepassword"></span>
						</div>
						<div style="width:350px; margin-left:50px; padding-bottom:35px;padding-top:20px">
							<input type="submit" class="classname" name="submit" value="CHNAGE PASSWORD"  onclick="return <?php echo $ValidationFunctionName ?>();"/>
						</div>
					</form>

					<?php
					break;
					case 'server' :

					extract($_POST);
					$this->password = $password;
					$this->repassword = $repassword;

					$return =true;
					if($this->Form->ValidField($password,'empty','Please Enter  Password')==false)
						$return =false;
					if($return){

						$update_sql_array = array();
						$update_sql_array['password'] = $password;
						$this->db->update(TBL_MEMBER,$update_sql_array,'email_code',$email_code);

						$_SESSION['msg']='Password Changed Successfully';
						?>
						<script type="text/javascript">
							window.location="authenticationpanel.php";
						</script>
						<?php
						exit();

					}
					else
					{
						echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
						$this->ResetPasswordMail('local');
					}
					break;
					default : echo 'Wrong Paramemter passed';
				}

			}

			function topheader($check)
			{
				switch($check)
				{
					case 'LoginHeader' :
					?>

					<div id="top-bar" class="clearfix">
						<div id="top-bar-inner">
							<ul class="social-icons">
								<li><a href="#"><span id="twitter_icon"><img src="images/soctw.png" height="30" width="30" style="border-radius:100px;"/></span></a></li>
								<li><a href="#"><span id="facebook_icon"><img src="images/socfb.png" height="30" width="30"  style="border-radius:100px;"/></span></a></li>
								<li><a href="#"><span id="facebook_icon"><img src="images/socinsta.png" height="30" width="30"  style="border-radius:100px;"/></span></a></li>
							</ul>


							<div class="topbar-right clearfix">
								<ul class="clearfix">
									<li class="checkout-icon"><a href="authenticationpanel.php">Register/Login</a></li>
								</ul>
								<div class="cart-top">
									<p><a href="checkout.php"><?php echo count($_SESSION['cart']); ?> Items</a></p>
								</div>
							</div>
						</div>
					</div>

					<?php
					break;
					case 'MainHeader' :
					?>
					<div id="top-bar" class="clearfix">
						<div id="top-bar-inner">
							<ul class="social-icons">
								<li><a href="#"><span id="twitter_icon"><img src="images/soctw.png" height="30" width="30" style="border-radius:100px;"/></span></a></li>
								<li><a href="#"><span id="facebook_icon"><img src="images/socfb.png" height="30" width="30"  style="border-radius:100px;"/></span></a></li>
								<li><a href="#"><span id="facebook_icon"><img src="images/socinsta.png" height="30" width="30"  style="border-radius:100px;"/></span></a></li>
							</ul>


							<div class="topbar-right clearfix">
								<ul class="clearfix">
									<li class="checkout-icon"><a href="current_orders.php">Order Status</a></li>
									<li class="checkout-icon"><a href="previous_order.php">Previous Order</a></li>
									<li class="checkout-icon"><a href="account.php">Account Info</a></li>
									<li class="checkout-icon"><a href="logout.php">Log Out</a></li>

								</ul>
								<div class="cart-top">
									<p><a href="checkout.php"><?php echo count($_SESSION['cart']); ?> Items</a></p>
								</div>
							</div>
						</div>
					</div>
					<?php
					break;
					default :			
					echo 'Wrong Paramemter passed';		
					
				}

			}

			function changePassword($runat)
			{

				switch($runat){
					case 'local' :

					$FormName = "frm_changeuser";
					$ControlNames=array("oldpassword"			=>array('oldpassword',"''","Please enter Old Password","span_oldpassword"),
						"password"			=>array('password',"''","Please enter Password","span_password"),
						"repassword"			=>array('repassword',"RePassword","Password Donot Match","span_repassword",'password')
					);

					$ValidationFunctionName="CheckPWValidity";

					$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
					echo $JsCodeForFormValidation;

					?>
					<form method="post" action="" enctype="multipart/form-data" name="<?php echo $FormName ?>" >							
						<div style="padding-bottom:15px; margin-left:110px;">
							<label>Old Password<span style="color:#C6262E;" class="f_req">*</span></label>
							<input type="password" name="oldpassword" id="oldpassword" />
							<br />
							<span style="color:#C6262E;" id="span_oldpassword"></span>
						</div>
						<div  style="padding-bottom:15px;  margin-left:110px;" >
							<label>Password<span style="color:#C6262E;" class="f_req">*</span></label>
							<input type="password" name="password"  id="password"  />
							<br />
							<span style="color:#C6262E;" id="span_password"></span>
						</div>
						<div  style="padding-bottom:15px;  margin-left:110px;">
							<label>RePassword<span style="color:#C6262E;" class="f_req">*</span></label>

							<input type="password" name="repassword"  id="repassword" />
							<br />
							<span style="color:#C6262E;" id="span_repassword"></span>
						</div>
						<div >
							<button  value="Change Password" type="submit" name="submit" id="submit" class="classname"  style="margin-bottom:20px; margin-left:110px;" onclick="return <?php echo $ValidationFunctionName?>();">Change Password</button>
							
						</div>                        

					</form>
					<?php
					break;
					case 'server' :

					extract($_POST);
					$this->password=$password;

						//server side validation
					$return =true;
					if($this->Form->ValidField($oldpassword,'empty','Please Enter User Name')==false)
						$return =false;
					if($this->Form->ValidField($password,'empty','Please Enter Your Password')==false)
						$return =false;
					if($this->Form->ValidField($repassword,'empty','Password Donot Match')==false)
						$return =false;


					if($return){
						$sql = "select * from ".TBL_MEMBER." where id='".$_SESSION['id']."'";
						$record = $this->db->query($sql,__FILE__,__LINE__);
						$row = $this->db->fetch_array($record);
						if($oldpassword == $row['password'])
						{
							$update_sql_array = array();
							$update_sql_array['password'] = $this->password;

							$this->db->update(TBL_MEMBER,$update_sql_array,'id',$_SESSION['id']);
							$_SESSION['msg']='Password Changed Successfully';
							?>
							<script type="text/javascript">
								window.location="changepass.php";
							</script>
							<?php
							exit();
						}
						else
						{
							$_SESSION['msg']='Old password do not match, please try again ...';
						}
						?>
						<script type="text/javascript">
							window.location="changepass.php";
						</script>
						<?php
						exit();
					}
					else
					{
						echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
						$this->changePassword('local');
					}
					break;
					default : echo 'Wrong Paramemter passed';
				}

			}

			function viewprofile()
			{
				$sql="select * from ".TBL_REGISTER." where user_id='".$_SESSION['id']."'" ;
				$result= $this->db->query($sql,__FILE__,__LINE__);
				$row = $this->db->fetch_array($result);

				?>


				<h1 >Welcome <?php echo $row['username']?></h1>


            <?php /*?><div id="main-content" class="full-width page-content">
			<div style="margin-left: 675px;
    width: 160px;"><a class="button1" href="changepass.php" style="color:#000;">Change password</a></div><div style="width:125px; float:right;"><a class="button1" href="editaccount.php?vid=<?php echo $row['id'];?>" style=" color:#000;">Edit Profile</a></div>
    </div><?php */?>


    <ul>
    	<li style="background:none; font-size:13px; color:#3F3F3F; font-weight:600;"><span style="font-size:14px; font-weight:900; color:#000; margin-right:30px; ">Name:</span><?php echo $row['username']?></li>
    	<li style="background:none; font-size:13px; color:#3F3F3F; font-weight:600;"><span style="font-size:14px; font-weight:900; color:#000; margin-right:30px;">Email:</span><?php echo $row['email']?></li>

						<?php /*?><li style="background:none; font-size:13px; color:#3F3F3F; font-weight:600;"><span style="font-size:14px; font-weight:900; color:#000; margin-right:30px;">Billing Address:</span><?php
						$sql_address="select * from ".TBL_ADDRESS." where user_id='".$_SESSION['id']."'";
						$result_address= $this->db->query($sql_address,__FILE__,__LINE__);
						$row_address= $this->db->fetch_array($result_address); echo $row_address['bill_address']?></li><?php */?>
                        <?php /*?><li style="background:none; font-size:13px; color:#3F3F3F; font-weight:600;"><span style="font-size:14px; font-weight:900; color:#000; margin-right:30px;">Shiping Address:</span><?php echo $row_address['ship_address']?></li>
                        <li sstyle="background:none; font-size:13px; color:#3F3F3F; font-weight:600;"><span style="font-size:14px; font-weight:900; color:#000; margin-right:30px;">Sign me up for Weekly updates:</span><?php echo $row['weekly_update'];?></li><?php */?>
                    </ul>


                    <?php
                }


                function editaccount($runat,$id)
                {
                	switch($runat){
                		case 'local':

                		$FormName = "frm_editaccount";
                		$ControlNames=array("username"			=>array('username',"''","Please enter Username","span_username"),
                			"bill_address"			=>array('bill_address',"''","Please Enter your billing address","span_bill_address"),
                			"ship_address"			=>array('ship_address',"''","Please enter your shiping address","span_ship_address")


                		);

                		$ValidationFunctionName="CheckeditUseraccuntValidity";

                		$JsCodeForFormValidation=$this->validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
                		echo $JsCodeForFormValidation;
                		$sql="select * from ".TBL_MEMBER." where id='".$id."'";
                		$result= $this->db->query($sql,__FILE__,__LINE__);
                		$row= $this->db->fetch_array($result);
                		?>
                		<form  name="<?php echo $FormName;?>" enctype="multipart/form-data" action="" method="post">
                			<h2 class="page-title" style="font-size:18px; font-weight:700; color:#000;">Edit Your Profile <span style="color:#95968E; font-size:16px; font-weight:700;"><?php echo $row['username']?></span></h2>

                			<div class="shadow-wrapper margin1">
                				<div class="left-shadow"></div>
                				<div class="mid-shadow"></div>
                				<div class="right-shadow"></div>
                			</div>
                			<ul>
                				<li style="background:none; font-size:13px; color:#3F3F3F; font-weight:600;"><span style="font-size:14px; font-weight:900; color:#000; margin-right:30px; ">Name:</span><input type="text" value="<?php echo $row['username']?>" name="username" style="margin-left:100px;"/><br />
                					<span style="color:#F00;" id="span_username"></span></li>
                					<li style="background:none; font-size:13px; color:#3F3F3F; font-weight:600;"><span style="font-size:14px; font-weight:900; color:#000; margin-right:30px;">Email:</span><span style="margin-left:110px;"><?php echo $row['email']?></span></li>

                					<li style="background:none; font-size:13px; color:#3F3F3F; font-weight:600;"><span style="font-size:14px; font-weight:900; color:#000; margin-right:30px;">Billing Address:</span><textarea style="width:50%; margin-left:26px;" name="bill_address"><?php
                					$sql_address="select * from ".TBL_ADDRESS." where user_id='".$id."'";
                					$result_address= $this->db->query($sql_address,__FILE__,__LINE__);
                					$row_address= $this->db->fetch_array($result_address);
                					echo $row_address['bill_address']?></textarea>
                					<br />
                					<span style="color:#F00;" id="span_bill_address"></span></li>
                					<li style="background:none; font-size:13px; color:#3F3F3F; font-weight:600;"><span style="font-size:14px; font-weight:900; color:#000; margin-right:30px;">Shiping Address:</span><textarea style="width:50%; margin-left:15px;" name="ship_address"><?php echo $row_address['ship_address']?></textarea>
                						<br />
                						<span style="color:#F00;" id="span_ship_address"></span></li>
                						<li style="background:none; font-size:13px; color:#3F3F3F; font-weight:600;"><span style="font-size:14px; font-weight:900; color:#000; margin-right:30px;">Weekly updates:</span> <input type="checkbox" name="weekly_update" <?php if($row['weekly_update']=='yes') {?> checked="checked" <?php } ?> value="yes"/><span style="padding-left:10px;">Sign me up for Weekly updates</span></li>
                						<input type="submit" class="classname" value="Save Changes"  name="submit"  onclick="return <?php echo $ValidationFunctionName?>();" style="margin:25px; margin-left:150px;"/>
                					</ul>
                				</form>
                				<?php
                				break;
                				case 'server':
                				extract($_POST);

                				$this->username = $username;
                				$this->weekly_update = $weekly_update;
                				$this->bill_address = $bill_address;
                				$this->ship_address = $ship_address;







							//server side validation
                				$return =true;
                				if($return){
                					$update_sql_array = array();
                					$update_sql_array['username'] =  $this->username;
                					$update_sql_array['weekly_update'] = $this->weekly_update;


                					$this->db->update(TBL_MEMBER,$update_sql_array,'id',$id);

                					$update_sql_array2 = array();
                					$update_sql_array2['bill_address'] =  $this->bill_address;
                					$update_sql_array2['ship_address'] = $this->ship_address;


                					$this->db->update(TBL_ADDRESS,$update_sql_array2,'user_id',$_SESSION['id']);


                					$_SESSION['msg'] = 'Account has been Upadate Successfully';


                					?>
                					<script type="text/javascript">
                						window.location = "account.php"
                					</script>
                					<?php
                				} else {
                					echo $this->Form->ErrtxtPrefix.$this->Form->ErrorString.$this->Form->ErrtxtSufix; 
                					$this->editaccount('local',$id);
                				}
                				break;
                				default 	: 
                				echo "Wrong Parameter passed";
                			}

                		}

                		function blockUser($user_id)
                		{
                			ob_start();

                			$update_array = array();
                			$update_array['status'] = 'block';

                			$this->db->update(TBL_USER,$update_array,'user_id',$user_id);

                			$_SESSION['msg']='User has been Blocked successfully';

                			?>
                			<script type="text/javascript">
                				window.location = "editUser.php"
                			</script>
                			<?php

                			$html = ob_get_contents();
                			ob_end_clean();
                			return $html;
                		}

                		function unblockUser($user_id)
                		{
                			ob_start();

                			$update_array = array();
                			$update_array['status'] = '';

                			$this->db->update(TBL_USER,$update_array,'user_id',$user_id);

                			$_SESSION['msg']='Company has been Un-Blocked successfully';

                			?>
                			<script type="text/javascript">
                				window.location = "editUser.php"
                			</script>
                			<?php

                			$html = ob_get_contents();
                			ob_end_clean();
                			return $html;
                		}

                		function deleteUser($id)
                		{
                			ob_start();

                			$sql="delete from ".TBL_USER." where id='".$id."'";
                			$this->db->query($sql,__FILE__,__LINE__);

                			$_SESSION['msg']='Company has been Deleted successfully';

                			?>
                			<script type="text/javascript">
                				window.location = "showuser.php"
                			</script>
                			<?php

                			$html = ob_get_contents();
                			ob_end_clean();
                			return $html;
                		}



                	}


                	?>