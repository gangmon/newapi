<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<div class="choice-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
        ],
        'template'=>'<tr><th style="width:50px;">{label}</th><td>{value}</td></tr>',
        'options'=>['class'=>'table table-striped table-bordered detail-view'],
    ]) ?>

</div>
