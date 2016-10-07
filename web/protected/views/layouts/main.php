<?php $this->beginContent("//layouts/header"); ?>
<?php $this->endContent(); ?>
<body class="<?=$this->body?>">

	<?php $this->beginContent("//layouts/header_nav"); ?>
	<?php $this->endContent(); ?>
	<?php echo $content;?>

	<?php $this->beginContent("//layouts/footer"); ?>
	<?php $this->endContent(); ?>
</body>
</html>
