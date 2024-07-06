<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Radiologi;
use yii\db\Expression;
/**
 * RadiologiSearch represents the model behind the search form of `common\models\Radiologi`.
 */
class RadiologiSearch extends Radiologi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idpengirim', 'idpemeriksa', 'status'], 'integer'],
            [['no_rekmed'], 'string'],
            [['idrad', 'tanggal'], 'safe'],
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
        $query = Radiologi::find()->joinWith('rawatjalan as rawat')->where(['between','rawat.idbayar',5,5])->orderby(['tanggal'=>SORT_DESC]);

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
            'idpemeriksa' => $this->idpemeriksa,
            'tanggal' => $this->tanggal,
            'no_rekmed' => $this->no_rekmed,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'idrad', $this->idrad]);

        return $dataProvider;
    }
}
