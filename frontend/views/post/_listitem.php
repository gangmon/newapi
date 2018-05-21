<?php
use yii\helpers\Html;
?>

<div class="post">
	<div class="title">
		<h3><a href="<?= $model->url;?>"><?= Html::encode($model->title);?></a></h3>
	
		<div class="author">
		<span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= date('Y-m-d H:i:s',$model->created_at)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?= Html::encode($model->author->username);?></em>
		</div>
	</div>
	
	<br>
	<div class="content">
	<?= $model->beginning188;?>
	</div>
	
	<br>
	<div class="nav">
		<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            <?= Html::encode($model->tags)?>
		<br>
		<?= Html::a("评论 ({$model->commentCount})",$model->url.'#comments')?> | <?= Html::a("阅读 ({$model->times})",$model->url)?>)
	</div>
	
</div>
