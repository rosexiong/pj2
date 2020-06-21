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
require 'Conf/blog.inc.php';
require BLOGPATH.'Libs/Class/page.class.php';
require BLOGPATH.'Libs/Function/fun.php';
checkLogin();
?>
<body>

    <!-- START SITE -->
    <div id="wrapper">

<?php  
require 'top.php';
?>
        <section class="section single-wrap">
            <div class="container">
                <div class="page-title public-profile-title">
                    <div class="row">
                        <div class="col-sx-12 text-center">
                            <h3>我的照片</h3>
                        </div>
                    </div>
                </div>

                <div class="content-top">
                    <div class="row">

                        <div class="col-sm-6 col-xs-12 cen-xs text-left">
                            <div class="bread">
                                <ol class="breadcrumb">
                                  <li><a href="index.php">首页</a></li>
                                  <li class="active">我的照片</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- end row -->
                </div><!-- end content top -->

                <div class="content-before">
                    <div class="row">
                       
                        <div class="col-md-6 text-right hidden-xs">
           
                        </div>
                    </div><!-- end row -->
                </div><!-- end content before -->

                <div class="content boxs">
                    <div class="row">
                        <div class="col-md-9 col-sm-12 pull-right">
                            <div class="storelist panel panel-info">
                                <div class="panel-body">
								<?php 
$gj_list = getgj();					
$cs_list = getcs();	
		$sqltype = '';
		if(!empty($_POST)){
			$key = $_POST['key'];
			$sqltype.= " and ( b_title like '%{$key}%' )";
		}
		
	
		
		$view_nums = 5;	
		$sql="select id from photos where uid='{$_SESSION['loginuser']['id']}'  $sqltype order by id desc";
		
		
		$ids=$db->get_all($sql,MYSQL_ASSOC);
		if($ids){
			foreach($ids as $k){
				$xyids.=$k['id'].',';  
			}
		}
		$xyids=substr($xyids,0,strlen($xyids)-1);
		$total=count($ids);
		$page=new page_link($total,$view_nums);
		$sql="select * from photos where id in($xyids) $sqltype order by id desc limit $page->firstcount,$page->displaypg";
	
		$result=$db->get_all($sql,MYSQL_ASSOC);
	
		if(empty($result)){echo '暂时没有合适的数据';}else{
				foreach($result as $k=>$v){?>
                                    <div class="form-group row wow fadeIn">
                                        <div class="col-sm-2 col-xs-12">
                                            <a href="detail.php?id=<?php echo $v['id'];?>">
											<img alt="" class="img-responsive img-thumbnail" src="upload/<?php echo $v['imgs'];?>"></a>
                                        </div>
                                        <div class="col-sm-7 col-xs-12">
                                            <h4><a href="?id=<?php echo $v['id'];?>"><?php echo $v['name'];?></a></h4>
                                            <ul>
                                                <li><a href="#"><i class="fa fa-tags"></i> <?php echo empty($v['zt'])?'无':$v['zt'];?></a></li>
                                                <li><a href="#"><i class="fa fa-university"></i> <?php echo $gj_list[$v['gj']];?> / <?php echo $cs_list[$v['cs']];?></a></li>
                                                <li><a href="#"><i class="fa fa-newspaper-o"></i> <?php echo $v['info'];?> </a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3 col-xs-12 text-center">
                                            <ul>
                                                <li><a href="del.php?table=photos&id=<?php echo $v['id'];?>" class="btn btn-primary btn-block">删除</a></li>
                                              
                                            </ul>
                                        </div>
                                    </div><!-- end form-group -->       

                                    <hr>

<?php
		  }
		}
		  ?>
                                      
       
                                </div><!-- end panel-body -->
                            </div><!-- end storelist -->
                        </div><!-- end col -->

                        <div id="sidebar" class="col-md-3 col-xs-12">
                            <div class="widget">
							<?php  
							require 'left_nav.php';
							?>
                            </div><!-- end widget -->


                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end content -->

                <div class="content-after text-center boxs">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="pagination-wrapper">
                                <ul class="pagination">
                                    <?php
		echo $page->show_link();
		?>
                                </ul>
                            </nav>
                        </div>
                    </div><!-- end row -->
                </div><!-- end content after -->

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