<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Dokumen;

/**
 * DokumenSearch represents the model behind the search form of `common\models\Dokumen`.
 */
class DokumenSearch extends Dokumen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'IdKat', 'IdJenis', 'IdType', 'FileSize', 'Requested', 'IdStat'], 'integer'],
            [['Kode', 'Judul', 'FileName', 'FileExt', 'Publisher', 'PublishDate', 'Deskripsi', 'UserId', 'IdSKPD', 'Keterangan'], 'safe'],
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
        $query = Dokumen::find();

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
            'Id' => $this->Id,
            'IdKat' => $this->IdKat,
            'IdJenis' => $this->IdJenis,
            'IdType' => $this->IdType,
            'FileSize' => $this->FileSize,
            'Requested' => $this->Requested,
            'IdStat' => $this->IdStat,
            'PublishDate' => $this->PublishDate,
        ]);

        $query->andFilterWhere(['like', 'Kode', $this->Kode])
            ->andFilterWhere(['like', 'Judul', $this->Judul])
            ->andFilterWhere(['like', 'FileName', $this->FileName])
            ->andFilterWhere(['like', 'FileExt', $this->FileExt])
            ->andFilterWhere(['like', 'Publisher', $this->Publisher])
            ->andFilterWhere(['like', 'Deskripsi', $this->Deskripsi])
            ->andFilterWhere(['like', 'UserId', $this->UserId])
           // ->andFilterWhere(['like', 'IdSKPD', $this->IdSKPD])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
