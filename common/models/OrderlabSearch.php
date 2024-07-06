<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Orderlab;

/**
 * OrderlabSearch represents the model behind the search form of `common\models\Orderlab`.
 */
class OrderlabSearch extends Orderlab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idpengirim', 'idtkp', 'idpemeriksa'], 'integer'],
            [['kodelab', 'no_rekmed', 'idrawat', 'tgl_order'], 'safe'],
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
        $query = Orderlab::find()->joinWith(['rawat as rawat'])->where(['rawat.idbayar'=>5])->orderby(['tgl_order'=>SORT_DESC]);

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
            'idpengirim' => $this->idpengirim,
            'idtkp' => $this->idtkp,
            'idpemeriksa' => $this->idpemeriksa,
            'tgl_order' => $this->tgl_order,
        ]);

        $query->andFilterWhere(['like', 'kodelab', $this->kodelab])
            ->andFilterWhere(['like', 'rawat.no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'idrawat', $this->idrawat]);

        return $dataProvider;
    }
}
