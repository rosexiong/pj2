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
<body class="nobg">

<?php 
session_start();
require 'Conf/blog.inc.php';
require BLOGPATH.'Libs/Function/fun.php';
checkLogin();
if($_GET['act']=='ok'&&!empty($_POST)){
	
	date_default_timezone_set('Asia/$hanghai');
	$uploaddir ='./upload';
	//上传文件目录
	$uploadfile=basename($_FILES['myfile']['name']);//获取文件完整名称，含路径
	$name=$_POST['name'];
	$myfile_name=$_FILES['myfile']['name'];
	if(empty($_FILES['myfile']['name'])){
		echo "<script language='javascript'>"; 
		echo "alert('请选择一个图片');";
		echo " location='./upload.php';"; 
		echo "</script>";exit();
	}
	if(empty($name)){
		echo "<script language='javascript'>"; 
		echo "alert('请输入图片标题');";
		echo " location='./upload.php';"; 
		echo "</script>";exit();
	}
	if(array_key_exists('myfile',$_FILES)){//这里的参数名字必须与表单中一致
		if(0==$_FILES['myfile']['error']){//为0说明上传操作完成
			$gbfile=iconv('utf-8','gb2312',$uploadfile);
			while(file_exists($uploaddir.$gbfile)){
				//如果文件名存在，则生成一个新文件名
				$fname=$_FILES['myfile']['name'];
				$arr = pathinfo($fname);
				$fext = $arr[extension];
				$n=strrpos($fname, $fext);
				echo 0;
				echo $n;
				//在主文件名末尾加 rename?和一个随机数
				$fmain = substr($fname,0,($n-1))."_rename".date("YmdHis").rand(1,100);
				$gbfile=$fmain.'.'.$fext;
				$gbbfile = iconv('utf-8','gb2312', $gbfile);
			}
			if (rename($_FILES['myfile']['tmp_name'], $uploaddir.'/'.$gbfile)){//
				//echo "临时文件更名成功，完成文件上传提作。\n";
				//上传成功后，自动返回首页
				$siteinfo = array(
				'imgs' => $_FILES['myfile']['name'],
				'uid'  => $_POST['uid'],
				'name'  => $_POST['name'],
				'zt'  => $_POST['zt'],
				'gj'  => $_POST['gj'],
				'cs'  => $_POST['cs'],
				'info'  => $_POST['info'],
				'r_date' => date('Y-m-d H:i:s')
				);
			
				$db->insert("photos", $siteinfo);
				echo "<script language='javascript'>"; 
				echo "alert('恭喜您,提交成功!');";
				echo " location='./photos.php';"; 
				echo "</script>";
			}else {
				echo "临时文件无法更名，上传操作失败，临时文件将被删除!\n";
			}

		}else{
			echo '文件上传出错，错误代码:',$_FILES['myfile']['error'];
		}
		////出上传文件的信息数组
		//echo '<br><br>文件上传信息:';
		//echo '<pre>';
		//print_r($_FILES);
		//echo "</pre>";
	}else{
		echo '出错了，未能执行文件上传操作!';
		echo '<hr><a href=uplode.php>返回</a>';
	}
}
?>
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
                            <h3>图片上传</h3>
                            <div class="bread">
                                <ol class="breadcrumb">
                                 <li><a href="index.php">首页</a></li>
                                  <li class="active">图片上传</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

             

                <div class="content boxs">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="widget-title">
                                <h4>图片上传</h4>
                            </div><!-- end widget-title -->
                            <form class="uploaditem" action="?act=ok"  method="post" id="formaa"  enctype="multipart/form-data">
                              

                                <div class="space">
                                    <label>选择图片</label>
                                    <input type="file" name="myfile" id="file" placeholder="选择图片">   
                                </div>

                                <div class="space">
                                    <label>图片标题 : </label>
                                    <input type="text" class="form-control" name="name" placeholder="">    
                                    <input type="hidden" name="uid" value="<?php echo $_SESSION['loginuser']['id'];?>">    
                                </div>
         

                                <div class="space">   
                                    <label>拍摄:主题/国家/城市: </label> 
                                   
                                   <?php  
require 'sear_sub.php';
?>
                                </div>

                                <div class="space">
                                    <label>图片描述 : </label>
                                    <textarea class="form-control" name="info"   placeholder=""></textarea>
                                </div>

                                <div class="space">
                                    <a href="#" class="btn btn-primary btn-block" onclick="$('#formaa').submit();">提交</a>
                                </div>

                            </form>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end content -->

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