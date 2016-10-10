	<!--顶部导航条start 登录状态-->
	<header id="masthead" >
		<div class="site site-header dark">
			<a href="<?=Yii::app()->url->getAdminLoginUrl()?>" id="header-logo"></a>
			<div id="header-links">
				<?php if(empty($this->session["adminname"])){?>
				<a href="<?=Yii::app()->url->getAdminLoginUrl()?>">登录</a>
				<?php }else{?>
					<?=$this->session["adminname"]?>
				<?php }?>
			</div>
		</div>
	</header>
	<!--顶部导航条end-->