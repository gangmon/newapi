<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Choice */

//$this->title = $model->title;
$this->title = '选择题详情';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Choices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="choice-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',

//            'admin_id',
            [
                'label' => '出题人',
                'value' => $model->admin->username,
            ],
//            'title:ntext',
            [
                    'label' => "题目内容",
                'value' => $model->title,
            ],
            ['attribute' => 'A','value' => $model->A],
            'B:ntext',
            'C:ntext',
            'D:ntext',
            [
                'attribute' => 'answer',

            ],
//            'score',//分数
            'difficulty',
//            'create_time:datetime',
            [
                    'attribute'=>'create_time',
                'value'=>date('Y-m-d h:i:s',$model->create_time)
            ],
//            'update_time:datetime',
            [
                    'attribute'=>'update_time',
                'value'=>date('Y-m-d h:i:s',$model->update_time)
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', '添加'), ['create', 'id' => $model->id], ['class' => "btn  btn-success"]) ?>

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

</div>
