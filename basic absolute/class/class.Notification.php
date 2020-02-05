<?php
//**************** Notification class Created for displaying notification messages across the website ****************
class Notification
{
	
	var $notice;	
	var $timeout;
	
	function __construct()
	{
		if(isset($_SESSION['msg'])){
			$this->notice = $_SESSION['msg'];
			$this->error = $_SESSION['error_msg'];
		}
		$this->timeout=15000;
	}
	function SetNote($note)
	{
		$this->notice=$note;
	}

	function SetTimeout($SetTimeout)
	{
		$this->SetTimeout=$SetTimeout;
	}

	function Notify()
	{
		if($this->notice!='') {
			?>
			<script type="text/javascript">
				setTimeout('document.getElementById("message_t").style.display="none";',<?php echo $this->timeout; ?>);
			</script> 
			<div   id="message_t" >
				<div class='alert_success'>
					<a class="close" data-dismiss="alert"></a>
					<img src="images/success.png" style="height:15px;" alt="Success!" style="vertical-align:sub;"/> <?php echo $this->notice; ?>.
				</div>
			</div>
			<?php
			$this->destroy_note();
		}
		else if($this->error!='')
		{
			?>
			<script type="text/javascript">
				setTimeout('document.getElementById("message_er").style.display="none";',<?php echo $this->timeout; ?>);
			</script> 
			<div  id="message_er">
				<div class='alert_error'>
					<a class="close" data-dismiss="alert"></a>
					<img src="images/invalid.png" style="height:15px;" alt="Error!" style="vertical-align:sub;"/> <?php echo $this->error; ?>.
				</div>
			</div>
			<?php
			$this->destroy_note();
		}
	}

	function destroy_note()
	{
		$_SESSION['msg']='';
		$_SESSION['error_msg']='';
	}
	
}

?>