	<div id="subhead" class="site dark"><h1><?=WATCHWORD?></h1></div>


	<div id="main" class="site">
		<?php $this->widget('application.widgets.InfoLeftWidget');?>

		<div class="col-right entry-content">
			<div class="wrapper single" id="security">
				<h2>修改密码</h2>
				<form action="<?=Yii::app()->url->getDoUserSecurityUrl()?>" method="POST" id="form-password" class=""> 
					<fieldset>
						<label for="currentpwd">当前密码</label><input type="password" value="" id="currentpwd" name="currentpwd" />
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset><hr/></fieldset>
					<fieldset>
						<label for="newpwd">新的密码</label><input type="password" value="" id="newpwd" name="newpwd"/>
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="newpwdrepeat">重复新的密码</label><input type="password" value="" id="newpwdrepeat" name="newpwdrepeat"/>
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<input type="button" id="button_update_pwd" value="保存修改"/>
					</fieldset>

				</form>
			</div>
		</div>
	</div>
	<script src="js/regist.js" type="text/javascript"></script>
	<script type="text/javascript">
	<!--
	var regist = new Regist();
	
	regist.setPwd($("#newpwd"));
	regist.setRepeatpwd($("#newpwdrepeat"));
	regist.setCurrentpwd($("#currentpwd"));
	regist.setForm($("#form-password"));

	$("#form-password").find("input").each(function(){
		switch($(this).attr("id")){
			case "currentpwd":
				$("#currentpwd").bind("blur",function(){
					regist.validCurrentpwd();
				});
				break;
			case "newpwd":
				$("#newpwd").bind("blur",function(){
					regist.validPwd();
				});
				break;
			case "newpwdrepeat":
				$("#newpwdrepeat").bind("blur",function(){
					regist.validRepeatpwd();
				});
				break;
			default:
				break;
		}
	});

	$("#button_update_pwd").bind("click",function(){

		var isValid = true;
		//一共十一个验证
		if(regist.validCurrentpwd() == false)isValid = false;
		if(regist.validPwd() == false)isValid = false;
		if(regist.validRepeatpwd() == false)isValid = false;
		if(isValid == true){
			regist.submit();
		}else{
			//nothing
		}
	});
	//-->
	</script>