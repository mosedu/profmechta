<?php

namespace app\modules\usertalk\models;

use Yii;
use app\modules\usertalk\Module;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use app\modules\usertalk\components\ActionBehavior;

/**
 * This is the model class for table "{{%usertalk}}".
 *
 * @property integer $usertalk_id
 * @property string $usertalk_fio
 * @property string $usertalk_email
 * @property string $usertalk_text
 * @property integer $usertalk_status
 * @property string $usertalk_created_ip
 * @property string $usertalk_created
 */
class Usertalk extends \yii\db\ActiveRecord
{
    const USER_TALK_STATUS_ACTIVE = 1; // активное сообщение
    const USER_TALK_STATUS_DELETED = 2; // скрытое сообщение
    const USER_TALK_STATUS_VISIBLE = 3; // видимое сообщение

    const USER_TALK_MAX_TEXT_LENGTH = 400; // максимальная длина текста для отправки

    public $notifyEmails = [
//        'devmosedu@yandex.ru',
//        'KozminVA@edu.mos.ru',
    ];

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['usertalk_created'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [],
                ],
                'value' => (strtolower($this->db->driverName) == 'mysql') ? new Expression('NOW()') : 'NOW',
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['usertalk_status'],
                ],
                'value' => self::USER_TALK_STATUS_ACTIVE,
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['usertalk_created_ip'],
                ],
                'value' => ip2long($_SERVER['REMOTE_ADDR']),
            ],
            [
                'class' => ActionBehavior::className(),
                'allevents' => [
                    ActiveRecord::EVENT_AFTER_INSERT,
                ],
                'action' => function ($event) {
                    /** @var \yii\base\Event $event */
                    $model = $event->sender;
                    $model->notifyNewMessage();
//                    Actionlog::createNew($model);
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usertalk}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usertalk_text', 'usertalk_fio', 'usertalk_email', ], 'required'],
            [['usertalk_text'], 'filter', 'filter' => function($value) { return str_replace("\r", "", $value); } ],
            [['usertalk_email', ], 'email'],
            [
                ['usertalk_text'],
                function ($attribute, $params){
                    $nLen = mb_strlen($this->$attribute, 'UTF-8');
                    /* Yii::info("text = " . ($this->$attribute) . "\n" . $nLen . " : " .  strlen($this->$attribute) ); */
                    if( $nLen > self::USER_TALK_MAX_TEXT_LENGTH ) {
                         Yii::info("text = " . ($this->$attribute) . "\n" . $nLen . " : " .  strlen($this->$attribute) );
                        $this->addError($attribute, 'Длина сообщения не должна превышать ' . self::USER_TALK_MAX_TEXT_LENGTH . ' символов. Текущая длина сообщения - ' . $nLen);
                    }
                },
            ],
            [['usertalk_text'], 'string', 'min' => 30, /*'max' => self::USER_TALK_MAX_TEXT_LENGTH, */],
            [['usertalk_status', 'usertalk_created_ip'], 'integer'],
            [['usertalk_created'], 'safe'],
            [['usertalk_fio', 'usertalk_email'], 'string', 'max' => 64],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usertalk_id' => Module::t('usertalk', 'ID'),
            'usertalk_fio' => Module::t('usertalk', 'USERTALK_FIO'),
            'usertalk_email' => Module::t('usertalk', 'USERTALK_EMAIL'),
            'usertalk_text' => Module::t('usertalk', 'USERTALK_TEXT'),
            'usertalk_status' => Module::t('usertalk', 'USERTALK_STATUS'),
            'usertalk_created_ip' => Module::t('usertalk', 'USERTALK_CREATED_IP'),
            'usertalk_created' => Module::t('usertalk', 'USERTALK_CREATED'),
        ];
    }

//    public static function getStatuses() {
//        return [
//            self::USER_TALK_STATUS_ACTIVE => 'Новое',
////            self::USER_TALK_STATUS_DELETED => 'Удаленное',
//            self::USER_TALK_STATUS_VISIBLE => 'Видимое',
//        ];
//    }

    public function notifyNewMessage() {
        $aMails = [];
        if( isset(Yii::$app->params['notifyEmails']) && (count(Yii::$app->params['notifyEmails']) > 0) ) {
            $aMails = Yii::$app->params['notifyEmails'];
        }
        $aMails = array_merge($aMails, $this->notifyEmails);
        if( count($aMails) > 0 ) {
            $subject = 'Новое сообщение на сайте ' . $_SERVER['HTTP_HOST'];
            $body = <<<EOT
Добрый день.

На сайте  {$_SERVER['HTTP_HOST']} добавлено новое сообщение.

В сообщении содержится следующая информация:
{$this->usertalk_fio}
{$this->usertalk_email}
{$this->usertalk_text}


EOT;

            $logger = new \Swift_Plugins_Loggers_ArrayLogger();
            /** @var \Swift_Mailer $oSwiftmailer */
            $oSwiftmailer = Yii::$app->mailer->getSwiftMailer();
            $oSwiftmailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($logger));

            try {
                $bSend = Yii::$app->mailer->compose()
                    ->setTo($aMails)
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setSubject($subject)
                    ->setTextBody($body)
                    ->send();
                $sErrMsg = '';
            }
            catch(\Exception $e ) {
                $bSend = false;
                $sErrMsg = $e->getMessage() . ' ['.$e->getCode().']';
                echo "Error send mail for message {$this->usertalk_id} : " . $sErrMsg . "\n";
            }

            $sLog = $logger->dump() . (!empty($sErrMsg) ? ("\nException message: " . $sErrMsg) : '');
            $logger->clear();

            Yii::info($sLog);
        }
    }

    /**
     * @param bool $bAll
     * @return array
     */
    public static function getAllStatuses($bAll = false) {
        $a = [
            self::USER_TALK_STATUS_ACTIVE => 'Не опубликовано',
            self::USER_TALK_STATUS_VISIBLE => 'Опубликовано',
        ];
        if( $bAll ) {
            $a[self::USER_TALK_STATUS_DELETED] = 'Удалено';
        }
        return $a;
    }

    /**
     * @return string
     */
    public function getStatus() {
        $aStatus = self::getAllStatuses(true);
        return (isset($aStatus[$this->usertalk_status]) ? $aStatus[$this->usertalk_status] : '??');
    }


}
