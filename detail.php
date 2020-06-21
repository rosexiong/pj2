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
    <link rel="stylesheet" type="text/css" href="css/flexslider.css">
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
$id = $_GET['id'];
$gj_list = getgj();					
$cs_list = getcs();	
$sql="select * from photos where id='{$id}' order by id desc";
$one = $db->get_one($sql,MYSQLI_ASSOC);
?>
        <section class="section single-wrap">
            <div class="container">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sx-12 text-center">
                            <h3><?php echo $one['name'];?></h3>
                        </div>
                    </div>
                </div>

                <div class="content-top">
                    <div class="row">
                       

                        <div class="col-sm-12 col-xs-12 cen-xs text-left">
                            <div class="bread">
                                <ol class="breadcrumb">
                                  <li><a href="index.php">首页</a></li>
                                  <li><a href="#">详情</a></li>
                                  <li class="active"><?php echo $one['name'];?></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- end row -->
                </div><!-- end content top -->

                <div class="row">
                    <div id="singlewrapper" class="col-md-8">
                       

                        <div class="content nopad">
                            <div class="item-single-wrapper">
                                <div class="item-box">
                                    <div class="item-media text-center">
                                       <img src="upload/<?php echo $one['imgs'];?>" alt="" class="img-responsive">
                                    </div><!-- end item-media -->

                                    <div class="item-desc">
                                        <p> <?php echo $one['info'];?></p>
  </div><!-- end item-desc -->
                                </div><!-- end item-box -->
                            </div><!-- end item-single-wrapper -->
                        </div><!-- end content -->

                        
                    </div><!-- end singlewrapper -->

                    <div id="sidebar" class="col-md-4">
                        <div class="boxes boxs">
                            <div class="item-price text-center">
                                <p>主题：<?php echo empty($one['zt'])?'无':$one['zt'];?></p>
                                <em>国家：<?php echo $gj_list[$one['gj']];?> /城市：<?php echo $cs_list[$one['cs']];
								
								
								?></em>
                          
                                <hr>
                                <a href="favorites.php?pid=<?php echo $one['id'];?>" class="btn btn-primary"><i class="fa fa-star-o"></i>收藏</a>
                            </div><!-- end price -->
                        </div><!-- end boxes -->

                    </div><!-- end sidebar -->
                </div><!-- end row -->

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
    <!-- FlexSlider JavaScript
    ================================================== -->
    <script src="js/flexslider.js"></script>
    <script>
        (function($) {
        "use strict";
        $(window).load(function() {
            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                directionNav: false,
                animationLoop: true,
                slideshow: true,
                itemWidth: 92,
                itemMargin: 0,
                asNavFor: '#slider'
            });
       
            $('#slider').flexslider({
                animation: "fade",
                controlNav: false,
                animationLoop: false,
                slideshow: true,
                sync: "#carousel"
            });
        });
        })(jQuery);
    </script>


</body>
</html>