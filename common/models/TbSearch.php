<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tb;

/**
 * TbSearch represents the model behind the search form of `common\models\Tb`.
 */
class TbSearch extends Tb
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usia'], 'integer'],
            [['no_rm', 'nama', 'tgl_lahir', 'berat_badan', 'tinggi_badan', 'ktp', 'bpjs', 'no_hp', 'jenis_pasien'], 'safe'],
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
        $query = Tb::find();

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
            'usia' => $this->usia,
            'tgl_lahir' => $this->tgl_lahir,
        ]);

        $query->andFilterWhere(['like', 'no_rm', $this->no_rm])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'berat_badan', $this->berat_badan])
            ->andFilterWhere(['like', 'tinggi_badan', $this->tinggi_badan])
            ->andFilterWhere(['like', 'ktp', $this->ktp])
            ->andFilterWhere(['like', 'bpjs', $this->bpjs])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'jenis_pasien', $this->jenis_pasien]);

        return $dataProvider;
    }
}
