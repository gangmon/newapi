<?php
//显示题目内容，不包含答案

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Judgement;
?>



<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
//        'id',
        [
            'attribute' => "title",
            'label' => "题目内容",
            'value' => $model->title,
//            'contentOptions' => ['width' => '50px']
        ],
        ['attribute' => 'A','value' => $model->A],
        'B:ntext',
        'C:ntext',
        'D:ntext',
    ],
    'template'=>'<tr><th style="width:50px;">{label}</th><td>{value}</td></tr>',
    'options'=>['class'=>'table table-striped table-bordered detail-view'],
]) ?>