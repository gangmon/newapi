<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Judgement;
use yii\widgets\ActiveForm;
use common\models\Choice;

$this->title = "考试";
$this->params['breadcrumbs'][] = $this->title;

?>

    <script>
        var seconds = 60*30;
        function secondPassed() {
            var minutes = Math.round((seconds - 30)/60);
            var remainingSeconds = seconds % 60;
            document.getElementById('gethidden').innerHTML = "离考试结束剩余：";

            if (remainingSeconds < 10) {
                remainingSeconds = "0" + remainingSeconds;
                document.getElementById('countdown').style.color="#ff0000";
            }
            document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
            if (seconds == 0) {
                sub();
                clearInterval(countdownTimer);
                document.getElementById('gethidden').hidden = true;
                document.getElementById('countdown').innerHTML = "时间已用完,考试已结束";
                alert("时间已用完,考试已结束");
                document.getElementById('quizover').innerHTML = "考试结束";
            } else {
                seconds--;
            }
        }
        var countdownTimer = setInterval('secondPassed()', 1000);
        function sub(){
            document.acform.submit();
        }
    </script>







    <div class="judgement-view">

        <h1><?= Html::encode('判断题') ?> </h1>
        <h4> <span id="gethidden"></span><span id="countdown" class="timer"></span></h4>

        <?php $form = ActiveForm::begin([
            'options' => [
                'name' => 'acform',
            ],
        ]); ?>

        <?php
        $i = 0;
        foreach ($judgementforms as $judgementform => $v){
            $model = Judgement::findOne($shuffleJudgementids[$i]['id']);
            echo $this->render('_judgementtitle',[
                'model' => $model,
            ]);
            echo $form->field($v, "[{$judgementform}]judgement_answer")->dropDownList([ 1 => '对', 2 => '错', ], ['prompt' => '请选择答案'],['labelOptions' => ['class' => 'col-lg-2 control-label']]);
            $i ++;
        }
        ?>
        <input type="hidden" name="time" value="<?= time()?>">
        <input type="hidden" name="is_real" value="<?= $is_real?>">
    </div>

    <h1><?= Html::encode("选择题") ?> </h1>


<?php
$i = 0;
foreach ($choiceforms as $index => $v ){
    $choicequiz = Choice::findOne($shuffleChoiceids[$i]['id']);
    echo $this->render('_choicetitle', [
        'model' => $choicequiz,
    ]);
    echo $form->field($v, "[{$index}]choice_answer")->dropDownList([ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', ], ['prompt' => '请选择正确选项']);
    $i++;
}
?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '提交'),['class' => 'btn btn-success']); ?>
    </div>
<?php
ActiveForm::end();
?>
