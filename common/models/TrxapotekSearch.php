<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Trxapotek;

/**
 * TrxapotekSearch represents the model behind the search form of `common\models\Trxapotek`.
 */
class TrxapotekSearch extends Trxapotek
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'total', 'idrawat', 'idlok'], 'integer'],
            [['idtrx', 'idbayar', 'status', 'koderawat', 'norm', 'tgl', 'tglresep', 'nama'], 'safe'],
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
    public function search($params, $where=null, $andWhere=null,$andWhere2=null, $andFilterWhere=null, $andFilterWhere2=null, $orderBy = null ,$groupBy=null)
    {
        $query = Trxapotek::find();

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
		if($where){
			$query->where($where);
		}
		
		if($andWhere){
			$query->andWhere($andWhere);
		}
        if($andWhere2){
            $query->andWhere($andWhere2);
        }
		
		if($andFilterWhere){
			$query->andFilterWhere($andFilterWhere);
		}
		
		if($andFilterWhere2){
			$query->andFilterWhere($andFilterWhere2);
		}
		
		if($orderBy){
			$query->orderBy($orderBy);
		}
		
		if($groupBy){
			$query->groupBy($groupBy);
		}

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'total' => $this->total,
            'idrawat' => $this->idrawat,
            'idlok' => $this->idlok,
            'tgl' => $this->tgl,
            'tglresep' => $this->tglresep,
        ]);

        $query->andFilterWhere(['like', 'idtrx', $this->idtrx])
            ->andFilterWhere(['like', 'idbayar', $this->idbayar])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'koderawat', $this->koderawat])
            ->andFilterWhere(['like', 'norm', $this->norm])
            ->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
