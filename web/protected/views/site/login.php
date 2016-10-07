	<div id="header-home-logo" class="singleformlogo"></div>
	<div class="singleform dark">


		<form action="<?=Yii::app()->url->getDoLoginUrl()?>" method="POST" id="form-login" class=""> 
			<fieldset>
				<label for="username">用户名(邮箱)</label><input type="text" value="" id="username" name="username" />
			</fieldset>

			<fieldset>
				<label for="pwd">密码</label><input type="password" value="" id="pwd" name="pwd" />
			</fieldset>

			<fieldset>
				<input type="submit" value="登录"/><br/>
			</fieldset>
			<fieldset class="formfooter">
			<a href="javascript:;" id="forget_pass">忘记密码？</a> <br/> <a href="<?=Yii::app()->url->getRegisterUrl()?>">没有帐号？</a>
			</fieldset>
		</form>

		<form action="<?=Yii::app()->url->getFindPwdUrl()?>" method="POST" id="form-forget" class="" style="display:none"> 
			<h1>请填写您注册时使用的邮箱以找回密码。</h1>
			<fieldset>
				<label for="username">用户名(邮箱)</label><input type="text" value="" id="username" name="username" />
				<div class="msg error" style="display:none"></div>
			</fieldset>

			<fieldset>
				<input type="button" id="find_pwd" value="找回密码"/><br/>
			</fieldset>
			<fieldset class="formfooter">
			<a href="javascript:;" id="return_login">返回登录</a>
			</fieldset>
		</form>
	</div>
	<script src="js/regist.js" type="text/javascript"></script>
	<script type="text/javascript">
	<!--
	$("#forget_pass").bind("click",function(){
		$("#form-login").hide();
		$("#form-forget").show();
	});	

	$("#return_login").bind("click",function(){
		$("#form-forget").hide();
		$("#form-login").show();
	});	
	var regist = new Regist();
	var username = $("#form-forget").find("#username");
	regist.setUsername(username);

	username.bind("blur",function(){
		regist.validUsername();
	});

	$("#find_pwd").bind("click",function(){
		if(regist.validUsername() == true){
			$("#form-forget").submit();
		}
	});
	//-->
	</script>