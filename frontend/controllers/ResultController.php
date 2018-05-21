<?php

namespace frontend\controllers;

use common\models\Choice;
use common\models\Judgement;
use common\models\Judgementpaper;
use http\Url;
use Yii;
use frontend\models\Result;
use frontend\models\ResultSearch;
use frontend\models\ResultFrontSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Choicepaper;

use yii\widgets\DetailView;

/**
 * ResultController implements the CRUD actions for Result model.
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\base\Model;
use yii\filters\AccessControl;

class ResultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['judgement','choice','allquiz'],
//                'allowCallback' => function ($rule, $action) {
//                   Yii::$app->session->setFlash('success', 'haha,Thank you for contacting us. We will respond to you as soon as possible.');
//                },
//                'allowCallback' => function($action){
//                    if ($action->controller->id!='login'){
//                        Yii::$app->session->setFlash('success', 'haha,Thank you for contacting us. We will respond to you as soon as possible.');
//                    }
//                },
                'rules' =>
                [
                    [
                        'allow' => true,
                        'actions' => ['judgement','choice','allquiz'],
                        'roles' => ['@'],
                    ],

                ],

            ],
        ];
    }

    /**
     * Lists all Result models.
     * @return mixed
     */
    public function actionMyhistory()
    {
        $userID = Yii::$app->user->id;
        $models = Result::findAll(['user_id' => $userID]);
        return $this->render('index',[
            'models' =>  $models,
    ]);
    }

    /**
     * @用户查询自己的考试成绩
     */
    public function actionIndex()
    {
        $searchModel = new ResultFrontSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
//开始考试选择题和判断题的全套考试
    public function actionAllquiz(){
        $result =  new Result();
        //这里是随机出判断题
        $queryJudgementId = Yii::$app->db->createCommand('SELECT id from test_judgement')->queryAll();
        shuffle($queryJudgementId);
        $how_mangJudgement = 10;
        $shuffleJudgeIDs = array_slice($queryJudgementId, 0, $how_mangJudgement);
        $judgementforms = [new Judgementpaper()];
        for ($i = 0; $i < $how_mangJudgement - 1; $i++) {
            $judgementforms[] = new Judgementpaper();
            $judgementforms[$i]->judgement_id = $shuffleJudgeIDs[$i]['id'];
        }
        $user_score = 0;
        //这里是随机出选择题
        $queryChoiceId = Yii::$app->db->createCommand('SELECT id FROM test_choice')->queryAll();
        //打乱顺序
        shuffle($queryChoiceId);
        $how_mangChoice = 10;
        $shuffleChoiceIDs = array_slice($queryChoiceId,0,$how_mangChoice);

        $choiceforms = [new Choicepaper()];
        $count = count(Yii::$app->request->post('Choicepaper', []));
        for ($i = 0;$i < $how_mangChoice-1;$i++){
            $choiceforms[] = new Choicepaper();
            $choiceforms[$i]->choice_id = $shuffleChoiceIDs[$i]['id'];
            $choiceforms[$i]->result_id = $result->id;
        }
        $user_score = 0;
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $is_real = 1;
            $is_real = Yii::$app->request->post('is_real')?Yii::$app->request->post('is_real'):$is_real;
//            print_r(Yii::$app->request->post('is_real'));die;
            $result->is_real = $is_real;
            $result->score = 0;
            $result->user_id = Yii::$app->user->id;
            $result->save();
//            $quizetime = Yii::$app->request->post('time');
            if (Model::loadMultiple($choiceforms, Yii::$app->request->post()) && Model::validateMultiple($choiceforms) && Model::loadMultiple($judgementforms, Yii::$app->request->post()) && Model::validateMultiple($judgementforms))
            {
                $i = 0;
                foreach ($judgementforms as $judgementform)
                {
                    $judgementform->result_id = $result->id;
                    $judgementform->judgement_id = $shuffleJudgeIDs[$i]['id'];
                    if ($judgementform->judgement_answer == null){
                        $judgementform->judgement_answer = '0';
                    }
                    $judgementform->save();

                    if ($judgementform->judgement_answer == Judgement::findOne($shuffleJudgeIDs[$i]['id'])->answer){
                        $user_score = $user_score + Judgement::findOne($shuffleJudgeIDs[$i]['id'])->score;
                    }
                    $i++;
                }
                $i = 0;
                foreach ($choiceforms as $choiceform)
                {
                    $choiceform->result_id = $result->id;
                    $choiceform->choice_id = $shuffleChoiceIDs[$i]['id'];
                    if ($choiceform->choice_answer == null){
                        $choiceform->choice_answer = '0';
                    }
                    $choiceform->save();
                    if ($choiceform->choice_answer == Choice::findOne($shuffleChoiceIDs[$i]['id'])->answer)
                    {
                        $user_score = $user_score + Choice::findOne($shuffleChoiceIDs[$i]['id'])->score;
                    }
                    $i++;
                }
                $result->score = $user_score;
                $result->save();
                $transaction->commit();
                $this->redirect(['view','id' => $result->id]);
            }else{
                return $this->render('_allQuizForm',[
                    'is_real' => $is_real,
                    'judgementforms' => $judgementforms,
                    'shuffleJudgementids' => $shuffleJudgeIDs,
                    'choiceforms' => $choiceforms,
                    'shuffleChoiceids' => $shuffleChoiceIDs,
                ]);
            }
        } catch (Exception $e){
            $transaction->rollBack();
        }

        return $this->render('_allQuizForm',[
            'is_real' => $is_real,
            'judgementforms' => $judgementforms,
            'shuffleJudgementids' => $shuffleJudgeIDs,
            'choiceforms' => $choiceforms,
            'shuffleChoiceids' => $shuffleChoiceIDs,
        ]);

    }
    public function actionJudgement()
    {
        Yii::$app->user->setReturnUrl(Yii::$app->request->referrer);
        $result = new Result();

        $queryID = Yii::$app->db->createCommand('SELECT id from test_judgement')->queryAll();
        shuffle($queryID);
        $how_mangJudgement = 10;
        $shuffleIDs = array_slice($queryID, 0, $how_mangJudgement);
        $judgementforms = [new Judgementpaper()];
        for ($i = 0; $i < $how_mangJudgement - 1; $i++) {
            $judgementforms[] = new Judgementpaper();
            $judgementforms[$i]->judgement_id = $shuffleIDs[$i]['id'];
        }
        $user_score = 0;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $result->score = 0;
            $result->user_id = Yii::$app->user->id;
            $result->save();
            $quizetime = Yii::$app->request->post('time');
            if ( ($quizetime + 30*60)!=time() && Model::loadMultiple($judgementforms, Yii::$app->request->post()) && Model::validateMultiple($judgementforms)) {
                $i = 0;
                foreach ($judgementforms as $judgementform) {
                    $judgementform->result_id = $result->id;
                    $judgementform->judgement_id = $shuffleIDs[$i]['id'];
                    if ($judgementform->judgement_answer == null){
                        $judgementform->judgement_answer = '0';
                    }
                    $judgementform->save();

                    if ($judgementform->judgement_answer == Judgement::findOne($shuffleIDs[$i]['id'])->answer){
                        $user_score = $user_score + Judgement::findOne($shuffleIDs[$i]['id'])->score;
                    }
                    $i++;
                }
                $result->score = $user_score;
                $result->save();
                $transaction->commit();
                $this->redirect(['simulate', 'id' => $result->id]);
            }else{
                return $this->render('_allJudgementform',[
                    'judgementforms' => $judgementforms,
                    'shuffleids' => $shuffleIDs,
                ]);
            }
        } catch (Exception $e){
                $transaction->rollBack();
        }
        return $this->render('_allJudgementform',[
            'judgementforms' => $judgementforms,
            'shuffleids' => $shuffleIDs,

        ]);
    }

    public function actionChoice()
    {
        Yii::$app->user->setReturnUrl(Yii::$app->request->referrer);
        $result =  new Result();
        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //////////////////////////////////////////////
        $queryID = Yii::$app->db->createCommand('SELECT id FROM test_choice')->queryAll();
        //打乱顺序
        shuffle($queryID);
        $how_mangChoice = 10;
        $shuffleIDs = array_slice($queryID,0,$how_mangChoice);

        $choiceforms = [new Choicepaper()];
        $count = count(Yii::$app->request->post('Choicepaper', []));
        for ($i = 0;$i < $how_mangChoice-1;$i++){
            $choiceforms[] = new Choicepaper();
            $choiceforms[$i]->choice_id = $shuffleIDs[$i]['id'];
            $choiceforms[$i]->result_id = $result->id;
        }
        $user_score = 0;
        $transaction = Yii::$app->db->beginTransaction();
try {
    $result->score = 0;
    $result->user_id = Yii::$app->user->id;
//    echo "<pre>"; print_r($result); echo "</pre>";
    $result->save();
        if (Model::loadMultiple($choiceforms, Yii::$app->request->post()) && Model::validateMultiple($choiceforms)) {

            $i = 0;
            foreach ($choiceforms as $choiceform) {
                $choiceform->result_id = $result->id;
                $choiceform->choice_id = $shuffleIDs[$i]['id'];
                if ($choiceform->choice_answer == null){
                    $choiceform->choice_answer = '0';
                }
                $choiceform->save();
                if ($choiceform->choice_answer == Choice::findOne($shuffleIDs[$i]['id'])->answer){
                    $user_score = $user_score + Choice::findOne($shuffleIDs[$i]['id'])->score;
                }
                $i++;
            }
            $result->score = $user_score;
            $result->save();
            $transaction->commit();
            $this->redirect(['simulate', 'id' => $result->id]);
        } else {
            return $this->render('_allChoiceform', [
                'choiceform' => $choiceforms,
                'result' => $result,
            ]);
        }


    }catch
    (Exception $e){
        $transaction->rollBack();
    }


        return $this->render('_allChoiceform', [
            'choiceform' => $choiceforms,
//            'modeltitle' => $choicequiz,
            'result' => $result,
        ]);


    }

    /**
     * Displays a single Result model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Result::findOne($id)->score>60){
            Yii::$app->session->setFlash('success',"恭喜您，考试通过");
        }else{
            Yii::$app->session->setFlash('error',"对不起，考试未通过,请继续努力");
        }
        return $this->render('quizer_view_result', [
            'model' => $this->findModel($id),
        ]);
    }
    //展示模拟测试的结果
    public function actionSimulate($id ){
        return $this->render('simulate_view_result', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new Result model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Result();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Result model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Result model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Result model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Result the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Result::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
