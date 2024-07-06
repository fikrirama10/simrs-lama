<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ert;

/**
 * ErtSearch represents the model behind the search form of `common\models\Ert`.
 */
class ErtSearch extends Ert
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usia', 'idvalidator', 'sesuai'], 'integer'],
            [['tanggal', 'no_rekmed', 'diagnosa', 'jamdatang', 'idrawat', 'jamdilayani'], 'safe'],
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
    public function search($params, $where=null, $andWhere=null,$andWhere2=null, $andFilterWhere=null, $andFilterWhere2=null, $orderBy = null)
    {
        $query = Ert::find();

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


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'usia' => $this->usia,
            'jamdatang' => $this->jamdatang,
            'idvalidator' => $this->idvalidator,
            'jamdilayani' => $this->jamdilayani,
            'sesuai' => $this->sesuai,
        ]);

        $query->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'diagnosa', $this->diagnosa])
            ->andFilterWhere(['like', 'idrawat', $this->idrawat]);

        return $dataProvider;
    }
}
