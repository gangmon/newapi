<?php

namespace common\models;
use backend\models\Adminuser;
use Yii;

/**
 * This is the model class for table "{{%judgement}}".
 *
 * @property integer $id
 * @property integer $admin_id
 * @property string $title
 * @property string $answer
 * @property integer $score
 * @property integer $create_time
 * @property integer $update_time
 *
 * @property Adminuser $admin
 * @property Judgementpaper[] $judgementpapers
 */
class Judgement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%judgement}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'],'unique','message' => '此题已存在.'],
//            ['title', 'unique', 'targetClass' => '\common\models\Judgement', 'message' => '此题已存在.'],
            [[ 'title', 'answer', ], 'required'],
            [['admin_id', 'score', 'create_time', 'update_time'], 'integer'],
            [['title', 'answer'], 'string'],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['admin_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'admin_id' => Yii::t('app', '出题人'),
            'title' => Yii::t('app', '题目'),
            'answer' => Yii::t('app', '答案'),
            'score' => Yii::t('app', '分数，默认5分'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    //设置在总览页面题目的长度
    public function getBeginning()
    {
        $tmpStr = strip_tags($this->title);
        $tmpLen = mb_strlen($tmpStr);

        return mb_substr($tmpStr,0,18,'utf-8').(($tmpLen>18)?'...':'');
    }

    //创建时间和修改时间
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->admin_id = Yii::$app->user->id;
                $this->create_time = time();
                $this->update_time = time();
                $this->score = 5;
            }
            else
            {
                $this->update_time = time();
            }

            return true;
        }
        else
        {
            return false;
        }
    }

//    public function afterFind()
//    {
//        parent::afterFind();
//        $this->_oldTags = $this->tags;
//    }

//    public function afterSave($insert, $changedAttributes)
//    {
//        parent::afterSave($insert, $changedAttributes);
//        Tag::updateFrequency($this->_oldTags, $this->tags);
//    }
//
//    public function afterDelete()
//    {
//        parent::afterDelete();
//        Tag::updateFrequency($this->tags, '');
//    }
//获取题目详情
//    public function getUrl()
//    {
//        return Yii::$app->urlManager->createUrl(
//            ['choice/detail','id'=>$this->id,'title'=>$this->title]);
//    }



    public function getAdmin()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'admin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgementpapers()
    {
        return $this->hasMany(Judgementpaper::className(), ['judgement_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return JudgementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JudgementQuery(get_called_class());
    }

}
