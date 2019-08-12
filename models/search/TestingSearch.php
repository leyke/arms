<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Testing;

/**
 * TestingSearch represents the model behind the search form of `app\models\Testing`.
 */
class TestingSearch extends Testing
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updu', 'ver', 'description'], 'integer'],
            [['name', 'date_on', 'date_of', 'events_buf', 'updt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Testing::find();

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
            'date_on' => $this->date_on,
            'date_of' => $this->date_of,
            'updu' => $this->updu,
            'updt' => $this->updt,
            'ver' => $this->ver,
            'description' => $this->description,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'events_buf', $this->events_buf]);

        return $dataProvider;
    }
}
