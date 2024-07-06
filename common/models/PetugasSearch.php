<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Petugas;

/**
 * PetugasSearch represents the model behind the search form about `common\models\Petugas`.
 */
class PetugasSearch extends Petugas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'alamat'], 'integer'],
            [['kode_petugas', 'nama_petugas', 'nohp', 'jk', 'foto'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Petugas::find();

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
            'alamat' => $this->alamat,
        ]);

        $query->andFilterWhere(['like', 'kode_petugas', $this->kode_petugas])
            ->andFilterWhere(['like', 'nama_petugas', $this->nama_petugas])
            ->andFilterWhere(['like', 'nohp', $this->nohp])
            ->andFilterWhere(['like', 'jk', $this->jk])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
