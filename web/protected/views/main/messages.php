	<div id="subhead" class="site dark"><h1>7663VR战网 企业会员中心</h1></div>


	<div id="main" class="site">
		<?php $this->widget('application.widgets.InfoLeftWidget');?>

		<div class="col-right entry-content">
			<div class="wrapper single" id="messages">
				<h2>系统消息</h2>
				
				<ul class="list-message">
					<?foreach($message as $k=>$v){?>
						<li><time><?=$v['add_time']?></time><a href="<?=Yii::app()->url->getMessageDetailUrl("mid=".$v['mid']."&p=".$p)?>"><?=$v['title']?></a></li>
					<?}?>
				</ul>
				<?=$page?>
				<!--
				<ul class="pagenation">
					<li><a href="###">上一页</a></li>
					<li><a href="###">1</a></li>
					<li><a href="###">2</a></li>
					<li><a href="###">3</a></li>
					<li><a href="###">下一页</a></li>
					<li>50条/页</li>
				</ul>-->
			</div>
		</div>
	</div>