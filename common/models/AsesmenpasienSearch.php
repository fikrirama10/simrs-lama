<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Asesmenpasien;

/**
 * AsesmenpasienSearch represents the model behind the search form of `common\models\Asesmenpasien`.
 */
class AsesmenpasienSearch extends Asesmenpasien
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'anamesisi', 'ass_psiko', 'rx_fisik', 'penunjang', 'diagnosis', 'rencanaasuhan', 'evaluasi',  'ttd'], 'integer'],
            [['no_rekmed'], 'safe'],
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
        $query = Asesmenpasien::find();

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
            'anamesisi' => $this->anamesisi,
            'ass_psiko' => $this->ass_psiko,
            'rx_fisik' => $this->rx_fisik,
            'penunjang' => $this->penunjang,
            'diagnosis' => $this->diagnosis,
            'rencanaasuhan' => $this->rencanaasuhan,
            'evaluasi' => $this->evaluasi,
            'ttd' => $this->ttd,
        ]);

        $query->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed]);

        return $dataProvider;
    }
}
