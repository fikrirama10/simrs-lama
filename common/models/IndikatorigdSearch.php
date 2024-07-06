<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Indikatorigd;

/**
 * IndikatorigdSearch represents the model behind the search form of `common\models\Indikatorigd`.
 */
class IndikatorigdSearch extends Indikatorigd
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bls', 'ppgd', 'gels', 'als', 'ket'], 'integer'],
            [['namapetugas', 'blsterbit', 'blshabis', 'ppgdterbit', 'ppgdhabis', 'gelsterbit', 'gelshabis', 'alsterbit', 'alshabis'], 'safe'],
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
        $query = Indikatorigd::find();

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
            'bls' => $this->bls,
            'blsterbit' => $this->blsterbit,
            'blshabis' => $this->blshabis,
            'ppgd' => $this->ppgd,
            'ppgdterbit' => $this->ppgdterbit,
            'ppgdhabis' => $this->ppgdhabis,
            'gels' => $this->gels,
            'gelsterbit' => $this->gelsterbit,
            'gelshabis' => $this->gelshabis,
            'als' => $this->als,
            'alsterbit' => $this->alsterbit,
            'alshabis' => $this->alshabis,
            'ket' => $this->ket,
        ]);

        $query->andFilterWhere(['like', 'namapetugas', $this->namapetugas]);

        return $dataProvider;
    }
}
