<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Obat;

/**
 * ObatSearch represents the model behind the search form of `common\models\Obat`.
 */
class ObatSearch extends Obat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idsatuan', 'idjenisobat', 'stok','idjenis'], 'integer'],
            [['noobat', 'namaobat', 'kadaluarsa'], 'safe'],
            [['harga'], 'number'],
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
        $query = Obat::find()->orderby(['namaobat'=>SORT_ASC]);

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
            'kadaluarsa' => $this->kadaluarsa,
            'harga' => $this->harga,
            'idsatuan' => $this->idsatuan,
            'idjenis' => $this->idjenisobat,
            'idjenisobat' => $this->idjenisobat,
            'stok' => $this->stok,
        ]);

        $query->andFilterWhere(['like', 'noobat', $this->noobat])
            ->andFilterWhere(['like', 'namaobat', $this->namaobat])
            ->andFilterWhere(['like', 'idjenis', $this->idjenis]);

        return $dataProvider;
    }
}
