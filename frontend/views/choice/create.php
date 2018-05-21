<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Choice */

$this->title = Yii::t('app', 'Create Choice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Choices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="choice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
