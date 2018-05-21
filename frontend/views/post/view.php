<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'tags',
            'status',
            [
                    'attribute' => 'author_id',
                    'value' => $model->author->username,
                    'contentOptions' => ['width' => '95%'],
            ],
            [
                'attribute'=>'created_at',
                'value'=>date('Y-m-d h:i:s',$model->updated_at)
            ],
            [
                'attribute'=>'updated_at',
                'value'=>date('Y-m-d h:i:s',$model->updated_at)
            ],
        ],
    ]) ?>

</div>
