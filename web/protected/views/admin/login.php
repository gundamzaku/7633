	<div id="header-home-logo" class="singleformlogo"></div>
	<div class="singleform dark">


		<form action="<?=Yii::app()->url->getAdminDoLoginUrl()?>" method="POST" id="form-login" class=""> 
			<fieldset>
				<label for="username">管理员帐号</label><input type="text" value="" id="adminname" name="adminname" />
			</fieldset>

			<fieldset>
				<label for="pwd">密码</label><input type="password" value="" id="pwd" name="pwd" />
			</fieldset>

			<fieldset>
				<input type="submit" value="登录"/><br/>
			</fieldset>
		</form>
	</div>