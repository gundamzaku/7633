<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<title>7663VR游戏平台 邀请码发放</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="browsermode" content="application">
    <meta name="x5-page-mode" content="app">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="format-detection" content="telephone=no, email=no">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="h5/css/animate.css">
	<link rel="stylesheet" href="h5/css/style.css?v=1" >

</head>
<body>
<script>
	function hengshuping()
	{
	  if(window.orientation==180||window.orientation==0)
	  {
         return true;
	  };
	  if(window.orientation==90||window.orientation==-90)
	  {
         return false;
	  };//手机横屏
	}
	var win_w = parseInt(document.body.clientWidth),
        win_h = parseInt(document.body.clientHeight),
        html = document.getElementsByTagName('html')[0],
        //获取初始的fontsize,16为比例标准
        originalSize = parseInt((window.getComputedStyle(document.documentElement,null)).fontSize);
		fontSize();

	function fontSize()
	{
        if(hengshuping()){
	        zoom=(win_w / 640) / (originalSize/16) * 100;
	        html.style.fontSize = zoom + 'px';
        }else{
			zoom=(win_w / 640) / (originalSize/16) * 100;
	        html.style.fontSize = zoom + 'px';
        }
	}

	window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", fontSize, false); 
</script>
<div id="page">
	<div id="loading">
		<div class="val">0%</div>
	</div>
	<!-- <div class="media">
		<audio id="bg-music" src="media/bg.mp3" preload="auto" loop></audio>
		<p class="play"></p>
	</div> -->
	<div id="logo-top"></div>

	<div class="" id="page-all">
		<div id="txt1">邀请码火热发放中</div>
		<div id="txt2">邀请码数量：888 个</div>
		<div id="txt3">抢号时间：2016年10月15日12:00</div>
		<div id="counting">
			<div id="counting_title">抢号倒计时</div>
			<div id="counting_time">
				<span id="vr_countDown_day">365</span>天
				<span id="vr_countDown_hour">24</span>小时
				<span id="vr_countDown_min">59</span>分
				<span id="vr_countDown_sec">59</span>秒
			</div>
		</div>

		<div id="getbutton">
			<a href="###" id="getbutton_bt">点我抢号</a>
			<div  id="getbutton_number">
				您的邀请码:
				<span>xxxxx-xxxxx</span>
			</div>
		</div>

	</div>

</div>

<script>//发号时间设置,hour为24小时制
var vr_countDown_year=2016;
var vr_countDown_month=10;
var vr_countDown_day=15;
var vr_countDown_hour=16;
var vr_countDown_min=0;
</script>
<!--#page-->
<script src="h5/js/jquery-1.11.2.min.js"></script>
<script src="h5/js/global.js?v=1"></script>


<script type="text/javascript">
	var shareMsg = {
		appid:'wx02c7a13f9b9180e4',
		title: "7663VR游戏平台 邀请码发放",
		desc:"...",
		image:'http://h5.thinkmore.net.cn/share/7663-register-share.jpg',
		link:window.location.href
	}
	var jsSignService = 'http://h5.thinkmore.net.cn/tmall-box/getSign.php';
	function weixin(appid,callback){
		var _self = this;
		this.appid = appid;
		this.callback = callback;
		jQuery.each(wx,function(k,v){
			weixin.prototype[k] = v;
		})
		for(var k in wx)
		{
			weixin[k] = wx[k];
		}
		if(this.callback){
			this.ready(this.callback);
		}

		jQuery.getJSON(jsSignService,{'appid':this.appid,'url':location.href.split('#')[0]},function(response){
			_self.config({
				debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
				appId: response.appId, // 必填，公众号的唯一标识
				timestamp: response.timestamp, // 必填，生成签名的时间戳
				nonceStr: response.nonceStr, // 必填，生成签名的随机串
				signature: response.signature,// 必填，签名，见附录1
				jsApiList: [
					'checkJsApi',
					'onMenuShareTimeline',
					'onMenuShareAppMessage',
					'onMenuShareQQ',
					'onMenuShareWeibo'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
			});
		});
	}
	$(function(){
		var wx = new weixin(shareMsg.appid,function(){
			wx.error(function(res){
				// config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。

			});
			//朋友圈
			wx.onMenuShareTimeline({
				title: shareMsg.desc, // 分享标题
				desc: shareMsg.desc,
				link: shareMsg.link, // 分享链接
				imgUrl: shareMsg.image, // 分享图标
				success: function () {
					// 用户确认分享后执行的回调函数
				},
				cancel: function () {

				}
			});
			//朋友
			wx.onMenuShareAppMessage({
				title: shareMsg.title, // 分享标题
				desc: shareMsg.desc,
				link: shareMsg.link, // 分享链接
				imgUrl: shareMsg.image, // 分享图标
				type: 'link', // 分享类型,music、video或link，不填默认为link
				dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
				success: function () {
					// 用户确认分享后执行的回调函数
				},
				cancel: function () {
					// 用户取消分享后执行的回调函数
				}
			});
		});
	})
</script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</body>
</html>