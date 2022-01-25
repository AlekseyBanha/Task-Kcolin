<?php
namespace app\models;

use yii\base\Model;

class SignUp extends Model {
    public $email;
    public $password;
    public $name;

    public function rules()
    {
        return [
          [['email','password','name'],'required'],
          ['email','email'],
          ['email','unique','targetClass'=>'app\models\User'],
          ['name','string','min'=>4,'max'=>20],
          ['password','string','min'=>3,'max'=>12],
        ];
    }
    public function signup(){
        $user = new User();
        $user->name=$this->name;
        $user->email=$this->email;
        $user->setPassword($this->password);
        $user->created_at=date("Y-m-d H:i:s");
        $user->save();
    }

}