<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pelab;

/**
 * PelabSearch represents the model behind the search form of `common\models\Pelab`.
 */
class PelabSearch extends Pelab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jenispemeriksaan'], 'integer'],
            [['tgl', 'rm', 'jamdiambil', 'jamhasil'], 'safe'],
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
        $query = Pelab::find();

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
            'tgl' => $this->tgl,
            'jenispemeriksaan' => $this->jenispemeriksaan,
            'jamdiambil' => $this->jamdiambil,
            'jamhasil' => $this->jamhasil,
        ]);

        $query->andFilterWhere(['like', 'rm', $this->rm]);

        return $dataProvider;
    }
}
