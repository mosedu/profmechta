<?php

namespace app\modules\lectors\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\lectors\models\Lector;

/**
 * LectorSearch represents the model behind the search form about `app\modules\lectors\models\Lector`.
 */
class LectorSearch extends Lector
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lec_id', 'lec_active'], 'integer'],
            [['lec_group', 'lec_email', 'lec_fam', 'lec_profession', 'lec_description', 'lec_pass', 'lec_created', 'lec_key'], 'safe'],
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
        $query = Lector::find();

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
            'lec_id' => $this->lec_id,
            'lec_active' => $this->lec_active,
            'lec_created' => $this->lec_created,
        ]);

        $query->andFilterWhere(['like', 'lec_group', $this->lec_group])
            ->andFilterWhere(['like', 'lec_email', $this->lec_email])
            ->andFilterWhere(['like', 'lec_fam', $this->lec_fam])
            ->andFilterWhere(['like', 'lec_profession', $this->lec_profession])
            ->andFilterWhere(['like', 'lec_description', $this->lec_description])
            ->andFilterWhere(['like', 'lec_pass', $this->lec_pass])
            ->andFilterWhere(['like', 'lec_key', $this->lec_key]);

        return $dataProvider;
    }
}
