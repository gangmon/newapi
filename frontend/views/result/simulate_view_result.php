<?php
/**
 * Created by PhpStorm.
 * User: gang
 * Date: 2018/3/20
 * Time: 上午8:14
 */


use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Judgementpaper;
use common\models\Choicepaper;

//$this->title = $model->id;
$this->title = '考试结果';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '考试结果'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = '详情';
?>
<div class="result-view">

<!--    --><?php //if (Yii::$app->session->hasFlash('error')): ?>
<!--    <div class="alert alert-success">-->
<!--        Thank you for contacting us.We will respond to you as soon as possible.-->
<!--    </div>-->
<!--    --><?php //endif; ?>

    <h1><?= Html::encode('考试成绩编号：'.$model->id) ?></h1>


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
            [
                'attribute'=>'create_time',
                'label' => '考试时间',
                'value'=>date("Y-m-d H:i:s",$model->create_time),
            ],
            [
                'label' => '是否合格',
                'value' => $model->score>60?'合格':'不合格',
            ],
        ],
    ]) ?>

    <p>

        <?= Judgementpaper::findAll(['result_id' => $model->id])?Html::a(Yii::t('app', '查看判断题答题详情'),
            ['judgementpaper/view-result-id', 'id' => $model->id], [
            'class' => $model->score>60?'btn btn-success':'btn btn-danger',]):'' ?>

        <?= Choicepaper::findAll(['result_id' =>$model->id])?Html::a(Yii::t('app', '查看选择题答题详情'),
            ['choicepaper/view-result-id', 'id' => $model->id],
            ['class' => $model->score>60?'btn btn-success':'btn btn-danger',]):'' ?>
    </p>
</div>
