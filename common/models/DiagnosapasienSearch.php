<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Diagnosapasien;

/**
 * DiagnosaSearch represents the model behind the search form of `common\models\Diagnosa`.
 */
class DiagnosapasienSearch extends Diagnosa
{
    /**
     * {@inheritdoc}
     */
     public function rules()
    {
        return [
            [['tgldiagnosa'], 'safe'],
            [['iddokter', 'idjenisrawat', 'idkel'], 'integer'],
            [['jenis_kelamin'], 'string'],
            [['idrawat', 'rm', 'idpoli', 'ket', 'koddiagnosa'], 'string', 'max' => 50],
            [['idrawat'], 'exist', 'skipOnError' => true, 'targetClass' => Rawatjalan::className(), 'targetAttribute' => ['idrawat' => 'idrawat']],
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
    public function search($params)
    {
        $query = Diagnosapasien::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'koddiagnosa' => $this->koddiagnosa,
            'rm' => $this->rm,
            'idrawat' => $this->idrawat,
            'tgldiagnosa' => $this->tgldiagnosa,
        ]);

        $query->andFilterWhere(['like', 'kodediagnosa', $this->kodediagnosa])
            ->andFilterWhere(['like', 'idrawat', $this->idrawat])
            ->andFilterWhere(['like', 'tgldiagnosa', $this->tgldiagnosa]);

        return $dataProvider;
    }
}
