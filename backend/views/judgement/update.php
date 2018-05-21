<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Judgement */

//$this->title = Yii::t('app', 'Update {modelClass}: ', ['modelClass' => 'Judgement',]) . $model->title;
$this->title = '修改判断题';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Judgements'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => '回到此题详情', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Fix it');
?>
<div class="judgement-update">

    <h1><?= Html::encode('修改题目编号：'.$model->id) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
