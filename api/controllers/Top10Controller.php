<?php
namespace api\controllers;

use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\rest\Controller;
use common\models\Article;

class Top10Controller extends Controller
{


    public function actionIndex()
    {
        $top10 = (new Query())
            ->from('article')
            ->select(['created_by','Count(id) as creatercount'])
            ->groupBy(['created_by'])
            ->orderBy('creatercount DESC')
            ->all();

        return $top10;

    }


}