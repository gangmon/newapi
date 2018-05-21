<?php
/**
 * Created by PhpStorm.
 * User: gang
 * Date: 2018/3/19
 * Time: 下午11:28
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

//$this->title = "判断题详?情";
?>
<div class="judgement-view">


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
        ],
        'template'=>'<tr><th style="width:50px;">{label}</th><td>{value}</td></tr>',
        'options'=>['class'=>'table table-striped table-bordered detail-view'],
    ]) ?>
