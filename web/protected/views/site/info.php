	<?if($interval>0){?>
	<meta http-equiv="Refresh" content="<?=$interval?>; url=<?=$redirect?>" /> 
	<?}?>
	<div id="header-home-logo" class="singleformlogo"></div>
	<div class="singleform dark"><!--注册失败1-->
		<div class="resault">
		<h1><?=$message?></h1>
		<?=$extMessage?>
		<a href="<?=$redirect?>" class="button"><?=$clue?></a>
		</div>
	</div>