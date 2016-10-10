	<?php use yii\widgets\ActiveForm;?>
	<div id="subhead" class="site dark"><h1><a href="<?=Yii::app()->url->getAdminMainUrl()?>">后台</a></h1></div>
	<div id="main" class="site">

		<div class="col-right entry-content">
			<div class="wrapper single" id="profile">
				<h2>添加广告（<a href="<?=Yii::app()->url->getAdminAdviertisementUrl()?>">返回</a>）</h2>
				<form action="<?=Yii::app()->url->getAdminDoAddAdviertisementUrl()?>" method="POST" id="form-profile" class="" enctype="multipart/form-data"> 
					<fieldset>
						<label for="title">广告标题</label><input type="text" value="<?=$title?>" id="title" name="title" /><input type="hidden" readonly value="<?=$aid?>" name="aid" />
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="icon">广告图片</label>
						<input type="file" name="icon"/>
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="icon"></label>
						请上传280x506px尺寸的图片
					</fieldset>
					<?php if(!empty($icon)){?>
					<fieldset>
						<label for="icon">展示</label>
						<img src="<?=$icon?>"/><input type="hidden" value="<?=$icon?>" name="icon_old" readonly/>
					</fieldset>	
					<?php }?>
					<fieldset>
						<label for="url">广告地址</label><input type="text" value="<?=$url?>" id="url" name="url" />
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<input type="submit" id="button_update" value="保存修改"/>
					</fieldset>
				</form>
			</div>
		</div>
	</div>