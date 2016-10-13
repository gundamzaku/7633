	<div id="subhead" class="site dark"><h1><?=WATCHWORD?></h1></div>

	<div id="main" class="site light">
		<!--左边栏start-->
		<div class="col-left light">
			<div class="wrapper">
				<h2>选择付费方式</h2>
				<ul class="tabs" id="payments">
					<li id="payments1" class="ui-selected"><a href="###" id="item1" class="">支付宝支付</a></li>
					<li id="payments2"><a href="###" id="item2" class="">微信支付</a></li>
					<li id="payments3"><a href="###" id="item3" class="">银行卡支付</a></li>
				</ul>

			</div>
		</div>
		<!--左边栏end-->


		<div class="col-right entry-content">
			<div class="wrapper single" id="pay">
				<h2>充值付费</h2>
				<form action="" id=" " class=""> 
					<fieldset>
						<p>支付方式: <span id="payname">支付宝支付</span></p>
						<hr/>
					</fieldset>
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
						其他金额: <br/><input type="number" value="0" id="payamount" class="short" min="0" /> 元
					</fieldset>
					<fieldset>
						充值 <span id="paycurrency">0</span> 币（1元人民币 = 10币）
					</fieldset>
					<fieldset>
						<hr/>
					</fieldset>
					<fieldset id="bank-select-container" style="display: none;">
						选择银行:
						<ol id="bank-select">
							<li class="ui-widget-content" id="bank1"><span>工商银行</span></li>
							<li class="ui-widget-content" id="bank2"><span>建设银行</span></li>
							<li class="ui-widget-content" id="bank3"><span>农业银行</span></li>
							<li class="ui-widget-content" id="bank4"><span>招商银行</span></li>
							<li class="ui-widget-content" id="bank5"><span>中国银行</span></li>
							<li class="ui-widget-content" id="bank6"><span>交通银行</span></li>
							<li class="ui-widget-content" id="bank7"><span>浦发银行</span></li>
							<li class="ui-widget-content" id="bank8"><span>光大银行</span></li>
							<li class="ui-widget-content" id="bank9"><span>中信银行</span></li>
							<li class="ui-widget-content" id="bank10"><span>广发银行</span></li>
							<li class="ui-widget-content" id="bank11"><span>兴业银行</span></li>
							<li class="ui-widget-content" id="bank12"><span>中国邮政银行</span></li>
							<li class="ui-widget-content" id="bank13"><span>民生银行</span></li>
							<li class="ui-widget-content" id="bank14"><span>上海银行</span></li>
							<li class="ui-widget-content" id="bank15"><span>平安银行</span></li>
							<li class="ui-widget-content" id="bank16"><span>北京银行</span></li>
							<li class="ui-widget-content" id="bank17"><span>深圳发展银行</span></li>
							<li class="ui-widget-content" id="bank18"><span>华夏银行</span></li>
						</ol>

						<hr/>
					</fieldset>

					<fieldset><input type="checkbox" /> 同意<a href="###" target="_blank" style="text-decoration: underline;">支付条款</a></fieldset>
					<fieldset>当您点击“继续前往支付”键，会打开一个外部网站以完成付款。</fieldset>
					<fieldset>
						<!--paygataway 支付方式-->
						<input type="hidden" id="paygataway" value="支付宝支付" />
						<!--paygataway 支付银行-->
						<input type="hidden" id="paybank" value="" />
						<button>继续前往支付</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
<script>
$(function() {
	
	$("#payments").selectable({
		stop: function() {
			if ( $("#payments3").hasClass("ui-selected") ){
				$("#bank-select-container").css( "display","block" );
			}else{
				$("#bank-select-container").css( "display","none" );
			}
			var paygataway=  $("#payments .ui-selected a").html() ;
			$("#paygataway").val( paygataway );
			$("#payname").html( paygataway );
		}
	});


	$("#payamount-select").selectable({
		stop: function() {
			var payamount= parseInt( $("#payamount-select .ui-selected").html() );
			if(!payamount) payamount=0;
	  		$("#payamount").val( payamount );
	  		$("#paycurrency").html( payamount *10 );
		}
	});

	$("#bank-select").selectable({
		stop: function() {
			var paybank=  $("#bank-select .ui-selected").attr("id") ;
	  		$("#paybank").val( paybank );
		}
	});
});
</script>