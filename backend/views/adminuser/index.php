<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Adminusers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Adminuser'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'nickname',
            'password',
            'email:email',
            // 'profile:ntext',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'settime:datetime',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                //动作列yii\grid\ActionColumn
                //用于显示一些动作按钮，如每一行的更新、删除操作。
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view}  {update}   {delete} ',//只需要展示删除和更新
                'headerOptions' => ['width' => '100'],
                'buttons' => [
                    'view' => function($url,$model,$key){
                        return Html::a('查看',
                            ['adminuser/view','id' => $model->id],
//                                ['class' => "glyphicon fa fa-eye"],
                            ['class' => "btn btn-xs btn-success"]
                        );},
                    'update' => function($url,$model,$key){
                        return Html::a('修改',
                            ['adminuser/update','id' => $model->id],
                            ['class' => "btn btn-xs btn-info"]
                        );},
                    'delete' => function($url,$model,$key){
                        return Html::a('删除',
                            ['adminuser/delete','id' => $model->id],
                            ['class' => "btn btn-xs btn-danger"]
                        );}

                ],

            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
