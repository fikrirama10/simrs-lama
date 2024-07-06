<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Jadwaloprasi;

/**
 * JadwaloprasiSearch represents the model behind the search form of `common\models\Jadwaloprasi`.
 */
class JadwaloprasiSearch extends Jadwaloprasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idpoli', 'terlaksana', 'idbayar'], 'integer'],
            [['kodebooking', 'no_rekmed', 'nobpjs', 'tglpelaksanaan', 'jenistindakan'], 'safe'],
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
        $query = Jadwaloprasi::find();

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
            'tglpelaksanaan' => $this->tglpelaksanaan,
            'idpoli' => $this->idpoli,
            'terlaksana' => $this->terlaksana,
            'idbayar' => $this->idbayar,
        ]);

        $query->andFilterWhere(['like', 'kodebooking', $this->kodebooking])
            ->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'nobpjs', $this->nobpjs])
            ->andFilterWhere(['like', 'jenistindakan', $this->jenistindakan]);

        return $dataProvider;
    }
}
