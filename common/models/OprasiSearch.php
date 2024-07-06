<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Oprasi;

/**
 * OprasiSearch represents the model behind the search form of `common\models\Oprasi`.
 */
class OprasiSearch extends Oprasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['status', 'idoprasi', 'idrawat', 'no_rekmed', 'catatan', 'tanggal', 'jenisoprasi'], 'safe'],
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
        $query = Oprasi::find();

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
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'idoprasi', $this->idoprasi])
            ->andFilterWhere(['like', 'idrawat', $this->idrawat])
            ->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'jenisoprasi', $this->jenisoprasi]);

        return $dataProvider;
    }
}
