<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PermintaanBarang;

/**
 * PermintaanBarangSearch represents the model behind the search form of `common\models\PermintaanBarang`.
 */
class PermintaanBarangSearch extends PermintaanBarang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'total', 'status', 'jenis'], 'integer'],
            [['idpermintaan', 'tanggal'], 'safe'],
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
        $query = PermintaanBarang::find();

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
            'total' => $this->total,
            'status' => $this->status,
            'jenis' => $this->jenis,
        ]);

        $query->andFilterWhere(['like', 'idpermintaan', $this->idpermintaan]);

        return $dataProvider;
    }
}
