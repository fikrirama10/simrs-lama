<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PemeriksaanRanap;

/**
 * PemeriksaanRanapSearch represents the model behind the search form of `common\models\PemeriksaanRanap`.
 */
class PemeriksaanRanapSearch extends PemeriksaanRanap
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idrawat', 'perawat'], 'integer'],
            [['tanggal', 'td', 'nadi', 'respirasi', 'suhu', 'keadaanumum', 'keadaanfisik', 'status'], 'safe'],
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
        $query = PemeriksaanRanap::find();

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
            'idrawat' => $this->idrawat,
            'tanggal' => $this->tanggal,
            'perawat' => $this->perawat,
        ]);

        $query->andFilterWhere(['like', 'td', $this->td])
            ->andFilterWhere(['like', 'nadi', $this->nadi])
            ->andFilterWhere(['like', 'respirasi', $this->respirasi])
            ->andFilterWhere(['like', 'suhu', $this->suhu])
            ->andFilterWhere(['like', 'keadaanumum', $this->keadaanumum])
            ->andFilterWhere(['like', 'keadaanfisik', $this->keadaanfisik])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
