<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Usgdetail;

/**
 * UsgdetailSearch represents the model behind the search form of `common\models\Usgdetail`.
 */
class UsgdetailSearch extends Usgdetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idpemeriksaan', 'status'], 'integer'],
            [['idusg', 'klinis', 'hasil', 'tgl', 'nousg'], 'safe'],
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
        $query = Usgdetail::find();

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
            'idpemeriksaan' => $this->idpemeriksaan,
            'tgl' => $this->tgl,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'idusg', $this->idusg])
            ->andFilterWhere(['like', 'klinis', $this->klinis])
            ->andFilterWhere(['like', 'hasil', $this->hasil])
            ->andFilterWhere(['like', 'nousg', $this->nousg]);

        return $dataProvider;
    }
}
