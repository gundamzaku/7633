	<?php use yii\widgets\ActiveForm;?>
	<div id="subhead" class="site dark"><h1><a href="<?=Yii::app()->url->getAdminMainUrl()?>">后台</a></h1></div>
	<div id="main" class="site">

		<div class="col-right entry-content">
			<div class="wrapper single" id="profile">
				<h2>添加系统消息（<a href="<?=Yii::app()->url->getAdminMessageUrl()?>">返回</a>）</h2>
				<form action="<?=Yii::app()->url->getAdminDoAddMessageUrl()?>" method="POST" id="form-profile" class="" enctype="multipart/form-data"> 
					<fieldset>
						<label for="title">标题</label><input type="text" value="<?=$title?>" id="title" name="title" /><input type="hidden" readonly value="<?=$mid?>" name="mid" />
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="url">正文</label><textarea name="content" rows="4" cols="30"><?=$content?></textarea>
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<input type="submit" id="button_update" value="保存修改"/>
					</fieldset>
				</form>
			</div>
		</div>
	</div>