<?php

use yii\db\Schema;
use app\components\Migration;

class m161212_094704_add_usertalk_table extends Migration
{
    public function up()
    {
        $tableOptionsMyISAM = '';
        if( strtolower($this->db->driverName) == 'mysql' ) {
            $tableOptionsMyISAM = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM';
        }

        $this->createTable('{{%usertalk}}', [
            'usertalk_id' => $this->primaryKey(),
            'usertalk_fio' => $this->addComentToField($this->string(64), 'Ф.И.О.'),
            'usertalk_email' => $this->addComentToField($this->string(64), 'Электронная почта'),
            'usertalk_text' => $this->addComentToField($this->text(), 'Текст'),
            'usertalk_status' => $this->addComentToField($this->integer(), 'Статус'),
            'usertalk_created_ip' => $this->addComentToField($this->bigInteger(), 'IP'),
            'usertalk_created' => $this->addComentToField($this->dateTime(), 'Создан'),
        ], $tableOptionsMyISAM);

        $this->createIndex('idx_usertalk_status', '{{%usertalk}}', 'usertalk_status');
        $this->createIndex('idx_usertalk_email', '{{%usertalk}}', 'usertalk_email');

        $this->refreshCache();
    }

    public function down()
    {
        $this->dropTable('{{%usertalk}}');
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
