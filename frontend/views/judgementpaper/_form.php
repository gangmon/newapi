<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Judgementpaper */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="judgementpaper-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'result_id')->textInput() ?>

    <?= $form->field($model, 'judgement_id')->textInput() ?>

    <?= $form->field($model, 'judgement_answer')->dropDownList([ 1 => '1', 2 => '2', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'test_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
