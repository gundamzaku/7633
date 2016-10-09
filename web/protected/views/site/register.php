	<div id="header-home-logo" class="singleformlogo"></div>
	<div class="singleform dark">
		<form id="form-register1" class="">
			<fieldset>
				<label for="username">请输入邀请码</label><input type="text" value="" id="invite_code" />
				<div class="msg error" id="msg_invite_code" style="display:none"></div>
			</fieldset>
			
			<fieldset>
				<input type="button" value="验证邀请码" id="vaildate_invite_code"/>
			</fieldset>

		</form>

		<form action="<?=Yii::app()->url->getDoRegisterUrl()?>" id="form-register2" method="POST" class="" style="display:none"> 
				<h1>恭喜，您已输入有效的邀请码。现在请如实填写以下表单完成注册。</h1>
				<fieldset><input type="hidden" name="invite_code" id="invite_code_copy" readonly/>
					<label for="username">用户名(邮箱)</label><input type="text" value="" id="username" name="username"/>
					<div class="msg error" style="display:none"></div>
				</fieldset>
				<fieldset>
					<label for="pwd">密码</label><input type="password" value="" id="pwd" name="pwd" />
					<div class="msg error" style="display:none"></div>
				</fieldset>
				<fieldset>
					<label for="repeatpwd">重复密码</label><input type="password" value="" id="repeatpwd" name="repeatpwd" />
					<div class="msg error" style="display:none"></div>
				</fieldset>
				<fieldset><hr/></fieldset>
				<fieldset>
					<label for="companyname">公司名称</label><input type="text" value="" id="companyname" name="companyname"/>
					<div class="msg error" style="display:none"></div>
				</fieldset>

				<fieldset>
					<label for="companyidnumber">企业营业执照号码</label><input type="text" value="" id="companyidnumber" name="companyidnumber"/>
					<div class="msg error" style="display:none"></div>
				</fieldset>

				<fieldset>
					<label for="tel">联系电话</label><input type="text" value="" id="tel" name="tel"/>
					<div class="msg error" style="display:none"></div>
				</fieldset>

				<fieldset>
					<label for="address">联系地址</label><input type="text" value="" id="address" name="address"/>
					<div class="msg error" style="display:none"></div>
				</fieldset>

				<fieldset>
					<label for="qq">QQ</label><input type="text" value="" id="qq" name="qq"/>
					<div class="msg error" style="display:none"></div>
				</fieldset>
				<fieldset><hr/></fieldset>
				<fieldset>
					<label for="ownername">企业法人姓名</label><input type="text" value="" id="ownername" name="ownername"/>
					<div class="msg error" style="display:none"></div>
				</fieldset>

				<fieldset>
					<label for="owneridnumber">法人身份证号码</label><input type="text" value="" id="owneridnumber" name="owneridnumber"/>
					<div class="msg error" style="display:none"></div>
				</fieldset>
				<fieldset>
					<input type="button" value="注册" id="button_register"/>
					<span  id="sub_process" style="display:none">开始提交..</span>
				</fieldset>
			</form>
	</div>
	<script src="js/regist.js" type="text/javascript"></script>
	<script src="js/jquery.cookie.js" type="text/javascript"></script>
	<script type="text/javascript">
	<!--
	//自动保存邀请码
	if(typeof($.cookie('invite_code'))!="undefined"){
		$("#invite_code").val($.cookie('invite_code'));	
	}
	$("#vaildate_invite_code").bind("click",function(){
		//获得邀请码的内容
		var invite_code = $("#invite_code").val();
		//判断邀请码是否为空
		if(invite_code == ""){
			$("#msg_invite_code").html("邀请码不能为空。");
			$("#msg_invite_code").show();
		}else{
			//Ajax提交邀请码进行数据验证
			$.get("<?=Yii::app()->url->getInviteCodeUrl()?>", { "inviteCode": invite_code },function(req) {
				//成功时的回调方法
				var result = $.parseJSON(req);
				if(result["result"] == "succ"){
					//通过验证
					$("#invite_code_copy").val($("#invite_code").val());
					$.cookie('invite_code', invite_code,{expires:1});
					$("#form-register1").hide();
					$("#form-register2").show();
				}else{
					$("#msg_invite_code").html(result["message"]);
					$("#msg_invite_code").show();
				}
			});
		}
	});	
	$("#invite_code").bind("blur",function(){
		$("#msg_invite_code").hide();
		$("#msg_invite_code").html("");
	});	

	var regist = new Regist();
	$("#form-register2").find("input").each(function(){
		switch($(this).attr("id")){
			case "username":
				if(typeof($.cookie('username'))!="undefined"){
					$("#username").val($.cookie('username'));	
				}
				$("#username").bind("blur",function(){
					//是合法的用户名
					if(regist.validUsername()==true){
						regist.validUsernameExist("<?=Yii::app()->url->getUsernameExistUrl()?>",false);
						$.cookie('username', $(this).val(),{expires:1}); 
					}
				});
				break;
			case "pwd":
				$("#pwd").bind("blur",function(){
					regist.validPwd();
				});
				break;
			case "repeatpwd":
				$("#repeatpwd").bind("blur",function(){
					regist.validRepeatpwd();
				});
				break;
			case "companyname":
				if(typeof($.cookie('companyname'))!="undefined"){
					$("#companyname").val($.cookie('companyname'));	
				}
				$("#companyname").bind("blur",function(){
					if(regist.validCompanyname()==true){
						$.cookie('companyname', $(this).val(),{expires:1}); 
					}
				});
				break;
			case "companyidnumber":
				if(typeof($.cookie('companyidnumber'))!="undefined"){
					$("#companyidnumber").val($.cookie('companyidnumber'));	
				}
				$("#companyidnumber").bind("blur",function(){
					if(regist.validCompanyidnumber()==true){
						$.cookie('companyidnumber', $(this).val(),{expires:1}); 
					}
				});
				break;
			case "tel":
				if(typeof($.cookie('tel'))!="undefined"){
					$("#tel").val($.cookie('tel'));	
				}
				$("#tel").bind("blur",function(){
					if(regist.validTel()==true){
						$.cookie('tel', $(this).val(),{expires:1}); 
					}
				});
				break;
			case "address":
				if(typeof($.cookie('address'))!="undefined"){
					$("#address").val($.cookie('address'));	
				}
				$("#address").bind("blur",function(){
					if(regist.validAddress()==true){
						$.cookie('address', $(this).val(),{expires:1}); 
					}
				});
				break;
			case "qq":
				if(typeof($.cookie('qq'))!="undefined"){
					$("#qq").val($.cookie('qq'));	
				}
				$("#qq").bind("blur",function(){
					if(regist.validQq()==true){
						$.cookie('qq', $(this).val(),{expires:1}); 
					}
				});
				break;
			case "ownername":
				if(typeof($.cookie('ownername'))!="undefined"){
					$("#ownername").val($.cookie('ownername'));	
				}
				$("#ownername").bind("blur",function(){
					if(regist.validOwnername()==true){
						$.cookie('ownername', $(this).val(),{expires:1}); 
					}
				});
				break;
			case "owneridnumber":
				if(typeof($.cookie('owneridnumber'))!="undefined"){
					$("#owneridnumber").val($.cookie('owneridnumber'));	
				}
				$("#owneridnumber").bind("blur",function(){
					if(regist.validOwneridnumber()==true){
						$.cookie('owneridnumber', $(this).val(),{expires:1}); 
					}
				});
				break;
			default:
				break;
		}
	});
	
	$("#button_register").bind("click",function(){
		regist.submitProcess();	//开始提交，将按钮隐去
		var isValid = true;
		//一共十一个验证
		if(regist.validUsername() == false)isValid = false;
		if(regist.validPwd() == false)isValid = false;
		if(regist.validRepeatpwd() == false)isValid = false;
		if(regist.validCompanyname() == false)isValid = false;
		if(regist.validCompanyidnumber() == false)isValid = false;
		if(regist.validTel() == false)isValid = false;
		if(regist.validAddress() == false)isValid = false;
		if(regist.validQq() == false)isValid = false;
		if(regist.validOwnername() == false)isValid = false;
		if(regist.validOwneridnumber() == false)isValid = false;
		if(isValid == true){// && regist.getUsernameUnique() == true
			//判断有没有做过用户验证
			if(regist.hasClass("success") == true){
				//直接提交
				regist.submit();
			}else{
				//验证后提交
				regist.validUsernameExist("<?=Yii::app()->url->getUsernameExistUrl()?>",true);
			}
		}else{
			regist.submitProcessFail();//提交失败，还原
		}
	});
	
	$(function(){	
	});
	//-->
	</script>
