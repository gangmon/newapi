<?php
/**
 * Created by PhpStorm.
 * User: gang
 * Date: 2018/3/20
 * Time: 下午12:10
 */

/**
 * Created by PhpStorm.
 * User: gang
 * Date: 2018/3/20
 * Time: 上午8:14
 */


use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Result */

//$this->title = $model->id;
$this->title = '模拟测试结果';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '考试结果'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = '详情';
?>
<div class="result-view">


<!--    <h1>--><?//= Html::encode('考试成绩编号：'.$model->id) ?><!--</h1>-->
    <h4 style="color: <?= $model->score>60?'green':'red'?>">此次考试成绩：<?= $model->score>60?'合格':'不合格'?></h4>





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                    'attribute' => 'id',
                    'label' => '考试场次编号',
            ],
            [
                    'attribute' => 'user_id',
                    'label' => '考试人ID',
            ],
//            'user_id',
            [
                    'attribute' => 'user_id',
                    'label' => '考试人姓名',
                    'value' => $model->user->username,
            ],
            'score',
//            'create_time:datetime',
            [
                'attribute'=>'create_time',
                'label' => '考试时间',
                'value'=>date("Y-m-d H:i:s",$model->create_time),
            ],
            [
//                'attribute' => 'score',
                'label' => '是否合格',
                'value' => $model->score>60?'合格':'不合格',
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', '查看选择题详情'), ['choicepaper/view-result-id', 'id' => $model->id], [
            'class' => 'btn btn-primary'
        ]) ?>


            <?//= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ]) ?>

    </p>
</div>
