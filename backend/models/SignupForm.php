<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\Adminuser;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $nickname;
    public $email;
    public $password;
    public $password_repeat;
    public $profile;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\backend\models\Adminuser', 'message' => '用户名已经在了，换一个.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\Adminuser', 'message' => '邮箱已存在.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_repeat','compare','compareAttribute'=>'password','message'=>'两次的密码不一致'],

            ['nickname','required'],
            ['nickname','string','max'=>128],
            ['profile','string'],
        ];
    }


    public function attributeLabels()
    {
//        return [
//            'username' => '用户名',
//            'nickname' => '昵称',
//            'password' => '密码',
//            'password_repeat'=>'重输密码',
//            'email' => 'Email',
//            'profile' => 'Profile简介',
//
//        ];
        return [
//            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'nickname' => Yii::t('app', 'Nickname'),
            'password' => Yii::t('app', 'Password'),
            'password_repeat' => Yii::t('app','Password repeat'),
            'email' => Yii::t('app', 'Email'),
            'profile' => Yii::t('app', 'Profile'),
//            'auth_key' => Yii::t('app', 'Auth Key'),
//            'password_hash' => Yii::t('app', 'Password Hash'),
//            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
//            'settime' => Yii::t('app', 'Settime'),
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Adminuser();
        $user->username = $this->username;
        $user->nickname =$this->nickname;
        $user->email = $this->email;
        $user->profile = $this->profile;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->password = '*';
//        $user->save(); VarDumper::dump($user->errors);exit(0);

        return $user->save() ? $user : null;
    }
}
