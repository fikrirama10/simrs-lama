<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Rawatjalan;

/**
 * RawatjalanSearch represents the model behind the search form about `common\models\Rawatjalan`.
 */
class RawatjalanSearch extends Rawatjalan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'iddokter', 'idpoli', 'idbayar','status','batal'], 'integer'],
            [['idrawat','no_rekmed', 'tgldaftar', 'penanggung', 'alamat_penanggung', 'hubungan', 'notlp','kdiagnosa'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
    public function search($params, $where=null, $andWhere=null,$andWhere2=null, $andWhere3=null,$andWhere4=null, $andFilterWhere=null, $andFilterWhere2=null, $orderBy = null ,$groupBy=null)
    {
        $query = Rawatjalan::find()->orderBy(['tgldaftar'=>SORT_DESC]);

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
		if($andWhere3){
			$query->andWhere($andWhere3);
		}
		if($andWhere4){
			$query->andWhere($andWhere4);
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
            'idrawat' => $this->idrawat,
            'iddokter' => $this->iddokter,
            'idpoli' => $this->idpoli,
            'idbayar' => $this->idbayar,
            'no_rekmed' => $this->no_rekmed,
            //'iddiagnosa' => $this->iddiagnosa,
            'tgldaftar' => $this->tgldaftar,
			'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'penanggung', $this->penanggung])
            ->andFilterWhere(['like', 'alamat_penanggung', $this->alamat_penanggung])
            ->andFilterWhere(['like', 'hubungan', $this->hubungan])
            ->andFilterWhere(['like', 'notlp', $this->notlp])
            ->andFilterWhere(['like', 'kdiagnosa', $this->kdiagnosa])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
