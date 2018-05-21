<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Choice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="choice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'answer')->dropDownList([ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'admin_id')->textInput() ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'A')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'B')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'C')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'D')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <?= $form->field($model, 'difficulty')->dropDownList([ '简单' => '简单', '中等' => '中等', '困难' => '困难', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
