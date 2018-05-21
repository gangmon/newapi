<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Choice;

/**
 * ChoiceSearch represents the model behind the search form about `common\models\Choice`.
 */
class ChoiceSearch extends Choice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'admin_id', 'score', 'create_time', 'update_time'], 'integer'],
            [['answer', 'title', 'A', 'B', 'C', 'D', 'difficulty'], 'safe'],
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
        $query = Choice::find();

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
            'admin_id' => $this->admin_id,
            'score' => $this->score,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'A', $this->A])
            ->andFilterWhere(['like', 'B', $this->B])
            ->andFilterWhere(['like', 'C', $this->C])
            ->andFilterWhere(['like', 'D', $this->D])
            ->andFilterWhere(['like', 'difficulty', $this->difficulty]);

        return $dataProvider;
    }
}
