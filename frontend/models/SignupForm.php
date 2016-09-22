<?php
namespace frontend\models;

use yii\base\DynamicModel;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $captcha;
    public $step;
    private $_additional_validation=[];
    public $smsCode;
    public $phone;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $a = [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],


            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['step','smsCode'],'safe']
        ];
        //var_dump($this->step);
        //die();
        $a = array_merge($a,$this->_additional_validation);
        return $a;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {

        if (!$this->step || $this->step == 1)       $this->_additional_validation[] =['captcha','captcha'];
        if ($this->step == 2) {
            $this->_additional_validation[] =['smsCode','validateSmsCode'];
        }

        if (!$this->validate()) {
            return null;
        }
        if (!$this->step || $this->step == 1) {
            // взяли телефон пользователя, отправили sms и пишем в сессию, например
            //die();
            $this->step = 2;
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

    public function validateSmsCode($attribute, $parameter)
    {


    }
}
