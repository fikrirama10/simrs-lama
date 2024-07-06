<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Daftaronline;

/**
 * DaftaronlineSearch represents the model behind the search form of `common\models\Daftaronline`.
 */
class DaftaronlineSearch extends Daftaronline
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idpoli', 'kuota', 'user'], 'integer'],
            [['tanggal'], 'safe'],
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
        $query = Daftaronline::find();

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
            'kuota' => $this->kuota,
            'user' => $this->user,
            'tanggal' => $this->tanggal,
        ]);

        return $dataProvider;
    }
}
