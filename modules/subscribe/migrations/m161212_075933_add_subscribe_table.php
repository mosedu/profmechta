<?php

use yii\db\Schema;
use app\components\Migration;

class m161212_075933_add_subscribe_table extends Migration
{
    public function up()
    {
        $tableOptionsMyISAM = '';
        if( strtolower($this->db->driverName) == 'mysql' ) {
            $tableOptionsMyISAM = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM';
        }

        $this->createTable('{{%subscribe}}', [
            'subscr_id' => $this->primaryKey(),
            'subscr_email' => $this->addComentToField($this->string(64), 'Электронная почта'),
            'subscr_status' => $this->addComentToField($this->integer(), 'Статус'),
            'subscr_created_ip' => $this->addComentToField($this->bigInteger(), 'IP'),
            'subscr_created' => $this->addComentToField($this->dateTime(), 'Создан'),
        ], $tableOptionsMyISAM);

        $this->createIndex('idx_subscr_status', '{{%subscribe}}', 'subscr_status');
        $this->createIndex('idx_subscr_email', '{{%subscribe}}', 'subscr_email');

        $this->refreshCache();
    }

    public function down()
    {
        $this->dropTable('{{%subscribe}}');
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
