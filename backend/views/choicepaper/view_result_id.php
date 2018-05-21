<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="choicepaper-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'choice_id',
//            'choice_answer',
            [
                    'attribute' => 'choice_answer',
                    'label' => '考生答案',
                    'value' => $model->choice_answer?$model->choice_answer:"未作答",

            ],
//            'test_time:datetime',
//            [
//                    'attribute'=>'test_time',
//                    'label' => '考试时间',
//                    'value'=>date("Y-m-d H:i:s",$model->test_time),
//            ],

        ],
        'template'=>'<tr><th style="width:50px;">{label}</th><td>{value}</td></tr>',
        'options'=>['class'=>'table table-striped table-bordered detail-view'],
    ]) ?>

</div>
