<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Judgementpaper;

/**
 * JudgementpaperSearch represents the model behind the search form about `common\models\Judgementpaper`.
 */
class JudgementpaperSearch extends Judgementpaper
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'result_id', 'judgement_id', 'test_time'], 'integer'],
            [['judgement_answer'], 'safe'],
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
        $query = Judgementpaper::find();

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
            'result_id' => $this->result_id,
            'judgement_id' => $this->judgement_id,
            'test_time' => $this->test_time,
        ]);

        $query->andFilterWhere(['like', 'judgement_answer', $this->judgement_answer]);

        return $dataProvider;
    }
}
