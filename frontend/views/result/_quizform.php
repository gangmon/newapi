<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>

    <?= DetailView::widget([
        'choicequiz' => $choicequiz,
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

</div>