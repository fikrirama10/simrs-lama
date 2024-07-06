<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BarangMasukdetail;

/**
 * BarangMasukdetailSearch represents the model behind the search form of `common\models\BarangMasukdetail`.
 */
class BarangMasukdetailSearch extends BarangMasukdetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idbarang', 'qty', 'harga', 'jumlah', 'satuan', 'permintaan', 'status'], 'integer'],
            [['idtrx', 'iddetail', 'tanggal', 'ed', 'namaobat'], 'safe'],
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
        $query = BarangMasukdetail::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
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
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idbarang' => $this->idbarang,
            'qty' => $this->qty,
            'harga' => $this->harga,
            'jumlah' => $this->jumlah,
            'satuan' => $this->satuan,
            'tanggal' => $this->tanggal,
            'ed' => $this->ed,
            'permintaan' => $this->permintaan,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'idtrx', $this->idtrx])
            ->andFilterWhere(['like', 'iddetail', $this->iddetail])
            ->andFilterWhere(['like', 'namaobat', $this->namaobat]);

        return $dataProvider;
    }
}
