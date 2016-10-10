function is_weixn(){
	var ua = navigator.userAgent.toLowerCase();
	if(ua.match(/MicroMessenger/i)=="micromessenger") {
		return true;
	} else {
		return false;
	}
}  
//alert(is_weixn());
$(function(){
	var winW = $(window).width(),
		winH = $(window).height();
	$("#page").height(winH);
	$("#page").width(winW);
	$("body").height(winH);
	$("#page-all").height(winH);

	// $("#p5").height(winH);
	
	flag = true;
	function bgMusic(){
		$(".play").fadeIn(2000);
		var audio = $("#bg-music");
			
		$(".play").on("click",function(){
			if(flag){
				audio.get(0).play();
				$(this).removeClass("pause").addClass("play");
			}else{
				audio.get(0).pause();
				$(this).removeClass("play").addClass("pause");
			}
			flag = !flag;
		})
		setTimeout(function(){
			$(".play").trigger("click");
		},1000);
	};
	//点击和轻触
	function tapClick() {
		return "ontouchstart" in document ? "tap" : "click";
	};

	var animateend="webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
	var cdn="";
	var loadwidth = $("#loading .val");
	var iLength = 0;
	var aUrl = [
		cdn+"images/bg.jpg",
		cdn+"images/share.jpg",
		//cdn+"images/music-on.png",
		//cdn+"images/music-off.png",
		cdn+"images/logo.png",
		cdn+"images/counting-bg.png"


		];
	for(var i=0;i<aUrl.length;i++) {
		var oImg = new Image();
		oImg.onload = function(){
			iLength++;
			loadwidth.text( parseInt(iLength/aUrl.length*100)+"%" );
			if(iLength == aUrl.length){
				setTimeout(function(){
					$("#loading .val").animate({fontSize:"0"},100);
					$("#loading .val").animate({
						opacity:"0"}, 500, function(){
						$("#loading").fadeOut(10);
						p1step1();
					});
					
				},1000);
				//bgMusic();
			}
		};
		oImg.onerror = function(){
			iLength++;
			loadwidth.text( parseInt(iLength/aUrl.length*100)+"%" );
		};
		oImg.src=aUrl[i];
	}

	function p1step1(){
		$("#page-all").fadeIn(1000);
		$("#logo-top").addClass("stay");
		$("#txt1").addClass("stay");
		$("#txt2").addClass("stay");
		$("#txt3").addClass("stay");
		$("#counting").addClass("stay");
		$("#counting_time").addClass("stay");
		window.setInterval(function(){
			ShowCountDown("vr" , vr_countDown_year, vr_countDown_month, vr_countDown_day, vr_countDown_hour, vr_countDown_min);
		}, 1000);
		
		$("#getbutton_bt").one("click",function(){
			$(this).css("display","none");
			$("#getbutton_number").css("display","block");

		});
	}//p1step1


});


function ShowCountDown(prefix,year,month,day,hourd,minuted,seconded){
	var now = new Date();
	if( typeof(hourd) == "undefined" ) hourd=23;
	if( typeof(minuted) == "undefined" ) minuted=59;
	if( typeof(seconded) == "undefined" ) seconded=59;
	var endDate = new Date(year, month-1, day, hourd, minuted,seconded);
	var leftTime=endDate.getTime()-now.getTime();
	var leftsecond = parseInt(leftTime/1000);
	var day=Math.floor(leftsecond/(60*60*24));
	day = day < 0 ? 0 : day;
	var hour=Math.floor((leftsecond-day*24*60*60)/3600);
	hour = hour < 0 ? 0 : hour;
	var minute=Math.floor((leftsecond-day*24*60*60-hour*3600)/60);
	minute = minute < 0 ? 0 : minute;
	var second=Math.floor(leftsecond-day*24*60*60-hour*3600-minute*60);
	second = second < 0 ? 0 : second;
	//var day2 = (day<10?"0"+day:day);
	var hour2 = (hour<10?"0"+hour:hour);
	var minute2 = (minute<10?"0"+minute:minute);
	var second2 = (second<10?"0"+second:second);
 
	jQuery("#"+prefix+"_countDown_day").html(day);
	jQuery("#"+prefix+"_countDown_hour").html(hour2);
	jQuery("#"+prefix+"_countDown_min").html(minute2);
	jQuery("#"+prefix+"_countDown_sec").html(second2);
 
 	if(day==0&&hour==0&&minute==0&second==0){
 		$("#counting").css("display","none");
 		$("#getbutton").addClass("animated bounceIn");
 	}
}
