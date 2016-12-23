<?php

namespace app\modules\subscribe\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\subscribe\models\Subscribe;

/**
 * SubscribeSearch represents the model behind the search form about `app\modules\subscribe\models\Subscribe`.
 */
class SubscribeSearch extends Subscribe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subscr_id', 'subscr_status', 'subscr_created_ip'], 'integer'],
            [['subscr_email', 'subscr_created'], 'safe'],
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
        $query = Subscribe::find();

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
            'subscr_id' => $this->subscr_id,
            'subscr_status' => empty($this->subscr_status) ? [self::SUBSCRIBE_STATUS_ACTIVE] : $this->subscr_status,
            'subscr_created_ip' => $this->subscr_created_ip,
            'subscr_created' => $this->subscr_created,
        ]);

        $query->andFilterWhere(['like', 'subscr_email', $this->subscr_email]);

        return $dataProvider;
    }
}
