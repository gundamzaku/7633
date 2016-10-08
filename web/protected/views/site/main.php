	<div id="subhead" class="site dark"><h1><?=WATCHWORD?></h1></div>


	<div id="main" class="site">
		<?php $this->widget('application.widgets.InfoLeftWidget');?>

		<div class="col-right entry-content">
			<div class="col-right-1">
				<a href="<?=Yii::app()->url->getUserProfileUrl()?>" class="bt-dashboard" id="bt-1">
					<h3>用户资料</h3>
					<p>进入修改资料页面</p>
					<span class="arraw"></span>
				</a>
				<a href="<?=Yii::app()->url->getUserSecurityUrl()?>" class="bt-dashboard" id="bt-2">
					<h3>账户安全</h3>
					<p>修改账户密码</p>
					<span class="arraw"></span>
				</a>
				<a href="<?=Yii::app()->url->getOrdersUrl()?>" class="bt-dashboard" id="bt-3">
					<h3>订单记录</h3>
					<p>擦看您的历史订单</p>
					<span class="arraw"></span>
				</a>
				<a href="<?=Yii::app()->url->getPayUrl()?>" class="bt-dashboard" id="bt-4">
					<h3>充值付费</h3>
					<p>选择付费方式进行充值</p>
					<span class="arraw"></span>
				</a>
			</div>
			<div class="col-right-2 dark">
				<div class="wrapper" id="messages">
					<h2>系统消息</h2>
					<ul class="list-message">
						<?foreach($message as $k=>$v){?>
						<li><time><?=$v['add_time']?></time><a href="<?=Yii::app()->url->getMessageDetailUrl("mid=".$v['mid'])?>"><?=$v['title']?></a></li>
						<?}?>
					</ul>
					<a href="<?=Yii::app()->url->getMessageListUrl()?>" class="more">更多</a>
				</div>
			</div>
		</div>
	</div>