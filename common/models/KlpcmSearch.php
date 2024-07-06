<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Klpcm;

/**
 * KlpcmSearch represents the model behind the search form of `common\models\Klpcm`.
 */
class KlpcmSearch extends Klpcm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dpjp', 'ruangan', 'ket','idpoli'], 'integer'],
            [['no_rekmed', 'nama', 'tdklengkap', 'jform', 'tanggal'], 'safe'],
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
    public function search($params, $where=null, $andWhere=null,$andWhere2=null,$andWhereTgl=null, $andFilterWhere=null, $andFilterWhere2=null, $orderBy = null ,$groupBy=null)
    {
        $query = Klpcm::find();

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
            'idpoli'=>$this->idpoli,
            'dpjp' => $this->dpjp,
            'ruangan' => $this->ruangan,
            'ket' => $this->ket,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tdklengkap', $this->tdklengkap])
            ->andFilterWhere(['like', 'jform', $this->jform]);

        return $dataProvider;
    }
}
