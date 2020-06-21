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
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<?php  
require 'Conf/blog.inc.php';
require BLOGPATH.'Libs/Class/page.class.php';
require BLOGPATH.'Libs/Function/fun.php';
?>
<body>

    <!-- START SITE -->
    <div id="wrapper">

<?php  
require 'top.php';
?>


        <section class="section single-wrap">
            <div class="container">
               


                <div class="content-before">
                    <div class="row">
                        <div class="col-md-12 col-sx-12 cen-xs">
                        <form class="dropForm" action="search.php" method="post" id="form_index">
<div class="input-prepend">  
                                   <?php  
require 'sear_sub.php';
?>
	<input type="text" class="form-control"name="key" placeholder="输入关键字">
			<button class="btn btn-primary" tabindex="-1" onclick="$('#form_index').submit();"><i class="fa fa-search"></i></button>
</div>
</form>
                                    
                        </div>
                    </div><!-- end row -->
                </div><!-- end content before -->

                <div class="content">
                    <div class="row">
                        <div class="col-md-12 general-title">
                            <h4>图片列表<span class="hidden-xs"></span></h4>
                            <hr>
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <div class="row">
					<?php
$gj_list = getgj();					
$cs_list = getcs();				
		$sqltype = '';
		if(!empty($_POST)){
			$key = $_POST['key'];
			//$sqltype.= " and ( b_title like '%{$key}%' )";
		}
		
	
		
		$view_nums = 15;	
		$sql="select id from photos where 1=1  $sqltype order by id desc";
		
		
		$ids=$db->get_all($sql,MYSQL_ASSOC);
		if($ids){
			foreach($ids as $k){
				$xyids.=$k['id'].',';  
			}
		}
		$xyids=substr($xyids,0,strlen($xyids)-1);
		$total=count($ids);
		$page=new page_link($total,$view_nums);
		
		$sql="select photos.name as name
		,photos.id as id
		,photos.imgs as imgs
		,photos.zt as zt
		,photos.gj as gj
		,photos.cs as cs
		,photos.info as info
		,c_user.u_name as author 
		from photos 
		left join c_user
		on c_user.id=photos.uid
		where photos.id in($xyids) $sqltype 
		order by photos.id desc limit $page->firstcount,$page->displaypg";
		//echo $sql;
	
		$result=$db->get_all($sql,MYSQL_ASSOC);
		//echo $sql;
		if(empty($result)){echo '暂时没有合适的数据';}else{
				foreach($result as $k=>$v){?>
                        <div class="col-md-3 col-sm-6">
                            <div class="item-box">
                                <div class="item-media entry">
								    <a href="detail.php?id=<?php echo $v['id'];?>">
                                    <img src="upload/<?php echo $v['imgs'];?>" style="width:270px;height:180px;"  alt="" class="img-responsive">
									</a>
                                    <div class="magnifier">
                                        <div class="item-author">
                                            <a href="detail.php?id=<?php echo $v['id'];?>"><?php echo $v['info'];?></a>
                                        </div><!-- end author -->
                                    </div>
                                </div><!-- end item-media -->
                                <h4><a href="detail.php?id=<?php echo $v['id'];?>"><?php echo $v['name'];?></a></h4>
                                <small><a href="detail.php?id=<?php echo $v['id'];?>"><i class="fa fa-tags"></i> <?php echo empty($v['zt'])?'无':$v['zt'];?></a></small>
                                <small><a href="detail.php?id=<?php echo $v['id'];?>"><i class="fa fa-university"></i><?php echo $gj_list[$v['gj']];?> / <?php echo $cs_list[$v['cs']];?></a></small>
                                <small><a href="detail.php?id=<?php echo $v['id'];?>"><i class="fa fa-user"></i><?php echo $v['author'];?></a></small>
                            </div><!-- end item-box -->
                        </div><!-- end col -->
<?php
		  }
		}
		  ?>

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