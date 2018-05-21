<?php

namespace common\models;
use frontend\models\Result;
use Yii;

/**
 * This is the model class for table "{{%choicepaper}}".
 *
 * @property integer $id
 * @property integer $result_id
 * @property integer $choice_id
 * @property string $choice_answer
 * @property integer $test_time
 *
 * @property Result $result
 * @property Choice $choice
 */
class Choicepaper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%choicepaper}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['result_id', 'choice_id', 'choice_answer'], 'required'],
//            [['choice_answer'], 'required'],
            [['result_id', 'choice_id', 'test_time'], 'integer'],
            [['choice_answer'], 'string'],
//            [['choice_answer'], 'safe'],
            [['result_id'], 'exist', 'skipOnError' => true, 'targetClass' => Result::className(), 'targetAttribute' => ['result_id' => 'id']],
            [['choice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Choice::className(), 'targetAttribute' => ['choice_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'result_id' => Yii::t('app', '考试编号，用此索引可以查找到这此考试试卷'),
            'choice_id' => Yii::t('app', '用于查找每道选择题'),
            'choice_answer' => Yii::t('app', 'Choice Answer'),
            'test_time' => Yii::t('app', 'Test Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResult()
    {
        return $this->hasOne(Result::className(), ['id' => 'result_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChoice()
    {
        return $this->hasOne(Choice::className(), ['id' => 'choice_id']);
    }

    /**
     * @inheritdoc
     * @return ChoicepaperQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChoicepaperQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->test_time = time();
            }
            else
            {

            }
            return true;

        }
        else
        {
            return false;
        }
    }


}
