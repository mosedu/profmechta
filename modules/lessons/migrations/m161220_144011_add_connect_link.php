<?php

use yii\db\Schema;
use app\components\Migration;

class m161220_144011_add_connect_link extends Migration
{
    public function up()
    {
        $this->addColumn('{{%leslect}}', 'll_reglink', $this->addComentToField($this->string(), 'Ссылка на регистрацию'));

        $this->refreshCache();
    }

    public function down()
    {
        $this->dropColumn('{{%leslect}}', 'll_reglink');
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
