<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pengeluaran;

/**
 * PengeluaranSearch represents the model behind the search form of `common\models\Pengeluaran`.
 */
class PengeluaranSearch extends Pengeluaran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'biaya', 'casier'], 'integer'],
            [['trxid', 'nama', 'jabatan', 'keterangan', 'tanggal'], 'safe'],
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
        $query = Pengeluaran::find();

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
            'biaya' => $this->biaya,
            'casier' => $this->casier,
        ]);

        $query->andFilterWhere(['like', 'trxid', $this->trxid])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jabatan', $this->jabatan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
