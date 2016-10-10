	<div id="subhead" class="site dark"><h1><a href="<?=Yii::app()->url->getAdminMainUrl()?>">后台</a></h1></div>


	<div id="main" class="site">
		<div class="col-right entry-content">
			<div class="wrapper single" id="messages">
				<h2>广告列表(<a href="<?=Yii::app()->url->getAdminAddAdviertisementUrl()?>">添加</a>)</h2>
				
				<ul class="list-message">
					<?php foreach($adviertisement as $k=>$v){?>
						<li><time><?=$v['add_time']?></time><a href="<?=Yii::app()->url->getAdminUpdAdviertisementUrl("aid=".$v['aid']."&p=".$p)?>"><?=$v['title']?></a></li>
					<?php }?>
				</ul>
				<?=$page?>
			</div>
		</div>
	</div>