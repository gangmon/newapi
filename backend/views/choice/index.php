<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ChoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Choices');
//$this->params['breadcrumbs'][] = $this->title;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="choice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Choice'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                 'attribute'=>'id',
                'contentOptions'=>['width'=>'30px'],
            ],
            [
                'attribute' => 'title',
                'value' => 'beginning',
            ],
//            'A:ntext',
            // 'B:ntext',
            // 'C:ntext',
            // 'D:ntext',
            // 'score',
            //
            // 'create_time:datetime',
            // 'update_time:datetime',
//            'answer',
//            'admin_id',
            [
                    'attribute' => 'admin_id',
                'value' => 'admin.username',
                'contentOptions' => ['width'=>'140px','prompt'=>'全部'],

                'filter' => \backend\models\Adminuser::find()
                ->select(['username'])
                ->indexBy('id')
                ->column(),

//                'filter'=> \common\models\Poststatus::find()
//                    ->select(['name','id'])
//                    ->orderBy('position')
//                    ->indexBy('id')
//                    ->column(),
            ],
//            'difficulty',难度等级

            [
                    'attribute' => 'difficulty',
                'contentOptions' => ['width' => '80'],
                'filter' => ["简单"=>"简单","中等"=>"中等","困难" =>"困难"],
            ],
//            'filter' => Html::activeDropDownList($searchModel,
//                'difficulty',['简单'=>'简单','中等'=>'中等','困难' =>"困难"],
//                ['prompt'=>'全部']
//     ),
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
                               ['choice/view','id' => $model->id],
//                                ['class' => "glyphicon fa fa-eye"],
                               ['class' => "btn btn-xs btn-success"]
                           );},
                       'update' => function($url,$model,$key){
                           return Html::a('修改',
                               ['choice/update','id' => $model->id],
                               ['class' => "btn btn-xs btn-info"]
                           );},
                       'delete' => function($url,$model,$key){
                           return Html::a('删除',
                               ['choice/delete','id' => $model->id],
                               [
                                   'class' => "btn btn-xs btn-danger",
                                   'data' => [
                                       'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                       'method' => 'post',
                                   ],
                                   ]


                           );}

                   ],
//          'buttons' => [
//            'delete' => function($url, $model, $key){
//               return Html::a('<i class="fa fa-ban"></i> 删除',
//                    ['del', 'id' => $key],
//                    [
//                     'class' => 'btn btn-default btn-xs',
//                     'data' => ['confirm' => '你确定要删除文章吗？',]
//                    ]
//               );
//             },
//           ],
         ],




        ],
    ]); ?>
<?php Pjax::end(); ?></div>
