<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Choicepaper */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Choicepaper',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Choicepapers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Submit Fixed');
?>
<div class="choicepaper-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
