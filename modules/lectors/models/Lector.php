<?php

namespace app\modules\lectors\models;

use Yii;

/**
 * This is the model class for table "{{%lector}}".
 *
 * @property integer $lec_id
 * @property string $lec_group
 * @property integer $lec_active
 * @property string $lec_email
 * @property string $lec_fam
 * @property string $lec_profession
 * @property string $lec_description
 * @property string $lec_pass
 * @property string $lec_created
 * @property string $lec_key
 */
class Lector extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lector}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lec_active'], 'integer'],
            [['lec_description'], 'string'],
            [['lec_created'], 'safe'],
            [['lec_group'], 'string', 'max' => 16],
            [['lec_email', 'lec_fam', 'lec_profession'], 'string', 'max' => 64],
            [['lec_pass', 'lec_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lec_id' => Yii::t('lector', 'LECTOR_ID'),
            'lec_group' => Yii::t('lector', 'LECTOR_GROUP'),
            'lec_active' => Yii::t('lector', 'LECTOR_ACTIVE'),
            'lec_email' => Yii::t('lector', 'LECTOR_EMAIL'),
            'lec_fam' => Yii::t('lector', 'LECTOR_FAM'),
            'lec_profession' => Yii::t('lector', 'LECTOR_PROFESSION'),
            'lec_description' => Yii::t('lector', 'LECTOR_DESCRIPTION'),
            'lec_pass' => Yii::t('lector', 'LECTOR_PASSWORD'),
            'lec_created' => Yii::t('lector', 'LECTOR_CREATED'),
            'lec_key' => Yii::t('lector', 'LECTOR_API_KEY'),
        ];
    }

    /**
     * @inheritdoc
     * @return LectorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LectorQuery(get_called_class());
    }
}
