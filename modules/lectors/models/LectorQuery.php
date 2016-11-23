<?php

namespace app\modules\lectors\models;

/**
 * This is the ActiveQuery class for [[Lector]].
 *
 * @see Lector
 */
class LectorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Lector[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Lector|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
