<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PemeriksaanIgd;

/**
 * PemeriksaanIgdSearch represents the model behind the search form of `common\models\PemeriksaanIgd`.
 */
class PemeriksaanIgdSearch extends PemeriksaanIgd
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idrawat', 'idkesadaran'], 'integer'],
            [['kodeperiksa', 'keluhanutama', 'rwpenyakit', 'td', 'nadi', 'pernapasan', 'suhu', 'ku_kepala', 'ku_leher', 'ku_tparu', 'ku_tjantung', 'abdomen', 'kulit', 'extremitas'], 'safe'],
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
        $query = PemeriksaanIgd::find();

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
            'idkesadaran' => $this->idkesadaran,
        ]);

        $query->andFilterWhere(['like', 'kodeperiksa', $this->kodeperiksa])
            ->andFilterWhere(['like', 'keluhanutama', $this->keluhanutama])
            ->andFilterWhere(['like', 'rwpenyakit', $this->rwpenyakit])
            ->andFilterWhere(['like', 'td', $this->td])
            ->andFilterWhere(['like', 'nadi', $this->nadi])
            ->andFilterWhere(['like', 'pernapasan', $this->pernapasan])
            ->andFilterWhere(['like', 'suhu', $this->suhu])
            ->andFilterWhere(['like', 'ku_kepala', $this->ku_kepala])
            ->andFilterWhere(['like', 'ku_leher', $this->ku_leher])
            ->andFilterWhere(['like', 'ku_tparu', $this->ku_tparu])
            ->andFilterWhere(['like', 'ku_tjantung', $this->ku_tjantung])
            ->andFilterWhere(['like', 'abdomen', $this->abdomen])
            ->andFilterWhere(['like', 'kulit', $this->kulit])
            ->andFilterWhere(['like', 'extremitas', $this->extremitas]);

        return $dataProvider;
    }
}
