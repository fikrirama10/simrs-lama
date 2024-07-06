<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mcutni;

/**
 * McutniSearch represents the model behind the search form of `common\models\Mcutni`.
 */
class McutniSearch extends Mcutni
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usia'], 'integer'],
            [['nama', 'nofoto', 'notes'], 'safe'],
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
        $query = Mcutni::find()->orderBy(['id'=>SORT_DESC]);

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
            'usia' => $this->usia,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'nofoto', $this->nofoto])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
