<?php
require_once("class/config.inc.php");
require_once("class/class.post.php");
extract($_REQUEST);
$ajax=new PHPLiveX();
$auth = new Authentication();


?>
<html>
<body>
	<?php $auth->newlogin();?>			
</body>