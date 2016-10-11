    <script type="text/javascript" charset="utf-8" src="js/uedit/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/uedit/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="js/uedit/lang/zh-cn/zh-cn.js"></script>
	<?php use yii\widgets\ActiveForm;?>
	<div id="subhead" class="site dark"><h1><a href="<?=Yii::app()->url->getAdminMainUrl()?>">后台</a></h1></div>
	<div id="main" class="site">

		<div class="col-right entry-content">
			<div class="wrapper single" id="profile">
				<h2>设置店铺（<a href="<?=Yii::app()->url->getAdminMainUrl()?>">返回</a>）</h2>
				<form action="<?=Yii::app()->url->getAdminDoUpdSettingUrl()?>" method="POST" id="form-profile" class="" enctype="multipart/form-data"> 
					<fieldset>
						<label for="download_url">下载地址</label><input type="text" value="<?=$download_url?>" id="download_url" name="download_url" />
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="icon">游戏数量</label>
						<input type="text" value="<?=$games_num?>" id="games_num" name="games_num" />
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="shops_num">店铺数量</label>
						<input type="text" value="<?=$shops_num?>" id="shops_num" name="shops_num" />
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="url">激活码获得技巧</label>
						<script id="invite_method" type="text/plain" style="width:600px;height:300px;"></script>
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<input type="submit" id="button_update" value="保存修改"/>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
<script type="text/javascript">
    var ue = UE.getEditor('invite_method');
	ue.addListener("ready", function () {
		ue.setContent('<?=$invite_method?>');
	});
</script>