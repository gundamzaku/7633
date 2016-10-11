	<!--顶部导航条start 登录状态-->
	<header id="masthead" >
		<div class="site site-header dark">
			<a href="<?=Yii::app()->url->getIndexUrl()?>" id="header-logo"></a>
			<div id="header-links">
			<?php if(empty($this->session["usernname"])){?>
			<a href="<?=Yii::app()->url->getLoginUrl()?>">登录</a>
			<?php }else{?>
				<?=$this->session["usernname"]?>|<a href="<?=Yii::app()->url->getLoginOutUrl()?>">退出</a>
			<?php }?>
			</div>
		</div>
	</header>
	<!--顶部导航条end-->