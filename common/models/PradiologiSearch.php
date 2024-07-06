<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pradiologi;

/**
 * PradiologiSearch represents the model behind the search form of `common\models\Pradiologi`.
 */
class PradiologiSearch extends Pradiologi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jenispemeriksaan'], 'integer'],
            [['tanggal', 'jamdiambil', 'jamhasil', 'durasi', 'no_rekmed'], 'safe'],
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
    public function search($params, $where=null, $andWhere=null, $andFilterWhere=null, $andFilterWhere2=null, $orderBy = null)
    {
        $query = Pradiologi::find();

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
            'tanggal' => $this->tanggal,
            'jamdiambil' => $this->jamdiambil,
            'jamhasil' => $this->jamhasil,
            'durasi' => $this->durasi,
            'jenispemeriksaan' => $this->jenispemeriksaan,
        ]);

        $query->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed]);

        return $dataProvider;
    }
}
