<?php
use yii\helpers\Html;
use common\models\Post;
use yii\widgets\ListView;
use frontend\components\TagsCloudWidget;
/* @var $this yii\web\View */

$this->title = '工作人员在线考试系统';
?>

<!--<ol class="breadcrumb" style="font-size: 21px;">-->
<!--    <li>-->
<!--        <a href="--><?php //Yii::$app->homeUrl;?><!--" class="glyphicon glyphicon-home">首页</a>-->
<!--        <a href="#"  class="glyphicon glyphicon-align-justify">目录</a>-->
<!--        <a href="#" class="glyphicon glyphicon-list-alt" >历史</a>-->
<!--        <a href="#" class="glyphicon glyphicon-stats" >等级</a>-->
<!--        <a href="#" class="glyphicon glyphicon-log-out">退出</a>-->
<!--    </li>-->
<!--</ol>-->



<div class="container">

    <div class="row">
        <div class="col-md-8">
            <div class="jumbotron">
                <h1>工作人员在线考试系统</h1>

                <p class="lead">这里有最权威的测试系统，包含井巷、通风、排水、爆破</p>
                <p><?= Html::a('点击进入模拟考试系统',['result/allquiz'],['class' => "btn btn-lg btn-success",'style' => 'margin-top:19px;border-radius: 30px','data' => ['method' => 'post', 'params' => ['is_real' => '1']]])?>
                    <?= Html::a('点击进入正式考试系统',['result/allquiz'],['class' => "btn btn-lg btn-primary",'style' => 'margin-top:19px;border-radius: 30px','data' => ['method' => 'post', 'params' => ['is_real' => '2']]])?></p>

            </div>

            <h2><?= Html::a('最新文章动态',['post/index'])?></h2>
            <?= ListView::widget([
                'id'=>'postList',
                'dataProvider'=>$dataProvider,
                'itemView'=>'../post/_listitem',//子视图,显示一篇文章的标题等内容.
                'layout'=>'{items} {pager}',
                'pager'=>[
                    'maxButtonCount'=>10,
                    'nextPageLabel'=>Yii::t('app','下一页'),
                    'prevPageLabel'=>Yii::t('app','上一页'),
                ],
            ])?>






        </div>


        <div class="col-md-4">
            <div class="searchbox">
                <ul class="list-group">

                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>查找文章(<?= Post::find()->count();?>)
                    </li>
                    <li class="list-group-item">
                        <form class="form-inline" action="#" id="w0" method="get">
                            <div class="form-group">
                                <input type="text" class="form-control" name="PostSearch[title]" id="w0input" placeholder="按标题">

                            </div>
                            <button type="submit" class="btn btn-default">搜索</button>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="tagcloudbox">
                <ul class="list-group">

                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>标签云
                    </li>
                    <li class="list-group-item">
                        <?= TagsCloudWidget::widget(['tags'=>$tags])?>
                    </li>
                </ul>
            </div>


            <div class="commmentbox">
                <ul class="list-group">

                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>最新回复
                    </li>
                    <li class="list-group-item">
                        <?= \frontend\components\RctReplyWidget::widget(['recentComments'=>$recentComments])?>
                    </li>
                </ul>
            </div>

        </div>

    </div>



    <div class="body-content">

        <div class="row">


        </div>



        <div class="row">
            <div class="col-lg-4">
                <h2>模拟测试</h2>
                <p>本考试系统由数据库随机出题，进行电脑及时阅卷，可以检测工程安全员的专业知识水平，进行实时考核。同时也可以进行在线模拟测试。</p>

                <p><?= Html::a('判断题模拟测试&raquo;',['result/judgement',],['class' => "btn btn-default" ])?></p>
                <p><?= Html::a('选择题模拟测试&raquo;',['result/choice'],['class' => "btn btn-default" ])?></p>
                <p><?= Html::a('仿真模拟测试&raquo;',['result/allquiz'],['class' => "btn btn-default",'data' => ['method' => 'post', 'params' => ['is_real' => '2']]])?></p>

            </div>

            <div class="col-lg-4">
                <h2>探究讨论</h2>

                <p>矿产资源开采回采率、选矿回收率和综合利用率是衡量矿山企业开采技术优劣和企业管理水平、
                    资源利用程度高低的主要技术经济指标，
                    “三率”水平的高低决定矿山的当前经济效益与总的资源效益。</p>

            </div>
        </div>

    </div>
</div>