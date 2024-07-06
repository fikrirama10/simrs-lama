<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Kesalahanobat;

/**
 * KesalahanobatSearch represents the model behind the search form of `common\models\Kesalahanobat`.
 */
class KesalahanobatSearch extends Kesalahanobat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jumlahjenis', 'bentuksediaan', 'dosis', 'aturan', 'komposisi'], 'integer'],
            [['tanggal', 'rm', 'kesalahan'], 'safe'],
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
        $query = Kesalahanobat::find();

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
            'jumlahjenis' => $this->jumlahjenis,
            'bentuksediaan' => $this->bentuksediaan,
            'dosis' => $this->dosis,
            'aturan' => $this->aturan,
            'komposisi' => $this->komposisi,
        ]);

        $query->andFilterWhere(['like', 'rm', $this->rm])
            ->andFilterWhere(['like', 'kesalahan', $this->kesalahan]);

        return $dataProvider;
    }
}
