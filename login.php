<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- SITE META -->
    <title>图片管理</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">

    <!-- TEMPLATE STYLES -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
    <link rel="stylesheet" type="text/css" href="css/flexslider.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<?php 
session_start();
require_once('config.php');

if($_POST['act']=='ok'){
	$sql="select * from c_user where u_name='{$_POST['b_name']}' and u_pwd='{$_POST['b_pwd']}'
	order by id desc";
	$u_r = $db->get_all($sql,MYSQLI_ASSOC);


	if(empty($u_r)){
		ok_info(0,"用户名密码输入有误!");
	}else{
		$_SESSION['login'] = 1;
		$_SESSION['loginuser'] = $u_r[0];
		
		ok_info('./index.php','恭喜你，登录成功！');
	}
}
?>
<body>

    <!-- START SITE -->
    <div id="wrapper">

<?php  
require 'top.php';
?>
        <section class="section single-wrap">
            <div class="container">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sx-12 text-center">
                            <h3>用户登录</h3>
                        </div>
                    </div>
                </div>

             

            
                <div class="content boxs">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="page-content">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="widget">
                                            <div class="widget-title">
                                                <h4>用户登录</h4>
                                            </div><!-- end widget-title -->

                                            <div class="login-form">
                                                <form method="post" action="" role="login" id='formlogin'>
                                                    <div class="form-group">
                                                        <label>姓名</label>
                                                        <input type="text" name="b_name" required class="form-control" placeholder="" />
                                                        <span class="fa fa-user"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>密码</label>
                                                        <input type="password" name="b_pwd" required class="form-control" placeholder="" />
                                                        <span class="fa fa-lock"></span>
                                                    </div>
													<input type="hidden" name="act" value="ok" class="b_submit" />
                                                    <button type="submit" name="go" class="btn btn-primary" onclick="$('#formlogin').submit();">提交</button>
                                                </form>
                                            </div><!-- end login-form -->
                                        </div><!-- end widget -->
                                    </div><!-- end col -->

                                    
                                </div><!-- end row -->
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end content -->

                <br>

            </div><!-- end container -->
        </section>

        <footer class="footer">
            <?php  
require 'end.php';
?>
        </footer><!-- end footer -->
    </div><!-- end wrapper -->
    <!-- END SITE -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

</body>
</html>