var usernameUnique;

function Regist(){
	this.container = null;
	this.form_register2 = $("#form-register2");	//提交窗体
	this.button_register = $("#button_register");	//提交按钮
	this.sub_process = $("#sub_process");	//进程显示

    this.username = $("#username");	//用户名
    this.pwd = $("#pwd");	//密码
    this.repeatpwd = $("#repeatpwd");	//重复密码
	this.companyname = $("#companyname");	//公司名称
	this.companyidnumber = $("#companyidnumber");	//企业营业执照号码
	this.tel = $("#tel");	//联系电话
	this.address = $("#address");	//联系地址
	this.email = $("#email");	//Email
	this.qq = $("#qq");	//QQ
	this.ownername = $("#ownername");	//企业法人姓名
	this.owneridnumber = $("#owneridnumber");	//法人身份证号码
	
	//特别使用
	this.currentpwd = "";	//修改密码的时候使用

	usernameUnique = false;//初始化，表示用户名目前无法确认是否已经被使用
}

//重新设置表单
Regist.prototype.setForm = function(container){
	this.form_register2 = container;	//用户名
};

//验证用户名
Regist.prototype.setUsername = function(container){
	this.username = container;	//用户名
};

//重新安置密码控件
Regist.prototype.setPwd = function(container){
	this.pwd = container;	//用户名
};

//重新安置密码重复控件
Regist.prototype.setRepeatpwd = function(container){
	this.repeatpwd = container;	//用户名
};

//重新安置密码时输入的当前密码
Regist.prototype.setCurrentpwd = function(container){
	this.currentpwd = container;	//用户名
};

//验证用户名
Regist.prototype.validUsername = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.username);
	if(this.username.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	if(!this.username.val().match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)){
		this.showMsg(this.container,"邮箱格式不正确！请重新输入");
		return false;
	}

	this.container.hide();
	return true;
};

Regist.prototype.validUsernameExist = function(url,isSubmit){
	
	var load_user = $("#username");
	//移除样式
	load_user.removeClass("success loading error");
	//加载中
	load_user.addClass("loading");
	var reg = this;

	$.post(url, { "username": this.username.val() },function(req) {
		load_user.removeClass("success loading error");
		//成功时的回调方法
		var result = $.parseJSON(req);
		console.log(result);
		if(result["result"] == "succ"){
			//通过验证，表示用户名是惟一的。
			
			usernameUnique = true;
			load_user.addClass("success");
			console.log(isSubmit);
			if(isSubmit == true){
				//提交
				reg.submit();
			}
		}else{
			load_user.addClass("error");
			if(isSubmit == true){
				reg.submitProcessFail();
			}
		}
		
	});
};

//查找是否存在某样式
Regist.prototype.hasClass = function(className){
	return this.username.hasClass(className);
};

//按钮的提交事件
Regist.prototype.submit = function(){
	this.form_register2.submit();
};

//按钮的提交事件
Regist.prototype.submitProcess = function(){
	this.button_register.hide();
	this.sub_process.show();
};

//按钮的提交事件(失败了还原)
Regist.prototype.submitProcessFail = function(){
	this.sub_process.hide();
	this.button_register.show();
};

Regist.prototype.getUsernameUnique = function(){
	return usernameUnique;
};

//验证密码的正则表达
Regist.prototype.validpwdStandard = function(pwdVal){
	return pwdVal.match(/^([a-zA-Z0-9]|[\.\_\-\!\#]){5,24}$/);
};

//验证密码
Regist.prototype.validCurrentpwd = function(){
	//得到信息提示的容器
	
	this.container = this.getContainer(this.currentpwd);
	if(this.currentpwd.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	if(!this.validpwdStandard(this.currentpwd.val())){
		//if(!this.currentpwd.val().match(/^([a-zA-Z0-9]|[\.\_\-\!\#]){5,24}$/)){
		this.showMsg(this.container,"密码长度为5-24位且必须为英文数字");
		return false;
	}
	
	this.container.hide();
	return true;
};

//验证密码
Regist.prototype.validPwd = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.pwd);
	if(this.pwd.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	if(!this.validpwdStandard(this.pwd.val())){
		//if(!this.pwd.val().match(/^([a-zA-Z0-9]|[\.\_\-\!\#]){5,24}$/)){
		this.showMsg(this.container,"密码长度为5-24位且必须为英文数字");
		return false;
	}
	
	if(this.repeatpwd.val()!=""){
		if(this.pwd.val() != this.repeatpwd.val()){
			this.showMsg(this.container,"两次密码确认不一致");
			return false;
		}
	}

	this.container.hide();
	return true;
};

//验证密码确认
Regist.prototype.validRepeatpwd = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.repeatpwd);
	if(this.repeatpwd.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	
	if(this.pwd.val() != this.repeatpwd.val()){
		this.showMsg(this.container,"两次密码确认不一致");
		return false;
	}

	this.container.hide();
	return true;
};

//验证公司名称
Regist.prototype.validCompanyname = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.companyname);
	if(this.companyname.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	
	this.container.hide();
	return true;
};

//验证企业营业执照号码
Regist.prototype.validCompanyidnumber = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.companyidnumber);
	if(this.companyidnumber.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	
	this.container.hide();
	return true;
};

//验证联系电话
Regist.prototype.validTel = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.tel);
	if(this.tel.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	
	this.container.hide();
	return true;
};

//验证联系地址
Regist.prototype.validAddress = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.address);
	if(this.address.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	
	this.container.hide();
	return true;
};

//验证Email
Regist.prototype.validEmail = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.email);
	if(this.email.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	
	this.container.hide();
	return true;
};

//验证QQ
Regist.prototype.validQq = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.qq);
	if(this.qq.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	
	this.container.hide();
	return true;
};

//验证企业法人姓名
Regist.prototype.validOwnername = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.ownername);
	if(this.ownername.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	
	this.container.hide();
	return true;
};

//验证法人身份证号码
Regist.prototype.validOwneridnumber = function(){
	//得到信息提示的容器
	this.container = this.getContainer(this.owneridnumber);
	if(this.owneridnumber.val() == ""){
		this.showMsg(this.container,"不能为空");
		return false;
	}
	
	this.container.hide();
	return true;
};

Regist.prototype.getContainer = function(container){
	container = container.parent().find(".msg");
	return container;
}

Regist.prototype.showMsg = function(container,msg){
	container.show();
	container.html(msg);
}