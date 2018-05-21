<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Choicepaper]].
 *
 * @see Choicepaper
 */
class ChoicepaperQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Choicepaper[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Choicepaper|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
