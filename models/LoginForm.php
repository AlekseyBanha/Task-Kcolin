<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $name;
    public $password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Invalid password or name');
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['name' => $this->name]);
    }


}
