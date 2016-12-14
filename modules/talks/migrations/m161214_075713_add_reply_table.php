<?php

use yii\db\Schema;
use app\components\Migration;

class m161214_075713_add_reply_table extends Migration
{
    public function up()
    {
        $tableOptionsMyISAM = '';
        if( strtolower($this->db->driverName) == 'mysql' ) {
            $tableOptionsMyISAM = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM';
        }

        $this->createTable('{{%reply}}', [
            'reply_id' => $this->primaryKey(),
            'reply_fio' => $this->addComentToField($this->string(64), 'Ф.И.О.'),
            'reply_text' => $this->addComentToField($this->text(), 'Текст'),
            'reply_status' => $this->addComentToField($this->integer(), 'Статус'),
            'reply_created' => $this->addComentToField($this->dateTime(), 'Создан'),
        ], $tableOptionsMyISAM);

        $this->createIndex('idx_reply_status', '{{%reply}}', 'reply_status');
        $this->createIndex('idx_reply_created', '{{%reply}}', 'reply_created');

        $this->refreshCache();
    }

    public function down()
    {
        $this->dropTable('{{%reply}}');
        $this->refreshCache();
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
