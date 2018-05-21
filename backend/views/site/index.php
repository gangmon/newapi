<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '安全规程考核系统';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>后台管理入口</h1>

        <p class="lead">在这里你可以创建考试题目，查看企业内部工作人员的考试信息，衡量他们的专业知识素养。</p>
        <p class="lead">同时你可已发表自己或者别人的具有指导意义的文章、报道、新闻等 </p>

        <p>
            <?= Html::a('管理成绩',['result/index',],['class' => "btn btn-lg btn-success" ])?>
            <?= Html::a('发表文章',['post/create',],['class' => "btn btn-lg btn-success" ])?>
        </p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>创建试题</h2>

                <p>在这里你可以上传精心准备的试题，考生考试时，您创建的试题将会随机生成一套试卷。</p>
                <p><?= Html::a('创建判断题&raquo;',['judgement/create',],['class' => "btn btn-default" ])?></p>
                <p><?= Html::a('创建选择题&raquo;',['choice/create',],['class' => "btn btn-default" ])?></p>

            </div>
            <div class="col-lg-4">
                <h2>管理试题</h2>
                <p>在这里你可以管理许多和你一样具有管理员权限的人创建的试题，如果你发现他们创建的试题有错误，您可以修改或者删除他们</p>
                <p><?= Html::a('管理判断题&raquo;',['judgement/index',],['class' => "btn btn-default" ])?></p>
                <p><?= Html::a('管理选择题&raquo;',['choice/index',],['class' => "btn btn-default" ])?></p>
            </div>
            <div class="col-lg-4">
                <h2>查看考试信息</h2>
                <p>在这里您可以查看本企业的员工平时的模拟成绩，了解他们专业知识水平，也可以看到正式测试考试的成绩。
                这里你可以发表你自己或者别人的文章，报道信息，强化员工的素质。</p>
                <p><?= Html::a('查看成绩&raquo;',['result/index',],['class' => "btn btn-default" ])?></p>
                <p><?= Html::a('发表文章&raquo;',['result/create',],['class' => "btn btn-default" ])?></p>
            </div>
        </div>

    </div>
</div>
