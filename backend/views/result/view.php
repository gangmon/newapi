<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Judgementpaper;
use common\models\Choicepaper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Result */

//$this->title = $model->id;
$this->title = '考试结果';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '考试结果总览'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = '详情';
?>
<div class="result-view">

    <h1><?= Html::encode('考试成绩编号：'.$model->id) ?></h1>





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                    'attribute' => 'id',
                    'label' => '考试成绩编号',
            ],
            [
                    'label' => '考试类型',
                    'value' => function ($model){return $model->is_real==1?'模拟测试':'正式考试';},

            ],
            [
                    'attribute' => 'user_id',
                    'label' => '考试人ID',
            ],
//            'user_id',
            [
                    'attribute' => 'user_id',
                    'label' => '参与考试人员姓名',
                    'value' => $model->user->username,
            ],
            'score',
//            'create_time:datetime',
            [
                'attribute'=>'create_time',
                'label' => '考试时间',
                'value'=>date("Y-m-d H:i:s",$model->create_time),
            ]

        ],
    ]) ?>

    <p>

        <?= Judgementpaper::findAll(['result_id' => $model->id])?Html::a(Yii::t('app', '查看判断题答题详情'), ['judgementpaper/view-result-id', 'id' => $model->id], [
           'class' => $model->score>60?'btn btn-success':'btn btn-danger',
//           'data' => ['method' => 'post'],
            ]):'此考试仅为选择题模拟测试' ?>

<!--        <h1>--><?php //print_r(Choicepaper::findAll( $model->id));?><!--</h1>-->
        <?= Choicepaper::findAll(['result_id' =>$model->id])?Html::a(Yii::t('app', '查看选择题答题详情'), ['choicepaper/view-result-id', 'id' => $model->id], [
            'class' => $model->score>60?'btn btn-success':'btn btn-danger',
            'data' => [
//            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
            ],
        ]):'此考试仅为判断题模拟测试' ?>



    </p>
</div>
