<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PermintaanBarangDetail;

/**
 * PermintaanBarangDetailSearch represents the model behind the search form of `common\models\PermintaanBarangDetail`.
 */
class PermintaanBarangDetailSearch extends PermintaanBarangDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'idobat', 'qty', 'idsatuan', 'harga', 'total', 'idtrx', 'sisastok', 'iduser'], 'integer'],
            [['idpermintaan', 'tanggal', 'namaobat', 'keterangan'], 'safe'],
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
        $query = PermintaanBarangDetail::find();

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
            'status' => $this->status,
            'idobat' => $this->idobat,
            'qty' => $this->qty,
            'idsatuan' => $this->idsatuan,
            'harga' => $this->harga,
            'total' => $this->total,
            'idtrx' => $this->idtrx,
            'sisastok' => $this->sisastok,
            'iduser' => $this->iduser,
        ]);

        $query->andFilterWhere(['like', 'idpermintaan', $this->idpermintaan])
            ->andFilterWhere(['like', 'namaobat', $this->namaobat])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
