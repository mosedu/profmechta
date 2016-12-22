<?php

use yii\db\Schema;
use app\components\Migration;
use app\modules\lectors\models\Lector;

class m161222_083322_change_lector_states extends Migration
{
    public function up()
    {
        // теперь флаг активного лектора - бурем из модели
        Lector::updateAll(['lec_active' => Lector::LECTOR_STATE_ACTIVE,]);
    }

    public function down()
    {
        Lector::updateAll(['lec_active' => 0, ]);
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
