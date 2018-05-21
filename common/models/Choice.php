<?php

namespace common\models;
use backend\models\Adminuser;
use Yii;

/**
 * This is the model class for table "{{%choice}}".
 *
 * @property integer $id
 * @property string $answer
 * @property integer $admin_id
 * @property string $title
 * @property string $A
 * @property string $B
 * @property string $C
 * @property string $D
 * @property integer $score
 * @property string $difficulty
 * @property integer $create_time
 * @property integer $update_time
 *
 * @property Adminuser $admin
 * @property Choicepaper[] $choicepapers
 */
class Choice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%choice}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title',],'unique', 'message' => '此题已存在.'],
//            ['title', 'unique', 'targetClass' => '\common\models\Choice', 'message' => '此题已存在.'],
            [['answer', 'title', 'A', 'B', 'C', 'D', 'difficulty', ], 'required'],
            [['answer', 'title', 'A', 'B', 'C', 'D', 'difficulty'], 'string'],
            [['admin_id', 'score', 'create_time', 'update_time'], 'integer'],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['admin_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '题号'),
            'answer' => Yii::t('app', '正确答案'),
            'admin_id' => Yii::t('app', '出题人'),
            'title' => Yii::t('app', '题目内容'),
            'A' => Yii::t('app', 'A'),
            'B' => Yii::t('app', 'B'),
            'C' => Yii::t('app', 'C'),
            'D' => Yii::t('app', 'D'),
            'score' => Yii::t('app', '题目分数，默认10分'),
            'difficulty' => Yii::t('app', 'Difficulty'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'admin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChoicepapers()
    {
        return $this->hasMany(Choicepaper::className(), ['choice_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ChoiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChoiceQuery(get_called_class());
    }

//设置在总览页面题目的长度
    public function getBeginning()
    {
        $tmpStr = strip_tags($this->title);
        $tmpLen = mb_strlen($tmpStr);

        return mb_substr($tmpStr,0,18,'utf-8').(($tmpLen>18)?'...':'');
    }
    //创建时间
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->admin_id = Yii::$app->user->id;
                $this->create_time = time();
                $this->update_time = time();
                $this->score = 10;
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
    //得到数据库中存在的所有id


}
