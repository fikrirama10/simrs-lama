<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ApotekUnit;

/**
 * ApotekUnitSearch represents the model behind the search form of `common\models\ApotekUnit`.
 */
class ApotekUnitSearch extends ApotekUnit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idtrx', 'iduser', 'status'], 'integer'],
            [['unit', 'tanggal', 'nama'], 'safe'],
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
        $query = ApotekUnit::find();

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
            'idtrx' => $this->idtrx,
            'tanggal' => $this->tanggal,
            'iduser' => $this->iduser,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
