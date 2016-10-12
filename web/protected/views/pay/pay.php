	<div id="subhead" class="site dark"><h1><?=WATCHWORD?></h1></div>

	<div id="main" class="site">
		<?php $this->widget('application.widgets.InfoLeftWidget');?>

		<div class="col-right entry-content">
			<div class="wrapper single" id="pay">
				<h2>充值付费</h2>
				<form action="" id=" " class=""> 
					
					<fieldset>
						选择您希望充值的金额:
						<ol id="payamount-select">
							<li class="ui-widget-content">10元</li>
							<li class="ui-widget-content">20元</li>
							<li class="ui-widget-content">30元</li>
							<li class="ui-widget-content">50元</li>
							<li class="ui-widget-content">100元</li>
							<li class="ui-widget-content">200元</li>
							<li class="ui-widget-content">300元</li>
							<li class="ui-widget-content">500元</li>
							<li class="ui-widget-content">1000元</li>
						</ol>
					</fieldset>
					<fieldset>
						<!--payamount 充值金额-->
						其他金额: <br/><input type="number" value="" id="payamount" class="short" /> 元
					</fieldset>
					<fieldset>
						充值 <span id="paycurrency">0</span> 币（1元人民币 = 10币）
					</fieldset>
					<fieldset>
						<hr/>
					</fieldset>
					<fieldset>
						选择您希望的支付方式:
						<ol id="gataway-select">
							<li class="ui-widget-content">支付宝</li>
							<li class="ui-widget-content">微信支付</li>
							<li class="ui-widget-content">银联支付</li>
						</ol>

						<!--paygataway 支付方式-->
						<input type="hidden" id="paygataway" value="支付宝" />
					</fieldset>
					<fieldset>当您点击“继续前往在线支付”键，您将被导向一个外部网站以完成付款。</fieldset>
					<fieldset><button>继续前往在线支付</button></fieldset>
				</form>
			</div>
		</div>
	</div>
<script>
$(function() {
	$("#payamount-select").selectable({
		stop: function() {
			var payamount= parseInt( $("#payamount-select .ui-selected").html() );
			if(!payamount) payamount=0;
	  		$("#payamount").val( payamount );
	  		$("#paycurrency").html( payamount *10 );
		}
	});

	$("#gataway-select").selectable({
		stop: function() {
			var paygataway=  $("#gataway-select .ui-selected").html() ;
			if(!paygataway) paygataway="支付宝";
	  		$("#paygataway").val( paygataway );
		}
	});
});
</script>