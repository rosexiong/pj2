<?php 
session_start();
require 'Conf/blog.inc.php';
require BLOGPATH.'Libs/Function/fun.php';
$_SESSION['login'] = 0;
$_SESSION['loginuser'] ='';
ok_info('./index.php','恭喜你，成功退出！'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>日志_用户登录<?php echo $wzname;?>_<?php echo $wzversion;?></title>
<link href="Style/index.css" type="text/css" rel="stylesheet" />
<script src="Statics/Js/jquery-1.8.3.min.js" language="javascript"></script>
<script src="Statics/Js/userlogin.js" language="javascript"></script>
</head>
<body>
<div id="contain">
  <?php require 'top.php';?>
  <div id="box">恭喜你，成功退出！
  </div>
  <?php require 'foot.php';?>
</div>
</body>
</html>