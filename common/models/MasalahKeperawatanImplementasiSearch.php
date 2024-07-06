<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MasalahKeperawatanImplementasi;

/**
 * MasalahKeperawatanImplementasiSearch represents the model behind the search form of `common\models\MasalahKeperawatanImplementasi`.
 */
class MasalahKeperawatanImplementasiSearch extends MasalahKeperawatanImplementasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idrawat', 'iduser', 'idimplementasi'], 'integer'],
            [['jam', 'tanggal', 'implementasi', 'keterangan'], 'safe'],
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
        $query = MasalahKeperawatanImplementasi::find();

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
            'iduser' => $this->iduser,
            'jam' => $this->jam,
            'tanggal' => $this->tanggal,
            'idimplementasi' => $this->idimplementasi,
        ]);

        $query->andFilterWhere(['like', 'implementasi', $this->implementasi])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
