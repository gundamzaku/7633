	<div id="subhead" class="site dark"><h1><?=WATCHWORD?></h1></div>


	<div id="main" class="site">
		<?php $this->widget('application.widgets.InfoLeftWidget');?>

		<div class="col-right entry-content">
			<div class="wrapper single" id="messages">
				<h2>订单记录</h2>
				
				<table class="orders">
					<thead>
						<tr><th>订单编号</th><th>订单时间</th><th>订单金额(元)</th><th>订单状态</th></tr>
					</thead>
					<tbody><!--每页50条-->
						<tr><td>12314567890123</td><td>2016-09-20 23:36</td><td>8888</td><td>已支付</td></tr>
						<tr><td>12314567890123</td><td>2016-09-20 23:36</td><td>8888</td><td>已支付</td></tr>
						<tr><td>12314567890123</td><td>2016-09-20 23:36</td><td>8888</td><td>已支付</td></tr>
						<tr><td>12314567890123</td><td>2016-09-20 23:36</td><td>8888</td><td>已支付</td></tr>
						<tr><td>12314567890123</td><td>2016-09-20 23:36</td><td>8888</td><td>已支付</td></tr>
						<tr><td>12314567890123</td><td>2016-09-20 23:36</td><td>8888</td><td>已支付</td></tr>
						<tr><td>12314567890123</td><td>2016-09-20 23:36</td><td>8888</td><td>已支付</td></tr>
					</tbody>
				</table>
				<?=$page?>
				<!--
				<ul class="pagenation">
					<li><a href="###">上一页</a></li>
					<li><a href="###">1</a></li>
					<li><a href="###">2</a></li>
					<li><a href="###">3</a></li>
					<li><a href="###">下一页</a></li>
					<li>50条/页</li>
				</ul>
				-->
			</div>
		</div>
	</div>