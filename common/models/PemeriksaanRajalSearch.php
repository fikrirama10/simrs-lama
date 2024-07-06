<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PemeriksaanRajal;

/**
 * PemeriksaanRajalSearch represents the model behind the search form of `common\models\PemeriksaanRajal`.
 */
class PemeriksaanRajalSearch extends PemeriksaanRajal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idrawat', 'idpoli', 'iddokter'], 'integer'],
            [['suhu', 'respirasi', 'nadi', 'td', 'diagnosa', 'tanggal', 'tindakan', 'obat', 'lab', 'radiologi', 'pemeriksaan'], 'safe'],
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
        $query = PemeriksaanRajal::find();

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
            'idpoli' => $this->idpoli,
            'iddokter' => $this->iddokter,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'suhu', $this->suhu])
            ->andFilterWhere(['like', 'respirasi', $this->respirasi])
            ->andFilterWhere(['like', 'nadi', $this->nadi])
            ->andFilterWhere(['like', 'td', $this->td])
            ->andFilterWhere(['like', 'diagnosa', $this->diagnosa])
            ->andFilterWhere(['like', 'tindakan', $this->tindakan])
            ->andFilterWhere(['like', 'obat', $this->obat])
            ->andFilterWhere(['like', 'lab', $this->lab])
            ->andFilterWhere(['like', 'radiologi', $this->radiologi])
            ->andFilterWhere(['like', 'pemeriksaan', $this->pemeriksaan]);

        return $dataProvider;
    }
}
