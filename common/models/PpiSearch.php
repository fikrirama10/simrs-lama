<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ppi;

/**
 * PpiSearch represents the model behind the search form of `common\models\Ppi`.
 */
class PpiSearch extends Ppi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ipcln'], 'integer'],
            [['momen1', 'momen2', 'momen3', 'momen4', 'momen5', 'unit', 'person'], 'safe'],
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
        $query = Ppi::find();

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
            'ipcln' => $this->ipcln,
        ]);

        $query->andFilterWhere(['like', 'momen1', $this->momen1])
            ->andFilterWhere(['like', 'momen2', $this->momen2])
            ->andFilterWhere(['like', 'momen3', $this->momen3])
            ->andFilterWhere(['like', 'momen4', $this->momen4])
            ->andFilterWhere(['like', 'momen5', $this->momen5])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'person', $this->person]);

        return $dataProvider;
    }
}
