<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<?php
use HelloWidget;
?>
<?= HelloWidget::widget(['message' => 'Good morning']) ?>
<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p><?=$var?></p>
