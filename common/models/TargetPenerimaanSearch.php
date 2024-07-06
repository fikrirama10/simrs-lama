<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TargetPenerimaan;

/**
 * TargetPenerimaanSearch represents the model behind the search form of `common\models\TargetPenerimaan`.
 */
class TargetPenerimaanSearch extends TargetPenerimaan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'iduser'], 'integer'],
            [['kodetarget', 'tahun', 'bulan', 'created'], 'safe'],
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
        $query = TargetPenerimaan::find();

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
            'iduser' => $this->iduser,
            'tahun' => $this->tahun,
            'bulan' => $this->bulan,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'kodetarget', $this->kodetarget]);

        return $dataProvider;
    }
}
