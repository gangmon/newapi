<?php

namespace app\common\models;

/**
 * This is the ActiveQuery class for [[Uploadfile]].
 *
 * @see Uploadfile
 */
class UploadfileQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Uploadfile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Uploadfile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
