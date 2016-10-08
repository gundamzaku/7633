	<div id="subhead" class="site dark"><h1><?=WATCHWORD?></h1></div>
	<div id="main" class="site">
		<?php $this->widget('application.widgets.InfoLeftWidget');?>

		<div class="col-right entry-content">
			<div class="wrapper single" id="profile">
				<h2>用户资料</h2>
				<form action="<?=Yii::app()->url->getDoUserProfileUrl()?>" method="POST" id="form-profile" class=""> 
					<fieldset>
						<label for="companyname">公司名称</label><input type="text" value="<?=$companyname?>" id="companyname" name="companyname" />
						<div class="msg error" style="display:none"></div>
					</fieldset>
					
					<fieldset>
						<label for="companyidnumber">企业营业执照号码</label><input type="text" value="<?=$companyidnumber?>" id="companyidnumber" name="companyidnumber" />
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="tel">联系电话</label><input type="text" value="<?=$tel?>" id="tel" name="tel"/>
						<div class="msg error" style="display:none"></div>
					</fieldset>

					<fieldset>
						<label for="address">联系地址</label><input type="text" value="<?=$address?>" id="address" name="address" />
						<div class="msg error" style="display:none"></div>
					</fieldset>

					<fieldset>
						<label for="email">Email</label><input type="text" value="<?=$email?>" id="email" name="email"/>
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="qq">QQ</label><input type="text" value="<?=$qq?>" id="qq" name="qq"/>
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset><hr/></fieldset>
					<fieldset>
						<label for="ownername">企业法人姓名</label><input type="text" value="<?=$ownername?>" id="ownername" name="ownername"/>
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<label for="owneridnumber">法人身份证号码</label><input type="text" value="<?=$owneridnumber?>" id="owneridnumber" name="owneridnumber"/>
						<div class="msg error" style="display:none"></div>
					</fieldset>
					<fieldset>
						<input type="button" id="button_update" value="保存修改"/>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<script src="js/regist.js" type="text/javascript"></script>
	<script type="text/javascript">
	<!--
	var regist = new Regist();
	regist.setForm($("#form-profile"));
	$("#form-profile").find("input").each(function(){
		switch($(this).attr("id")){
			case "companyname":
				$("#companyname").bind("blur",function(){
					regist.validCompanyname()
				});
				break;
			case "companyidnumber":
				$("#companyidnumber").bind("blur",function(){
					regist.validCompanyidnumber()
				});
				break;
			case "tel":
				$("#tel").bind("blur",function(){
					regist.validTel()
				});
				break;
			case "address":
				$("#address").bind("blur",function(){
					regist.validAddress()
				});
				break;
			case "email":
				$("#email").bind("blur",function(){
					regist.validEmail()
				});
				break;
			case "qq":
				$("#qq").bind("blur",function(){
					regist.validQq()
				});
				break;
			case "ownername":
				$("#ownername").bind("blur",function(){
					regist.validOwnername()
				});
				break;
			case "owneridnumber":
				$("#owneridnumber").bind("blur",function(){
					regist.validOwneridnumber();
				});
				break;
			default:
				break;
		}
	});
	
	$("#button_update").bind("click",function(){

		var isValid = true;

		if(regist.validCompanyname() == false)isValid = false;
		if(regist.validCompanyidnumber() == false)isValid = false;
		if(regist.validTel() == false)isValid = false;
		if(regist.validAddress() == false)isValid = false;
		if(regist.validEmail() == false)isValid = false;
		if(regist.validQq() == false)isValid = false;
		if(regist.validOwnername() == false)isValid = false;
		if(regist.validOwneridnumber() == false)isValid = false;
		if(isValid == true){// && regist.getUsernameUnique() == true
			regist.submit();
		}else{}
	});
	//-->
	</script>