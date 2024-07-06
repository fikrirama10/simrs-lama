<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pasisen;

/**
 * PasisenSearch represents the model behind the search form about `common\models\Pasisen`.
 */
class PasisenSearch extends Pasisen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_rekmed','id_status', 'idverifed'], 'integer'],
            [['tempat_lahir', 'nama_pasien', 'jenis_kelamin', 'gol_darah', 'nama_ibu', 'nohp', 'alamat', 'tanggal_lahir','created_at'], 'safe'],
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
    public function search($params, $where=null, $andWhere=null, $andFilterWhere=null, $andFilterWhere2=null, $orderBy = null)
    {
        $query = Pasisen::find();

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
            'no_rekmed' => $this->no_rekmed,
            //'id_pekerjaan' => $this->id_pekerjaan,
            'id_status' => $this->id_status,
            'tanggal_lahir' => $this->tanggal_lahir,
            'created_at' => $this->created_at,
            'idverifed' => $this->idverifed,
        ]);

        $query->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'nama_pasien', $this->nama_pasien])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'gol_darah', $this->gol_darah])
            ->andFilterWhere(['like', 'nama_ibu', $this->nama_ibu])
            ->andFilterWhere(['like', 'nohp', $this->nohp])
            ->andFilterWhere(['like', 'alamat', $this->alamat]);

        return $dataProvider;
    }
}
