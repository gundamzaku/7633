	<div id="subhead" class="site dark"><h1><?=WATCHWORD?></h1></div>

	<div id="main" class="site">
		


		<div class="entry-content col-full">
			<div class="wrapper single" id="message-details">
				<h2>最新消息</h2>
				
				<h1 class=""><?=$title?></h1>
				<time><?=$add_time?></time>
				<div>
					<p><?=$content?></p>
				</div>
				<ul class="pagenation">
					<li><a href="<?=Yii::app()->url->getIndexUrl()?>">返回</a></li>
				</ul>
			</div>
		</div>
	</div>