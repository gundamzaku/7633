	<!--首页顶部start-->
	<div id="header-home" class="site dark">
		<div id="header-home-logo"></div>
		<div id="header-home-section">
			<div id="header-home-left">
				<p>已接入 <span>888</span> 家线下店</p>
				<p>已接入 <span>88</span> 款游戏</p>
				<div><a href="<?=Yii::app()->url->getRegisterUrl()?>" id="bt-register">注册平台账号</a> <a href="<?=Yii::app()->url->getLoginUrl()?>">登录</a></div>
			</div>
			<a id="header-home-client" href="###" target="_blank">获取战网客户端</a>
		</div>
	</div>
	<!--首页顶部end-->

	<!--游戏模块start-->
	<div id="body-home" class="site dark">
		<a href="###" class="game" title="游戏名称"><img src="images/game1.jpg" alt="游戏名称"></a>
		<a href="###" class="game" title="游戏名称"><img src="images/game1.jpg" alt="游戏名称"></a>
		<a href="###" class="game" title="游戏名称"><img src="images/game1.jpg" alt="游戏名称"></a>
		<a href="###" class="game" title="游戏名称"><img src="images/game1.jpg" alt="游戏名称"></a>
		<a href="###" class="game" title="游戏名称"><img src="images/game1.jpg" alt="游戏名称"></a>
	</div>
	<!--游戏模块end-->

	<!--店铺模块滚动start-->
	<div id="slide-home" class=" ">
		<div class="site">
			<div class="swiper-container" id="home-stores">
			    <div class="swiper-wrapper">
					<ul class="swiper-slide">
						<li><img src="images/store1.jpg" alt="店铺名称" />
							<p>店铺名称1已加入平台</p>
						</li>
						<li><img src="images/store1.jpg" alt="店铺名称" />
							<p>店铺名称2已加入平台</p>
						</li>
						<li><img src="images/store1.jpg" alt="店铺名称" />
							<p>店铺名称3已加入平台</p>
						</li>
						<li><img src="images/store1.jpg" alt="店铺名称" />
							<p>店铺名称4已加入平台</p>
						</li>
						<li><img src="images/store1.jpg" alt="店铺名称" />
							<p>店铺名称5已加入平台</p>
						</li>

					</ul>
			        <ul class="swiper-slide">
						<li><img src="images/store1.jpg" alt="店铺名称" />
							<p>店铺名称6已加入平台</p>
						</li>
						<li><img src="images/store1.jpg" alt="店铺名称" />
							<p>店铺名称7已加入平台</p>
						</li>
						<li><img src="images/store1.jpg" alt="店铺名称" />
							<p>店铺名称8已加入平台</p>
						</li>
						<li><img src="images/store1.jpg" alt="店铺名称" />
							<p>店铺名称9已加入平台</p>
						</li>
						<li><img src="images/store1.jpg" alt="店铺名称" />
							<p>店铺名称10已加入平台</p>
						</li>
					</ul>
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
			//spaceBetween: 80
		});
	})

	</script>
	<!--店铺模块滚动end-->