<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tindakan;

/**
 * TindakanSearch represents the model behind the search form of `common\models\Tindakan`.
 */
class TindakanSearch extends Tindakan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idpoli'], 'integer'],
            [['namatindakan', 'kattindakan', 'ket'], 'safe'],
            [['tarif'], 'number'],
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
        $query = Tindakan::find();

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
            'idpoli' => $this->idpoli,
            'tarif' => $this->tarif,
        ]);

        $query->andFilterWhere(['like', 'namatindakan', $this->namatindakan])
            ->andFilterWhere(['like', 'kattindakan', $this->kattindakan])
            ->andFilterWhere(['like', 'ket', $this->ket]);

        return $dataProvider;
    }
}
