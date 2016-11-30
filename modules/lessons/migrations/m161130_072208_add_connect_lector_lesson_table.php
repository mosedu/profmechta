<?php

use yii\db\Schema;
use app\components\Migration;

class m161130_072208_add_connect_lector_lesson_table extends Migration
{
    public function up()
    {
        $tableOptionsMyISAM = '';
        if( strtolower($this->db->driverName) == 'mysql' ) {
            $tableOptionsMyISAM = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM';
        }

        $this->createTable('{{%leslect}}', [
            'll_id' => $this->primaryKey(),
            'll_lesson_id' => $this->addComentToField($this->integer(), 'Лекция'),
            'll_lector_id' => $this->addComentToField($this->integer(), 'Лектор'),
            'll_date' => $this->addComentToField($this->dateTime(), 'Дата'),
        ], $tableOptionsMyISAM);

        $this->createIndex('idx_ll_lesson_id', '{{%leslect}}', 'll_lesson_id');
        $this->createIndex('idx_ll_lector_id', '{{%leslect}}', 'll_lector_id');
        $this->createIndex('idx_ll_date', '{{%leslect}}', 'll_date');

        // need refrash cache after change table strusture
        $this->refreshCache();
    }

    public function down()
    {
        $this->dropTable('{{%leslect}}');
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
