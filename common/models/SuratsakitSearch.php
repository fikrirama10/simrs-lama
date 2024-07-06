<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Suratsakit;

/**
 * SuratsakitSearch represents the model behind the search form of `common\models\Suratsakit`.
 */
class SuratsakitSearch extends Suratsakit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nomor', 'nama', 'usia', 'perusahaan', 'tanggal', 'sampai', 'dari', 'no_rekmed'], 'safe'],
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
        $query = Suratsakit::find()->orderby(['id'=>SORT_DESC]);

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
            'sampai' => $this->sampai,
            'dari' => $this->dari,
        ]);

        $query->andFilterWhere(['like', 'nomor', $this->nomor])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'usia', $this->usia])
            ->andFilterWhere(['like', 'perusahaan', $this->perusahaan])
            ->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed]);

        return $dataProvider;
    }
}
