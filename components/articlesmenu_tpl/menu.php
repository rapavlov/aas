<?php //debug($this->controller_id);
///avatar/imagecategories?category=auto   $this->controller_id.
?>
<li class="" style="list-style-type:none;">
	<a href="<?=\yii\helpers\Url::to('/'.$this->controller_id.'/index?article='.$article[url]) ?>" class="list-group-item list-group-item-info"> 
		<?php echo $article[title];?>
	</a>

</li>