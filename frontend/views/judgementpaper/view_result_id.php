<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="judgementpaper-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'judgement_answer',
                'label' => '您的答案',
                'value' => $model->judgement_answer?($model->judgement_answer==1?'对':'错'):"未作答",
            ],
        ],
        'template'=>'<tr><th style="width:50px;">{label}</th><td>{value}</td></tr>',
        'options'=>['class'=>'table table-striped table-bordered detail-view'],
    ]) ?>

</div>
