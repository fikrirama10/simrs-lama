<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tarif;

/**
 * TarifSearch represents the model behind the search form of `common\models\Tarif`.
 */
class TarifSearch extends Tarif
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tarif', 'idjenis', 'status'], 'integer'],
            [['nama', 'ket', 'kode_tarif'], 'safe'],
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
        $query = Tarif::find();

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
            'tarif' => $this->tarif,
            'idjenis' => $this->idjenis,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'ket', $this->ket])
            ->andFilterWhere(['like', 'kode_tarif', $this->kode_tarif]);

        return $dataProvider;
    }
}
