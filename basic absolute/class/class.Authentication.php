<?php
class Authentication // Basic class for authentication
{
	var $id;
	var $username;
	var $user_type;
	var $db;	
	var $location;
	var $email;


	function __construct()
	{
		$this->db = new database(DATABASE_HOST,DATABASE_PORT,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
		if(isset($_SESSION['username'])){
			$this->user_name=$_SESSION['username'];
			$this->id=$_SESSION['id'];
			$this->privileges=$_SESSION['email'];
			$this->user_type=$_SESSION['user_type'];
			$this->full_name=$_SESSION['location'];
			
		}
	} 
	function newlogin(){

		$con = mysqlii_connect("localhost", "root", "", "absolute");
		if (!$con) {
			echo'not connected';
		}

		if (isset($_POST ['sub'])) {
			$user = $_POST['abc'];
			$password = $_POST['pass'];
			$sq1 = "select * from tbl_user where user='$user' and password='$password'";
			$qu1 = mysqlii_query($con, $sq1);
			if (mysqlii_num_rows($qu1) > 0) {
				$f = mysqlii_fetch_assoc($qu1);
				$_SESSION['id'] = $f['id'];
        // $_SESSION['login'] = 'yes';
				header('location:welcome.php');
			} else {
				echo "<script>alert('username password does not match')</script>";
			} 
		}
		?>



		<form  class="form-container" method="POST" enctype="multipart/form-data">

			<label>Login ID/UserName</label>
			<input class="ab" type="text" id="t1" name="abc" placeholder="Enter your login id/UserName">
			<td><div id="error1" style="color:red"></div></td>
			<div class="form-group">
				<label>password</label>
				<input class="ab" type="password" id="t2" name="pass" placeholder="Password">
				<td><div id="error2" style="color:red"></div></td>
			</div>

			<td><input type="SUBMIT" value="LOGIN" name="sub" style="background-color:#00cccc"></td>


		</form>


		<?php

	}


	function setHttp_Referer($http_referer)
	{
		$_SESSION['http_referer'] =	'..'.$http_referer;		
	}

	function Create_Session($username,$id,$email,$user_type,$location){
		$this->username=$username;
		$this->id=$id;
		$this->email=$email;
		$this->user_type=$user_type;
		$this->location=$location;
		$_SESSION['username'] = $this->username;
		$_SESSION['id'] = $this->id;
		$_SESSION['email']= $this->email;
		$_SESSION['user_type'] = $this->user_type;
		$_SESSION['location'] = $this->location;

	}
	function Create_Session_Userarea($username,$id,$email,$user_type,$location){
		$this->username=$username;
		$this->id=$id;
		$this->email=$email;
		$this->user_type=$user_type;
		$this->location=$location;
		$_SESSION['username'] = $this->username;
		$_SESSION['id'] = $this->id;
		$_SESSION['email']= $this->email;
		$_SESSION['user_type'] = $this->user_type;
		$_SESSION['location'] = $this->location;
		$_SESSION['msg']=$this->WelcomeMessage();

	}
	function Destroy_Session_Userarea(){
		unset($_SESSION['username']); 
		unset($_SESSION['id']); 
		unset($_SESSION['email']); 
		unset($_SESSION['user_type']); 
		unset($_SESSION['location']); 
		unset($_SESSION['http_referer']); 
		$_SESSION['msg']='You have logged out successfully';
		?>
		<script type="text/javascript">
			window.location="index.php";
		</script>
		<?
	}

	function Get_username()
	{
		return $this->username;
	}

	function Get_id()
	{
		return $this->id;
	}

	function Get_email()
	{
		return $this->email;
	}

	function Get_user_type()
	{
		return $this->user_type;
	}

	function Get_location()
	{
		return $this->location;
	}

	function Destroy_Session(){
		unset($_SESSION['username']); 
		unset($_SESSION['id']); 
		unset($_SESSION['email']); 
		unset($_SESSION['user_type']); 
		unset($_SESSION['location']); 
		unset($_SESSION['http_referer']); 
		$_SESSION['msg']='You\'ve signed out, '.$this->username;
		?>
		<script type="text/javascript">
			window.location="index.php";
		</script>
		<?php
	}

	function checkAuthentication()
	{
			//check for the valid login
		if(isset($_SESSION['username']))
			return true;
		else return false;
	}

	function Checklogin()
	{
		$this->setHttp_Referer($_SERVER['REQUEST_URI']);  
		if(!$this->checkAuthentication()){
			$_SESSION['error_msg']='Please login here first..';
			$this->GotoLogin();
			exit();
		}
		
		
	}

	function GotoLogin()
	{
		?>
		<script type="text/javascript">
			window.location='index.php';
		</script>
		<?php
	}

	function checkAdminAuthentication()
	{
			//check for the valid login
		if(isset($_SESSION['username']))
			return true;
		else return false;
	}

	function CheckAdminlogin()
	{
		$this->setHttp_Referer($_SERVER['REQUEST_URI']);  
		if(!$this->checkAdminAuthentication()){
			$_SESSION['error_msg']='Please login here first..';
			$this->GotoAdminLogin();
			exit();
		}
		
		
	}

	function GotoAdminLogin()
	{
		?>
		<script type="text/javascript">
			window.location='index.php';
		</script>
		<?php
	}

	function SendToRefrerPage()
	{	
		if($_SERVER['HTTP_REFERER']==''){
			?>
			<script type="text/javascript">
				window.location='index.php';
			</script>
			<?php
		}
		else
		{
			?>
			<script type="text/javascript">
				window.location='<?php echo $_SERVER['HTTP_REFERER']; ?>';
			</script>
			<?php
		}		
		exit();
	}

	function CheckAuthorization($feature)
	{
			//check for the group access
		$access=true;
		$privilege_array = explode('^',$this->privileges);
		if(!in_array($feature,$privilege_array))
			$access = false;

		if(!$access)
		{
			$_SESSION['msg']='oops !! Your are not authorised to access this page, Please contact Administrator.';
			$this->SendToRefrerPage();
		}
	}

	function CheckAuthorizationAction($feature)
	{
			//check for the group access
		$access=true;
		$privilege_array = explode('^',$this->privileges);
		if(!in_array($feature,$privilege_array))
			$access = false;
		else 
			$access = true;

		return $access;
	}

		/*function CheckAuthorization($access_rules,$access_rules_type,$returnValue=false)
		{
			//check for the group access
			$access=true;
			$search_array = array('first' => 1, 'second' => 4);
			foreach($access_rules as $key => $value)
			{
				if (array_key_exists($key, $this->groups))
				{
					if($value!=$this->groups[$key])
					{
						$access=false;
						if($access_rules_type=='all')
						break;
					}
					else
					{
						$access=true;
						if($access_rules_type=='any')
						break;
					}
				}
				else
				{
						$access=false;
						if($access_rules_type=='all')
						break;
				}
			}
			
			if(!$access and !$returnValue)
			{
				$_SESSION['error_msg']='oops !! Your are not authorised to access this page, Please contact Administrator.';
				$this->SendToRefrerPage();
			}
			else
			return $access;
		}*/
		
		function WelcomeMessage()
		{
			return "Welcome ".$this->username." , You have logged in successfully.. ";

		}
	}	
	?>
