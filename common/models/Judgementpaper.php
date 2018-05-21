<?php

namespace common\models;
use frontend\models\Result;
use Yii;

/**
 * This is the model class for table "{{%judgementpaper}}".
 *
 * @property integer $id
 * @property integer $result_id
 * @property integer $judgement_id
 * @property string $judgement_answer
 * @property integer $test_time
 *
 * @property Judgement $judgement
 * @property Result $result
 */
class Judgementpaper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%judgementpaper}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['judgement_answer'], 'required'],
            [['result_id', 'judgement_id', 'test_time'], 'integer'],
            [['judgement_answer'], 'string'],
            [['judgement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Judgement::className(), 'targetAttribute' => ['judgement_id' => 'id']],
            [['result_id'], 'exist', 'skipOnError' => true, 'targetClass' => Result::className(), 'targetAttribute' => ['result_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'result_id' => Yii::t('app', 'Result ID'),
            'judgement_id' => Yii::t('app', 'Judgement ID'),
            'judgement_answer' => Yii::t('app', 'Judgement_answer'),
            'test_time' => Yii::t('app', 'Test Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgement()
    {
        return $this->hasOne(Judgement::className(), ['id' => 'judgement_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResult()
    {
        return $this->hasOne(Result::className(), ['id' => 'result_id']);
    }

    /**
     * @inheritdoc
     * @return JudgementpaperQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JudgementpaperQuery(get_called_class());
    }


    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->test_time = time();
            }
            else {

            }
            return true;
        }
        else
        {
            return false;
        }
    }

}
