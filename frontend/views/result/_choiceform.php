<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<!--<div class="choicepaper-form">-->
<!---->
<!--    --><?php //$form = ActiveForm::begin(); ?>
<!---->
<!--<!--    -->--><?////= $form->field($model, 'result_id')->textInput() ?>
<!---->
<!--<!--    -->--><?////= $form->field($model, 'choice_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'choice_answer')->dropDownList([ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', ], ['prompt' => '请选择正确选项']) ?>
<!---->
<!--<!--    -->--><?////= $form->field($model, 'test_time')->textInput() ?>
<!---->
<!--<!--    <div class="form-group">-->-->
<!--<!--        -->--><?////= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
<!--<!--    </div>-->-->
<!---->
<!---->
<!--    --><?php //ActiveForm::end(); ?>
<!---->
<!--</div>-->
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'choice_answer')->dropDownList([ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', ], ['prompt' => '请选择正确选项']) ?>
<?php ActiveForm::end(); ?>
