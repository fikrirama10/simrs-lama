<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pekerjaan;

/**
 * PekerjaanSearch represents the model behind the search form about `common\models\Pekerjaan`.
 */
class PekerjaanSearch extends Pekerjaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['jenis_pekerjaan', 'tempatkerja', 'alamat_kerja', 'notlp', 'idpasien'], 'safe'],
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
    public function search($params)
    {
        $query = Pekerjaan::find();

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
        ]);

        $query->andFilterWhere(['like', 'jenis_pekerjaan', $this->jenis_pekerjaan])
            ->andFilterWhere(['like', 'tempatkerja', $this->tempatkerja])
            ->andFilterWhere(['like', 'alamat_kerja', $this->alamat_kerja])
            ->andFilterWhere(['like', 'notlp', $this->notlp])
            ->andFilterWhere(['like', 'idpasien', $this->idpasien]);

        return $dataProvider;
    }
}
