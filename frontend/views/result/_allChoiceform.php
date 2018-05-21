<?php
//显示题目内容，不包含答案

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Judgement;
use yii\widgets\ActiveForm;
use common\models\Choicepaper;
use common\models\Choice;
?>





<?php
$queryID = Yii::$app->db->createCommand('SELECT id FROM test_choice')->queryAll();
//$numID = range($queryID);
//打乱顺序
shuffle($queryID);
$how_mangChoice = 5;
$shuffleIDs = array_slice($queryID,0,$how_mangChoice);


$choiceforms = [new Choicepaper()];
$count = count(Yii::$app->request->post('Choicepaper', []));
for ($i = 0;$i < $how_mangChoice-1;$i++){
    $choiceforms[] = new Choicepaper();
    $choiceforms[$i]->choice_id = $shuffleIDs[$i]['id'];
    $choiceforms[$i]->result_id = $result->id;
}
?>
<?php
$i = 0;
 $form = ActiveForm::begin();


foreach ($choiceforms as $index => $v ){
    $choicequiz = Choice::findOne($shuffleIDs[$i]);

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


//以下是调试代码
//print_r($result->id);
//print_r($shuffleIDs);echo "<br>";
//
//echo "<pre>"; print_r($choiceforms); echo "</pre>";
//    print_r($shuffleIDs[0]['id']);echo "<br>";
//print_r($shuffleIDs[1]['id']);echo "<br>";
//print_r($shuffleIDs[2]['id']);echo "<br>";
//echo "<br>";
//print_r($choiceforms[0]->choice_id);echo "<br>";










//foreach ($shuffleIDs as $shuffleID ){
//    $choicequiz = Choice::findOne($shuffleID);
//    echo  DetailView::widget([
//        'model' => $choicequiz,
//        'attributes' => [
////        'id',
//            [
//                'attribute' => "title",
//                'label' => "题目内容",
//                'value' => $choicequiz->title,
////            'contentOptions' => ['width' => '50px']
//            ],
//            ['attribute' => 'A','value' => $choicequiz->A],
//            'B:ntext',
//            'C:ntext',
//            'D:ntext',
//        ],
//        'template'=>'<tr><th style="width:50px;">{label}</th><td>{value}</td></tr>',
//        'options'=>['class'=>'table table-striped table-bordered detail-view'],
//    ]);
//    //新建一个选择题下拉菜单，用来存放考试结果
////        $choiceforms[] = new Choicepaper();
//
//    echo $form->field($choiceforms[$i], 'choice_answer')->dropDownList([ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', ], ['prompt' => '请选择正确选项']);
//    echo "<pre>"; print_r($shuffleID); echo "</pre>";
//    $i ++;
//}


