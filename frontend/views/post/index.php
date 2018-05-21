<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                    'attribute' => 'id',
                    'contentOptions' => ['width' => '50px'],
            ],
            [
                    'attribute' => 'title',
                    'contentOptions' => ['width' => '50px'],
            ],
//            'content:ntext',
            [
                    'attribute' => 'content',
                    'value' => 'beginning',
//                    'value' => $searchModel->getBeginning(),
            ],

            [
                    'attribute' => 'tags',
                'contentOptions' => ['width' => '50px'],
            ],
            [
                    'attribute' => 'status',
                    'value' => 'status',
                    'contentOptions' => ['width' => '40px'],
                    'filter' => \common\models\Post::find()
                        ->select(['status'])
                        ->indexBy('status')
                        ->column(),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {delete}',//只需要展示删除和更新
                'headerOptions' => ['width' => '100'],
                'buttons' => [
                    'view' => function($url,$model,$key){
                        return Html::a('查看',
                            ['post/view','id' => $model->id],
//                                ['class' => "glyphicon fa fa-eye"],
                            ['class' => "btn btn-xs btn-success"]
                        );},
                    'update' => function($url,$model,$key){
                        return Html::a('修改',
                            ['post/update','id' => $model->id],
                            ['class' => "btn btn-xs btn-info"]
                        );},
                    'delete' => function($url,$model,$key){
                        return Html::a('删除',
                            ['post/delete','id' => 'id'],
                            ['class' => "btn btn-xs btn-danger"]
                        );}

                ],

            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
