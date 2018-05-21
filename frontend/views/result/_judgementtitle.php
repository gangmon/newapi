<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title:ntext',
        ],
    'template'=>'<tr><th style="width:50px;">{label}</th><td>{value}</td></tr>',
    'options'=>['class'=>'table table-striped table-bordered detail-view'],

    ]) ?>

