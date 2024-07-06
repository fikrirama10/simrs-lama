<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Indirawat;

/**
 * IndirawatSearch represents the model behind the search form of `common\models\Indirawat`.
 */
class IndirawatSearch extends Indirawat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dpjptcp', 'pkmcp', 'verived'], 'integer'],
            [['no_rekmed', 'diagnosa', 'tanggal'], 'safe'],
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
        $query = Indirawat::find();

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
            'dpjptcp' => $this->dpjptcp,
            'pkmcp' => $this->pkmcp,
            'tanggal' => $this->tanggal,
            'verived' => $this->verived,
        ]);

        $query->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'diagnosa', $this->diagnosa]);

        return $dataProvider;
    }
}
