<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Lab;

/**
 * LabSearch represents the model behind the search form of `common\models\Lab`.
 */
class LabSearch extends Lab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idpengirim', 'idtkp', 'idjenisp', 'idpemeriksa', 'status'], 'integer'],
            [['no_rekmed', 'hasil', 'idrawat', 'tanggal_req', 'tgl_peniksa'], 'safe'],
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
    public function search($params, $where=null, $andWhere=null, $andFilterWhere=null, $andFilterWhere2=null, $orderBy = null,$groupBy = null)
    {
        $query = Lab::find()->groupBy(['idrawat']);
       
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
		
		if($andFilterWhere){
			$query->andFilterWhere($andFilterWhere);
		}
		
		if($andFilterWhere2){
			$query->andFilterWhere($andFilterWhere2);
		}
		
		if($orderBy){
			$query->orderBy($orderBy);
		}

		

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idpengirim' => $this->idpengirim,
            'idtkp' => $this->idtkp,
            'idjenisp' => $this->idjenisp,
            'idpemeriksa' => $this->idpemeriksa,
            'tanggal_req' => $this->tanggal_req,
            'tgl_peniksa' => $this->tgl_peniksa,
            'status' => $this->status,
        ]);
	

        $query->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'hasil', $this->hasil])
            ->andFilterWhere(['like', 'idrawat', $this->idrawat]);
	
		
        return $dataProvider;
    }
}
