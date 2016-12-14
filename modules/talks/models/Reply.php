<?php

namespace app\modules\talks\models;

use Yii;
use app\modules\talks\Module;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%reply}}".
 *
 * @property integer $reply_id
 * @property string $reply_fio
 * @property string $reply_text
 * @property integer $reply_status
 * @property string $reply_created
 */
class Reply extends \yii\db\ActiveRecord
{
    const SUBSCRIBE_STATUS_HIDDEN = 0; // скрытый отзыв
    const SUBSCRIBE_STATUS_ACTIVE = 1; // активный отзыв

    public $image; // картинка для вывода в списке лекторов

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['reply_created'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [],
                ],
                'value' => (strtolower($this->db->driverName) == 'mysql') ? new Expression('NOW()') : 'NOW',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reply_text', 'reply_status', 'reply_fio', ], 'required', ],
            [['reply_text'], 'string'],
            [['reply_status'], 'integer'],
            [['reply_created'], 'safe'],
            [['reply_fio'], 'string', 'max' => 64],
            [['image'], 'file', 'maxSize' => 1000000, 'extensions' => ['jpg', 'png', 'tif', ], 'skipOnEmpty' => true, ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reply_id' => Module::t('talks', 'ID'),
            'reply_fio' => Module::t('talks', 'TALKS_FIO'),
            'reply_text' => Module::t('talks', 'TALKS_TEXT'),
            'reply_status' => Module::t('talks', 'TALKS_STATUS'),
            'reply_created' => Module::t('talks', 'TALKS_CREATED'),
            'image' => Module::t('talks', 'TALKS_IMAGE_FILE'),
        ];
    }

    /**
     * @return array
     */
    public static function getAllStatuses() {
        return [
            self::SUBSCRIBE_STATUS_HIDDEN => 'Скрытый',
            self::SUBSCRIBE_STATUS_ACTIVE => 'Видимый',
        ];
    }

    /**
     * @return string
     */
    public function getStatusTitle() {
        $a = self::getAllStatuses();
        return isset($a[$this->reply_status]) ? $a[$this->reply_status] : '??';
    }

    /**
     *
     * @var string $sType
     *
     * @return callable
     */
    public function generateImageFileName($sType = '') {
        $model = $this;
        return function($origFileName) use ($model, $sType) {
            return $model->getOriginalImageFileName($sType, $origFileName);
        };
    }

    public function generateImageFileUrl($sType = '') {
        $sWebPath = Yii::getAlias('@app/web');
        return substr($this->getOriginalImageFileName($sType, ''), strlen($sWebPath));
    }

    /**
     *
     * @param string $sType
     * @param string $origFileName
     *
     */
    public function getOriginalImageFileName($sType, $origFileName) {
        $sf = Yii::getAlias('@app/web/img/talks/orig') . DIRECTORY_SEPARATOR . $this->reply_id . (empty($sType) ? '' : ('-' . $sType)) . '.jpg';
        return $sf;
    }

    public function getImage($sType = '') {
        $sf = $this->getOriginalImageFileName($sType, '');
        if( file_exists($sf) ) {
            return str_replace('\\', '/', substr($sf, strlen($_SERVER['DOCUMENT_ROOT'])));
        }
        return null;
    }

    /**
     * @param array $aParams
     * @return callable
     */
    public function createImageValidator($aParams = []) {
        return function($sImageFile) use ($aParams) {
            $aErrors = [];
            $a = getimagesize($sImageFile);
//            Yii::info('sImageFile = ' . $sImageFile);
//            Yii::info('aParams = ' . print_r($aParams, true));
//            Yii::info('a = ' . print_r($a, true));
            if( isset($aParams['minx']) && ($a[0] < $aParams['minx']) ) {
                $aErrors[] = 'Ширина картинки должна быть не меньше ' . $aParams['minx'] . 'px';
            }
            if( isset($aParams['maxx']) && ($a[0] > $aParams['maxx']) ) {
                $aErrors[] = 'Ширина картинки должна быть не больше ' . $aParams['maxx'] . 'px';
            }
            if( isset($aParams['miny']) && ($a[1] < $aParams['miny']) ) {
                $aErrors[] = 'Высота картинки должна быть не меньше ' . $aParams['miny'] . 'px';
            }
            if( isset($aParams['maxy']) && ($a[1] > $aParams['maxy']) ) {
                $aErrors[] = 'Высота картинки должна быть не больше ' . $aParams['maxy'] . 'px';
            }
            if( isset($aParams['x']) && ($a[0] != $aParams['x']) ) {
                $aErrors[] = 'Ширина картинки должна быть ' . $aParams['x'] . 'px';
            }
            if( isset($aParams['y']) && ($a[1] != $aParams['y']) ) {
                $aErrors[] = 'Высота картинки должна быть ' . $aParams['y'] . 'px';
            }
            if( isset($aParams['ratio']) && (abs($a[0] / $a[1] - $aParams['ratio']) > 0.01 ) ) {
                $aErrors[] = 'Отношение ширины к высоте у картинки должно быть ' . $aParams['ratio'] . ':1';
            }
            return $aErrors;
        };
    }
}
