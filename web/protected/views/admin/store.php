	<div id="subhead" class="site dark"><h1><a href="<?=Yii::app()->url->getAdminMainUrl()?>">后台</a></h1></div>


	<div id="main" class="site">
		<div class="col-right entry-content">
			<div class="wrapper single" id="messages">
				<h2>商铺列表(<a href="<?=Yii::app()->url->getAdminAddStoreUrl()?>">添加</a>)</h2>
				
				<ul class="list-message">
					<?php foreach($store as $k=>$v){?>
						<li><time><?=$v['add_time']?></time><a href="<?=Yii::app()->url->getAdminUpdStoreUrl("sid=".$v['sid']."&p=".$p)?>"><?=$v['title']?></a>
						<a href="javascript:;" style="float:right;" onclick="removeData(this,'store','<?=$v['sid']?>')">删除</a>
						</li>
					<?php }?>
				</ul>
				<?=$page?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	<!--
	var url = "<?=Yii::app()->url->getAdminDoDeleteUrl()?>";
	//-->
	</script>
	<script src="js/delete.js" type="text/javascript"></script>