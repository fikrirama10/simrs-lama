<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Aidobc;

/**
 * AidobcSearch represents the model behind the search form of `common\models\Aidobc`.
 */
class AidobcSearch extends Aidobc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cukurclipper', 'waktucukur', 'mandi', 'antibiotic', 'tdkinfeksi', 'kontrolgula'], 'integer'],
            [['no_rekmed', 'tanggal'], 'safe'],
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
        $query = Aidobc::find();

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
            'cukurclipper' => $this->cukurclipper,
            'waktucukur' => $this->waktucukur,
            'mandi' => $this->mandi,
            'antibiotic' => $this->antibiotic,
            'tdkinfeksi' => $this->tdkinfeksi,
            'kontrolgula' => $this->kontrolgula,
        ]);

        $query->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed]);

        return $dataProvider;
    }
}
