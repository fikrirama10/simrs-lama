<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PemeriksaanRanapVisite;

/**
 * PemeriksaanRanapVisiteSearch represents the model behind the search form of `common\models\PemeriksaanRanapVisite`.
 */
class PemeriksaanRanapVisiteSearch extends PemeriksaanRanapVisite
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idrawat', 'iddokter'], 'integer'],
            [['pemeriksaan_dokter', 'tanggal', 'catatan'], 'safe'],
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
        $query = PemeriksaanRanapVisite::find();

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
            'iddokter' => $this->iddokter,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'pemeriksaan_dokter', $this->pemeriksaan_dokter])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
