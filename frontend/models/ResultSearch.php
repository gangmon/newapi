<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Result;
use common\models\User;
/**
 * ResultSearch represents the model behind the search form about `frontend\models\Result`.
 */
class ResultSearch extends Result
{
    public function attributes()
    {
        return array_merge(parent::attributes(),['quizName']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_real'], 'safe'],
            [['id', 'user_id', 'score', 'create_time'], 'integer'],
            [['quizName'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Result::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'score' => $this->score,
            'create_time' => $this->create_time,
        ]);

        $query->join('INNER JOIN',User::tableName(),'user_id = test_user.id');
        $query->andFilterWhere(['like','test_user.username',$this->quizName]);

        $query->andFilterWhere(['like', 'is_real', $this->is_real]);

        $dataProvider->sort->attributes['quizName'] =
            [
                'asc'=>['test_user.username'=>SORT_ASC],
                'desc'=>['test_user.username'=>SORT_DESC],
            ];
        return $dataProvider;
    }
}
