<?php

require_once("class/config.inc.php");

$userprofile = new User();
$notify = new Notification();
$auth= new Authentication();



extract($_REQUEST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
$auth->Destroy_Session_Userarea();
?>
</body>
</html>
