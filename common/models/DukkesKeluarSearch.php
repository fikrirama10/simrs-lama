<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DukkesKeluar;

/**
 * DukkesKeluarSearch represents the model behind the search form of `common\models\DukkesKeluar`.
 */
class DukkesKeluarSearch extends DukkesKeluar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'iduser'], 'integer'],
            [['kodetrx', 'tgl', 'keterangan', 'kegiatan'], 'safe'],
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
        $query = DukkesKeluar::find();

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
            'tgl' => $this->tgl,
            'iduser' => $this->iduser,
        ]);

        $query->andFilterWhere(['like', 'kodetrx', $this->kodetrx])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'kegiatan', $this->kegiatan]);

        return $dataProvider;
    }
}
