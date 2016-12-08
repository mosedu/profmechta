<?php

namespace app\modules\lessons\models;

use Yii;
use app\modules\lessons\Module;
use app\modules\lessons\models\Leslect;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%lesson}}".
 *
 * @property integer $les_id
 * @property integer $les_active
 * @property string $les_title
 * @property string $les_description
 * @property string $les_created
 */
class Lesson extends \yii\db\ActiveRecord
{
    const LESSON_STATUS_ACTIVE = 1;
    const LESSON_STATUS_HIDDEN = 0;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['les_created'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [],
                ],
                'value' => (strtolower($this->db->driverName) == 'mysql') ? new Expression('NOW()') : 'NOW',
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['les_active'],
                ],
                'value' => 0,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lesson}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['les_title', 'les_description', ], 'required'],
            [['les_active'], 'integer'],
            [['les_description'], 'string'],
            [['les_created'], 'safe'],
            [['les_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'les_id' => 'ID',
            'les_active' => 'Статус',
            'les_title' => 'Назвние',
            'les_description' => 'Описание',
            'les_created' => 'Создана', //  Yii::t('lesson', 'Создана'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDates() {
        return $this->hasMany(
            Leslect::className(),
            ['ll_lesson_id' => 'les_id']
        );
    }

    /**
     * @param array $aDates
     * @param string $tStart
     */
    public function updateDates($aDates = [], $tStart = '') {
        $aFilter = [
            ['ll_lesson_id' => $this->les_id]
        ];

        if( !empty($tStart) ) {
            $aFilter = array_merge(['and'], $aFilter, [['>', 'll_date', $tStart]]);
        }

        Leslect::clearDates($aFilter);
        $n = 0;
        foreach($aDates As $data) {
            $n += Leslect::addDate($data);
        }
        return $n;
    }

    /**
     *
     * Статусы лекций
     *
     * @return array
     *
     */
    public static function getAllStatuses() {
        return [
            self::LESSON_STATUS_ACTIVE => 'Видимо',
            self::LESSON_STATUS_HIDDEN => 'Удалено',
        ];
    }

    /**
     * @return string
     */
    public function getStatus() {
        $aStatus = self::getAllStatuses();
        return (isset($aStatus[$this->les_active]) ? $aStatus[$this->les_active] : '??');
    }

    /**
     * @return string
     */
    public function isHidden() {
        return $this->les_active == self::LESSON_STATUS_HIDDEN;
    }

}
