<?php $this->beginContent("//layouts/header"); ?>
<?php $this->endContent(); ?>
<body class="<?=$this->body?>">

	<?php $this->beginContent("//layouts/header_admin_nonav"); ?>
	<?php $this->endContent(); ?>
	<?php echo $content;?>

	<?php $this->beginContent("//layouts/footer"); ?>
	<?php $this->endContent(); ?>
</body>
</html>
