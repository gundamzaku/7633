	<div id="subhead" class="site dark"><h1>7663VR战网 企业会员中心</h1></div>


	<div id="main" class="site">
		<?php $this->widget('application.widgets.InfoLeftWidget');?>

		<div class="col-right entry-content">
			<div class="wrapper single" id="message-details">
				<h2>系统消息</h2>
				
				<h1 class=""><?=$message['title']?></h1>
				<time><?=$message['add_time']?></time>
				<div>
					<p><?=$message['content']?></p>
				</div>
				<ul class="pagenation">
					<li><a href="<?=Yii::app()->url->getMessageListUrl("p=".$p)?>">返回</a></li>
				</ul>
			</div>
		</div>
	</div>