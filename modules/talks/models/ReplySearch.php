<?php

namespace app\modules\talks\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\talks\models\Reply;

/**
 * ReplySearch represents the model behind the search form about `app\modules\talks\models\Reply`.
 */
class ReplySearch extends Reply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reply_id', 'reply_status'], 'integer'],
            [['reply_fio', 'reply_text', 'reply_created'], 'safe'],
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
        $query = Reply::find();

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
            'reply_id' => $this->reply_id,
            'reply_status' => $this->reply_status,
            'reply_created' => $this->reply_created,
        ]);

        $query->andFilterWhere(['like', 'reply_fio', $this->reply_fio])
            ->andFilterWhere(['like', 'reply_text', $this->reply_text]);

        return $dataProvider;
    }

    /**
     * @param int $nLimit
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function searchSome($nLimit = 6)
    {
        $aResult = Reply::find()
            ->where(['reply_status' => self::SUBSCRIBE_STATUS_ACTIVE])
            ->orderBy(['reply_created' => SORT_DESC])
            ->limit($nLimit)
            ->all();
        return $aResult;

    }
}
