<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Rencanaok;

/**
 * RencanaokSearch represents the model behind the search form of `common\models\Rencanaok`.
 */
class RencanaokSearch extends Rencanaok
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'iddokrer'], 'integer'],
            [['no_rekmed', 'tanggalperiksa', 'jadwaloprasi', 'diagnosa', 'idrawat'], 'safe'],
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
        $query = Rencanaok::find();

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
            'tanggalperiksa' => $this->tanggalperiksa,
            'jadwaloprasi' => $this->jadwaloprasi,
            'status' => $this->status,
            'iddokrer' => $this->iddokrer,
        ]);

        $query->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'diagnosa', $this->diagnosa])
            ->andFilterWhere(['like', 'idrawat', $this->idrawat]);

        return $dataProvider;
    }
}
