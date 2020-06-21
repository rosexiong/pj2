 <div class="widget-title">
<h4>个人中心</h4>
<hr>
<li><a href="upload.php?id=<?php echo $_SESSION['loginuser']['id'];?>">上传图片</a></li>
<li><a href="photos.php?id=<?php echo $_SESSION['loginuser']['id'];?>">我的照片</a></li>
<li><a href="favorites.php?id=<?php echo $_SESSION['loginuser']['id'];?>">我的收藏</a></li>
<li><a href="logout_user.php">安全退出</a></li>
</div><!-- end widget-title -->