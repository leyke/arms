<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Action;

/**
 * ActionSearch represents the model behind the search form of `app\models\Action`.
 */
class ActionSearch extends Action
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'context', 'updu', 'ver'], 'integer'],
            [['script', 'description', 'updt'], 'safe'],
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
        $query = Action::find();

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
            'context' => $this->context,
            'updu' => $this->updu,
            'updt' => $this->updt,
            'ver' => $this->ver,
        ]);

        $query->andFilterWhere(['ilike', 'script', $this->script])
            ->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }
}
