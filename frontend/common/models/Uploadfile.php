<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "uploadfile".
 *
 * @property int $id
 * @property string $user_openid
 * @property string $name
 * @property string $path
 */
class Uploadfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploadfile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_openid', 'name', 'path'], 'required'],
            [['user_openid', 'name'], 'string', 'max' => 50],
            [['path'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_openid' => Yii::t('app', 'User Openid'),
            'name' => Yii::t('app', 'Name'),
            'path' => Yii::t('app', 'Path'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UploadfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadfileQuery(get_called_class());
    }
}
