    <script type="text/javascript" charset="utf-8" src="js/uedit/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/uedit/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="js/uedit/lang/zh-cn/zh-cn.js"></script>	
	<?php use yii\widgets\ActiveForm;?>
	<div id="subhead" class="site dark"><h1><a href="<?=Yii::app()->url->getAdminMainUrl()?>">后台</a></h1></div>
	<div id="main" class="site">

		<div class="col-right entry-content">
			<div class="wrapper single" id="profile">
				<h2>添加店铺（<a href="<?=Yii::app()->url->getAdminStoreUrl()?>">返回</a>）</h2>
				<form action="<?=Yii::app()->url->getAdminDoAddStoreUrl()?>" method="POST" id="form-profile" class="" enctype="multipart/form-data"> 
					<fieldset>
						<label for="title">店铺标题</label><input type="text" value="<?=$title?>" id="title" name="title" /><input type="hidden" readonly value="<?=$sid?>" name="sid" />
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="icon">店铺图片</label>
						<input type="file" name="icon"/>
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="icon"></label>
						请上传900x560px尺寸的图片
					</fieldset>
					<?php if(!empty($icon)){?>
					<fieldset>
						<label for="icon">展示</label>
						<img src="<?=$icon?>"/><input type="hidden" value="<?=$icon?>" name="icon_old" readonly/>
					</fieldset>	
					<?php }?>
					<!--
					<fieldset>
						<label for="url">店铺地址</label><input type="text" value="<?=$url?>" id="url" name="url" />
						<div class="msg error" style="display:none"></div>
					</fieldset>-->
					<fieldset>
						<label for="content">店铺简介</label>
						<script id="content" type="text/plain" style="width:600px;height:300px;"></script>
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
		var ue = UE.getEditor('content');
		ue.addListener("ready", function () {
			ue.setContent('<?=$content?>');
		});
	</script>