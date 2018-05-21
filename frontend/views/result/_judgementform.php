<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<!--<div class="judgementpaper-form">-->





    <?= $form->field($model, 'judgement_answer')->dropDownList([ 1 => '对', 2 => '错', ], ['prompt' => '请选择答案']) ?>




<!--</div>-->