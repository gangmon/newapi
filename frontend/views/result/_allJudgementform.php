<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Judgement;
use yii\widgets\ActiveForm;
$this->title = "判断题";
$this->params['breadcrumbs'][] = $this->title;

?>
<!---->
<!--<script>-->
<!--    var seconds = 8;-->
<!--    function secondPassed() {-->
<!--        var minutes = Math.round((seconds - 30)/60);-->
<!--        var remainingSeconds = seconds % 60;-->
<!--        document.getElementById('gethidden').innerHTML = "离考试结束剩余：";-->
<!---->
<!--        if (remainingSeconds < 10) {-->
<!--            remainingSeconds = "0" + remainingSeconds;-->
<!--            document.getElementById('countdown').style.color="#ff0000";-->
<!--        }-->
<!--        document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;-->
<!--        if (seconds == 0) {-->
<!--            sub();-->
<!--            clearInterval(countdownTimer);-->
<!--            document.getElementById('gethidden').hidden = true;-->
<!--            document.getElementById('countdown').innerHTML = "时间已用完,考试已结束";-->
<!--            alert("时间已用完,考试已结束");-->
<!--            document.getElementById('quizover').innerHTML = "考试结束";-->
<!---->
<!--        } else {-->
<!--            seconds--;-->
<!--        }-->
<!--    }-->
<!--    var countdownTimer = setInterval('secondPassed()', 1000);-->
<!---->
<!---->
<!--    function sub(){-->
<!--        document.acform.submit();-->
<!--    }-->
<!---->
<!--</script>-->





<div class="judgement-view">

    <h1><?= Html::encode($this->title) ?> </h1>
            <h4> <span id="gethidden"></span><span id="countdown" class="timer"></span></h4>


    <?php
        foreach ($shuffleids as $shuffled){
            $model = Judgement::findOne($shuffled['id']);
//            echo $this->render('_judgementtitle',[
//                'model' => $model,
//            ]);
        }
    ?>


    <?php $form = ActiveForm::begin([
//            'method' => 'post',
//            'id' => 'form-save',
//            'enableAjaxValidation' => true,
            'options' => [
                    'name' => 'acform',
            ],
    ]); ?>
    <?php
    $i = 0;
        foreach ($judgementforms as $judgementform => $v){
          $model = Judgement::findOne($shuffleids[$i]['id']);
            echo $this->render('_judgementtitle',[
                    'model' => $model,
            ]);
            echo $form->field($v, "[{$judgementform}]judgement_answer")->dropDownList([ 1 => '对', 2 => '错', ], ['prompt' => '请选择答案'],['labelOptions' => ['class' => 'col-lg-2 control-label']]);
        $i ++;
    }
    ?>
    <input type="hidden" name="time" value="<?= time()?>">

    <div class="form-group" id="hei">
        <?= Html::submitButton(Yii::t('app', '提交'),['class' => 'btn btn-success',
            'id'=> 'hei' ]); ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>

<!--<form action="--><?//= $_SERVER['PHP_SELF']?><!--"  method="get">-->
<!---->
<!--    <input type="hidden" name="time" value="--><?//= time()?><!--">-->
<!---->
<!--    <input type="submit" value="test">-->
<!--</form>-->
<?php //echo $_SERVER['PHP_SELF'];
//print_r(Yii::$app->request->post('time'));

//   if($_POST["time"]+300 >= time()){
//    echo "you took too long!";
//    exit;
//}
//    if (Yii::$app->request)






//
//<!---->
//<!--<script language="javascript">-->
//<!--    var i=0;-->
//<!--    function showtime(){-->
//<!--        i=i+1;-->
//<!--        id2.innerHTML=i;-->
//<!--        setTimeout("showtime()",29);-->
//<!--        if(i==30)-->
//<!--            document.form.submit();-->
//<!--    }-->
//<!--    showtime();-->
//<!--</script>-->




