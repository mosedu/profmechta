<?php

namespace app\modules\subscribe\models;

use Yii;
use app\modules\subscribe\Module;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "profmechta_subscribe".
 *
 * @property integer $subscr_id
 * @property string $subscr_email
 * @property integer $subscr_status
 * @property string $subscr_created_ip
 * @property string $subscr_created
 */
class Subscribe extends \yii\db\ActiveRecord
{
    const SUBSCRIBE_STATUS_ACTIVE = 1; // активнsq подписчик

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['subscr_created'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [],
                ],
                'value' => (strtolower($this->db->driverName) == 'mysql') ? new Expression('NOW()') : 'NOW',
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['subscr_status'],
                ],
                'value' => self::SUBSCRIBE_STATUS_ACTIVE,
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['subscr_created_ip'],
                ],
                'value' => ip2long($_SERVER['REMOTE_ADDR']),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profmechta_subscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subscr_email'], 'required', ],
            [['subscr_email'], 'email', ],
            [['subscr_email'], 'unique', ],
            [['subscr_email'], 'string', 'max' => 64],
            [['subscr_status', 'subscr_created_ip'], 'integer'],
            [['subscr_created'], 'safe'],
        ];
    }

    /**
     * Поля для проверки в разных сценариях
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['frontentcreate'] = [
            'subscr_email',
        ];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subscr_id' => Module::t('subscribe', 'ID'),
            'subscr_email' => Module::t('subscribe', 'SUBSCRIBE_EMAIL'),
            'subscr_status' => Module::t('subscribe', 'SUBSCRIBE_STATUS'),
            'subscr_created_ip' => Module::t('subscribe', 'IP'),
            'subscr_created' => Module::t('subscribe', 'SUBSCRIBE_CREATED'),
        ];
    }
}
