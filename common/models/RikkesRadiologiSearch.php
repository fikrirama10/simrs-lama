<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RikkesRadiologi;

/**
 * RikkesRadiologiSearch represents the model behind the search form of `common\models\RikkesRadiologi`.
 */
class RikkesRadiologiSearch extends RikkesRadiologi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['namakegiatan', 'tanggal', 'keterangan', 'jenis'], 'safe'],
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
        $query = RikkesRadiologi::find();

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
        ]);

        $query->andFilterWhere(['like', 'namakegiatan', $this->namakegiatan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'jenis', $this->jenis]);

        return $dataProvider;
    }
}
