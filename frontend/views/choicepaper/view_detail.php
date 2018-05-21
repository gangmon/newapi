<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Choice;

?>

<div class="choicepaper-view">

    <?php
        foreach ($models as $model){
            $aboutChoice = Choice::findOne($model->choice_id);
            echo $this->render('/choice/_choice_view_only',['model' => $aboutChoice]);
            echo $this->render('view_result_id',['model' => $model]);
        }
    ?>


</div>
<?php
$returnURL = Yii::$app->request->referrer;
?>
<?= $returnURL?Html::a(Yii::t('app', '返回上一页'), $returnURL, [
    'class' => 'btn btn-success',
]):'' ?>
