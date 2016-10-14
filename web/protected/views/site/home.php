	<!--首页顶部start-->
	<div id="header-home" class="site dark">
		<div id="header-home-logo"></div>
		<div id="header-home-section">
			<div id="header-home-left">
				<p>已接入 <span><?=$settingInfo["shops_num"]?></span> 家线下店</p>
				<p>已接入 <span><?=$settingInfo["games_num"]?></span> 款游戏</p>
				<div><a href="<?=Yii::app()->url->getRegisterUrl()?>" id="bt-register">注册平台账号</a> <a href="<?=Yii::app()->url->getLoginUrl()?>">登录</a></div>
			</div>
			<?php ($settingInfo["download_url"] == "###")?$target="":$target="target='_blank'";?>
			<a id="header-home-client" href="<?=$settingInfo["download_url"]?>" <?=$target?>>获取战网客户端</a>
		</div>
	</div>
	<!--首页顶部end-->

	<!--游戏模块start-->
	<div id="body-home" class="site dark">
		<?php foreach($adviertisementInfo as $k=>$v){?>
		<?php if(empty($v["url"]) || $v["url"] = "###"){
			$v["url"] = "###";
			$target = '';
		?>
		<?php }else{$target = 'target="_blank"';}?>
		<a href="<?=$v["url"]?>" class="game" title="<?=$v["title"]?>" <?=$target?>><img src="<?=$v["icon"]?>" alt="<?=$v["title"]?>"></a>
		<?php }?>
	</div>
	<!--游戏模块end-->

	<!--店铺模块滚动start-->
	<div id="slide-home" class=" ">
		<div class="site">
			<div class="swiper-container" id="home-stores">
			    <div class="swiper-wrapper">
					<ul class="swiper-slide">
						<?php for($i=0;$i<5;$i++){?>
						<?php if(!empty($storeInfo[$i])){?>
						<li><a href="<?=Yii::app()->url->getStoreDetailsUrl("sid=".$storeInfo[$i]["sid"])?>"><img src="<?=$storeInfo[$i]["icon"]?>" alt="<?=$storeInfo[$i]["title"]?>" /></a>
							<p><?=$storeInfo[$i]["title"]?></p>
						</li>
						<?php }}?>
					</ul>
					<?php if(count($storeInfo)>5){?>
			        <ul class="swiper-slide">
						<?php for($i=5;$i<10;$i++){?>
						<?php if(!empty($storeInfo[$i])){?>
						<li><a href="<?=Yii::app()->url->getStoreDetailsUrl("sid=".$storeInfo[$i]["sid"])?>"><img src="<?=$storeInfo[$i]["icon"]?>" alt="<?=$storeInfo[$i]["title"]?>" /></a>
							<p><?=$storeInfo[$i]["title"]?></p>
						</li>
						<?php }}?>
					</ul>
					<?php }?>
			    </div>				
			</div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	</div>
	<script>
	$(document).ready(function () {
		var mySwiperPartners = new Swiper ('#home-stores', {
			direction: 'horizontal',
			loop: true,
			// 如果需要前进后退按钮
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			autoplay : 3500
			//spaceBetween: 80
		});
	})

	</script>
	<!--店铺模块滚动end-->