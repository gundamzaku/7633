		<!--左边栏start-->
		<div class="col-left dark">
			<div class="wrapper">
				<h2>通行证基本信息</h2>
				<p><span>通行证名(邮箱):</span>
				<?=$username?></p>
				<hr/>
				<p><span>企业名:</span>
				<?=$companyname?><br/>
				<a href="<?=Yii::app()->url->getUserProfileUrl()?>" class="more">修改资料</a></p>
				<hr/>
				<p><span>上次登录时间:</span>
				<?=$last_login?></p>
				<hr/>
				<p><span>上次登录IP地址:</span>
				<?=$last_login_ip?></p>

			</div>
			<div class="wrapper">
				<h2>费用信息</h2>
				<p><span>您剩余的点数:</span>
				<?=$money?></p>
			</div>
		</div>
		<!--左边栏end-->