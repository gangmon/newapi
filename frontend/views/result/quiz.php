<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '考试中');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="result-create">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    --><?php
    //        echo $this->render('view', [
    //        'model' => $this->findModel(1),
    //        ]);
    //
    //    ?>
    <?= $this->render('_quizform', [
        'choicequiz' => $choicequiz,
    ]) ?>

</div>