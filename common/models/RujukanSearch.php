<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Rujukan;

/**
 * RujukanSearch represents the model behind the search form of `common\models\Rujukan`.
 */
class RujukanSearch extends Rujukan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usia'], 'integer'],
            [['kode', 'no_rekmed', 'nama', 'jk', 'penjamin', 'diagnosa', 'kebutuhan', 'waktu'], 'safe'],
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
        $query = Rujukan::find()->orderBy(['id'=>SORT_DESC]);

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
            'waktu' => $this->waktu,
        ]);

        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jk', $this->jk])
            ->andFilterWhere(['like', 'penjamin', $this->penjamin])
            ->andFilterWhere(['like', 'diagnosa', $this->diagnosa])
            ->andFilterWhere(['like', 'kebutuhan', $this->kebutuhan]);

        return $dataProvider;
    }
}
