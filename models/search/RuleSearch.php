<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rule;

/**
 * RuleSearch represents the model behind the search form of `app\models\Rule`.
 */
class RuleSearch extends Rule
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'package', 'linking_mode', 'type', 'state', 'event', 'updu', 'ver'], 'integer'],
            [['name', 'description', 'updt'], 'safe'],
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
        $query = Rule::find();

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
            'package' => $this->package,
            'linking_mode' => $this->linking_mode,
            'type' => $this->type,
            'state' => $this->state,
            'event' => $this->event,
            'updu' => $this->updu,
            'updt' => $this->updt,
            'ver' => $this->ver,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }
}
