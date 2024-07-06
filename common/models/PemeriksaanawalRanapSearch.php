<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PemeriksaanawalRanap;

/**
 * PemeriksaanawalRanapSearch represents the model behind the search form of `common\models\PemeriksaanawalRanap`.
 */
class PemeriksaanawalRanapSearch extends PemeriksaanawalRanap
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idrawat', 'dokterpengirim', 'status'], 'integer'],
            [['anamnesa', 'kesadaran', 'fisik', 'suhu', 'td', 'respirasi', 'nadi', 'diagnosa_awal', 'diagnosa_akhir', 'jam_masuk'], 'safe'],
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
        $query = PemeriksaanawalRanap::find();

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
            'dokterpengirim' => $this->dokterpengirim,
            'jam_masuk' => $this->jam_masuk,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'anamnesa', $this->anamnesa])
            ->andFilterWhere(['like', 'kesadaran', $this->kesadaran])
            ->andFilterWhere(['like', 'fisik', $this->fisik])
            ->andFilterWhere(['like', 'suhu', $this->suhu])
            ->andFilterWhere(['like', 'td', $this->td])
            ->andFilterWhere(['like', 'respirasi', $this->respirasi])
            ->andFilterWhere(['like', 'nadi', $this->nadi])
            ->andFilterWhere(['like', 'diagnosa_awal', $this->diagnosa_awal])
            ->andFilterWhere(['like', 'diagnosa_akhir', $this->diagnosa_akhir]);

        return $dataProvider;
    }
}
