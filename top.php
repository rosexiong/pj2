
        <header class="header">
            <div class="container-menu">
                <nav class="navbar navbar-default yamm">
                    <div class="container">
                        <div class="navbar-table">
                            <div class="navbar-cell">
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="index.php"><i class="fa fa-hashtag"></i> </a>
                                    <div class="open-menu">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="fa fa-bars"></span>
                                        </button>
                                    </div>
                                </div><!-- end navbar-header -->
                            </div><!-- end navbar-cell -->
                            <div class="navbar-cell stretch">
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                                    <div class="navbar-cell">
                                        <ul class="nav navbar-nav navbar-center">
                                            <li><a class="active" href="index.php" title="">首页</a></li>
                                            <li><a href="photos.php"title="">我的图片</a></li>
                                            <li><a href="register.php" title="">注册</a></li>
                                            <li><a href="login.php" title="">登录</a></li>
                                        </ul>
										<?php if(isset($_SESSION['loginuser']['id'])){?>
                                        <ul class="nav navbar-nav navbar-right">
                                            <li class="dropdown membermenu hovermenu">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
												<?php echo $_SESSION['loginuser']['u_name'];?>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-header">个人中心</li>
                                                    <li><a href="upload.php?id=<?php echo $_SESSION['loginuser']['id'];?>">上传图片</a></li>
                                                    <li><a href="photos.php?id=<?php echo $_SESSION['loginuser']['id'];?>">我的照片</a></li>
                                                    <li><a href="favorites.php?id=<?php echo $_SESSION['loginuser']['id'];?>">我的收藏</a></li>
                                                    <li><a href="logout_user.php">安全退出</a></li>
                                                    <li><hr></li>
                                                </ul>
                                            </li>
                                        </ul>
										<?php }else{?>
											 <ul class="nav navbar-nav navbar-right">
                                            <li class="dropdown membermenu hovermenu">
                                                <a href="login.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
												游客您好，请登录再上传图片
                                                
                                            </li>
                                        </ul>
										<?php }?> 
                                    </div><!-- end navbar-cell -->
                                </div><!-- /.navbar-collapse -->        
                            </div><!-- end navbar cell -->
                        </div><!-- end navbar-table -->
                    </div><!-- end container fluid -->
                </nav><!-- end navbar -->
            </div><!-- end container -->
        </header>