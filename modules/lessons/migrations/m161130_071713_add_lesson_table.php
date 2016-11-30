<?php

use yii\db\Schema;
use app\components\Migration;

class m161130_071713_add_lesson_table extends Migration
{
    public function up()
    {
        $tableOptionsMyISAM = '';
        if( strtolower($this->db->driverName) == 'mysql' ) {
            $tableOptionsMyISAM = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM';
        }

        $this->createTable('{{%lesson}}', [
            'les_id' => $this->primaryKey(),
            'les_active' => $this->addComentToField($this->smallInteger()->defaultValue(0), 'Показывать'),
            'les_title' => $this->addComentToField($this->string(255), 'Назвние'),
            'les_description' => $this->addComentToField($this->text(), 'Описание'),
            'les_created' => $this->addComentToField($this->dateTime(), 'Создана'),
        ], $tableOptionsMyISAM);

        $this->createIndex('idx_les_created', '{{%lesson}}', 'les_created');

        // need refrash cache after change table strusture
        $this->refreshCache();
    }

    public function down()
    {
        $this->dropTable('{{%lesson}}');
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
