<?php
/**
 * Created by PhpStorm.
 * User: gang
 * Date: 2018/5/4
 * Time: 上午12:16
 */



namespace api\controllers;

use frontend\models\User;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\rest\ActiveController;


class UserapiController extends ActiveController
{

    public $modelClass = "frontend\models\User";


//    public function actionIndex()
//    {
//        $top10 = (new Query())
//            ->from('article')
//            ->select(['created_by','Count(id) as creatercount'])
//            ->groupBy(['created_by'])
//            ->orderBy('creatercount DESC')
//            ->all();
//
//        return $top10;
//
//    }


    public function actionFindexit()
    {
//        print_r($_POST['openid']);
        $open = \Yii::$app->request->post('openid');
        $exit = User::find()->where(['openid' => $open])->one();
        return $exit?$exit:null;
    }


}