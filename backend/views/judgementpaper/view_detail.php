<?php

use yii\helpers\Html;
use common\models\Judgement;

/* @var $this yii\web\View */
/* @var $model common\models\Judgementpaper */

$this->title = '判断题作答详情';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '判断题作答全览'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$returnURL = Yii::$app->request->referrer;

?>
<div class="judgementpaper-view">



    <?php
        foreach ($models as $model)
        {
            $aboutJudgement = Judgement::findOne($model->judgement_id);
            echo $this->render('/judgement/_judgement_view_only',['model' => $aboutJudgement]);
            echo $this->render('view_result_id',['model' => $model ]);
        }
    ?>


</div>
<?//= $returnURL?>
<?= $returnURL?Html::a(Yii::t('app', '返回上一页'), $returnURL, [
    'class' => 'btn btn-success',
]):'' ?>