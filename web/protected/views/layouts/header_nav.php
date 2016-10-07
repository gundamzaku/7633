	<!--顶部导航条start 登录状态-->
	<header id="masthead" >
		<div class="site site-header dark">
			<a href="<?=Yii::app()->url->getIndexUrl()?>" id="header-logo"></a>
			<div id="header-links" class="logged">
				<a href="<?=Yii::app()->url->getIndexUrl()?>">用户中心首页</a>
				<a href="<?=Yii::app()->url->getUserProfileUrl()?>">用户资料</a>
				<a href="<?=Yii::app()->url->getUserSecurityUrl()?>">账户安全</a>
				<a href="<?=Yii::app()->url->getOrdersUrl()?>">订单记录</a>
				<a href="<?=Yii::app()->url->getPayUrl()?>">充值付费</a>
				<a href="<?=Yii::app()->url->getMessageListUrl()?>">系统消息</a>
				<a href="<?=Yii::app()->url->getLoginOutUrl()?>">退出</a>
			</div>
		</div>
	</header>
	<!--顶部导航条end-->