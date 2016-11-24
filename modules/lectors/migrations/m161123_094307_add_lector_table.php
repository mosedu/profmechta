<?php

use yii\db\Schema;
use app\components\Migration;

class m161123_094307_add_lector_table extends Migration
{
    public function up()
    {

        $tableOptionsMyISAM = '';
        if( strtolower($this->db->driverName) == 'mysql' ) {
            $tableOptionsMyISAM = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM';
        }

        $this->createTable('{{%lector}}', [
            'lec_id' => $this->primaryKey(),                                               // Schema::TYPE_PK,
            'lec_group' => $this->addComentToField($this->string(16), 'Группа'),                           // Schema::TYPE_STRING . '(16) Comment \'Группа\'',
            'lec_active' => $this->addComentToField($this->smallInteger()->defaultValue(1), 'Показывать'), // Schema::TYPE_SMALLINT . ' Default 1 Comment \'Показывать\'',
            'lec_email' => $this->addComentToField($this->string(64), 'Электронная почта'),                // Schema::TYPE_STRING . '(64) Comment \'Электронная почта\'',
            'lec_fam' => $this->addComentToField($this->string(64), 'ФИО'),                                // Schema::TYPE_STRING . '(64) Comment \'ФИО\'',
            'lec_profession' => $this->addComentToField($this->string(64), 'Профессия'),                   // Schema::TYPE_STRING . '(64) Comment \'Профессия\'',
            'lec_description' => $this->addComentToField($this->text(), 'Описание'),                       // Schema::TYPE_TEXT . ' Comment \'Описание\'',
            'lec_pass' => $this->addComentToField($this->string(255), 'Пароль'),                           // Schema::TYPE_STRING . ' Comment \'Пароль\'',
            'lec_created' => $this->addComentToField($this->dateTime(), 'Создан'),                         // Schema::TYPE_DATETIME . ' Comment \'Создан\'',
            'lec_key' => $this->addComentToField($this->string(255), 'API key'),                           // Schema::TYPE_STRING . ' Comment \'API key\'',
        ], $tableOptionsMyISAM);

        $this->createIndex('idx_lec_email', '{{%lector}}', 'lec_email');
        $this->createIndex('idx_lec_key', '{{%lector}}', 'lec_key');
        $this->createIndex('idx_lec_active', '{{%lector}}', 'lec_active');

        // need refrash cache after change table strusture
        $this->refreshCache();
    }

    public function down()
    {
        $this->dropTable('{{%lector}}');
//        echo "m161123_094307_add_lector_table cannot be reverted.\n";

        // need refresh cache after change table strusture
        $this->refreshCache();

//        return false;
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
