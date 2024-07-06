<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Rekamedis;

/**
 * RekamedisSearch represents the model behind the search form of `common\models\Rekamedis`.
 */
class RekamedisSearch extends Rekamedis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'iddokter', 'bulan'], 'integer'],
            [['no_rekmed', 'idrawat', 'tglpinjam', 'peminjam'], 'safe'],
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
        $query = Rekamedis::find();

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
            'iddokter' => $this->iddokter,
            'bulan' => $this->bulan,
            'tglpinjam' => $this->tglpinjam,
        ]);

        $query->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'idrawat', $this->idrawat])
            ->andFilterWhere(['like', 'peminjam', $this->peminjam]);

        return $dataProvider;
    }
}
