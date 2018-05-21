<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Judgement */

//$this->title = $model->title;
$this->title = "判断题详情";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Judgements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgement-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title:ntext',
//            'answer',
            [
                    'attribute' => 'answer',
                'value'=>function ($model){return $model->answer==1?'对':'错';}
             ],

            'score',
//            'admin_id',
            [
                    'label' => '出题人',
                    'value' => $model->admin->username,
            ],
//            'create_time:datetime',
            [
                'attribute'=>'create_time',
                'value'=>date('Y-m-d h:i:s',$model->update_time)
            ],
//            'update_time:datetime',
            [
                'attribute'=>'update_time',
                'value'=>date('Y-m-d h:i:s',$model->update_time)
            ],
        ],
    ]) ?>

</div>
<p>
    <?= Html::a(Yii::t('app', '添加'), ['create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a(Yii::t('app', 'Fix it'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
    ]) ?>
    <?php
    $returnURL = Yii::$app->request->referrer;
    ?>
    <?= $returnURL?Html::a(Yii::t('app', '返回'), $returnURL, [
        'class' => 'btn btn-success',
    ]):'' ?>
</p>