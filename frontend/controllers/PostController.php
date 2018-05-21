<?php

namespace frontend\controllers;

use common\models\Comment;
use common\models\User;
use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
        ];
    }

    /**

     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $tags = Post::findTagsWeight();
        $recentComments = Post::findRecentComment();


        return $this->render('indexall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tags' => $tags,
            'recentComments' => $recentComments,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
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
     * Deletes an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public $added = 0;
    public function actionDetail($id)
    {
        //prepare data Model

        $model = $this->findModel($id);
        $model->times = $model->times + 1;
        $model->update();
        $tags = $model->tags;
        $recentComments = Comment::findRecentComments();
        $userMe = User::findOne(Yii::$app->user->id);
        $commentModel = new Comment();

        if ($commentModel->load(Yii::$app->request->post() ))
        {
            if (is_null(Yii::$app->user->id))
            {
                 return $this->redirect(['site/login']);
            }

            $commentModel->email = $userMe->email;
            $commentModel->user_id = $userMe->id;
            $commentModel->status = "已审核";//新评论默认状态
            $commentModel->post_id = $model->id;
            $commentModel->user_id = Yii::$app->user->id;
            $commentModel->remind = 0;
            if ($commentModel->save() )
            {
            $this->added=1;
            }

        }
        $tags = Post::findTagsWeight();
        $recentComments = Post::findRecentComment();

        return $this->render('detail',[
            'model' => $model,
            'tags' => $tags,
            'recentComments' => $recentComments,
            'commentModel' => $commentModel,
            'added' => $this->added,
            'tags' => $tags,
            'recentComments' => $recentComments,
        ]);




    }
}
