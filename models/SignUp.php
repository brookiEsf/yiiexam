<?php
/**
 * Created by PhpStorm.
 * User: Esfero
 * Date: 18.02.2019
 * Time: 21:11
 */

namespace app\models;

use yii\base\Model;
use app\models\User;
use Yii;

class SignUp extends Model
{
    public $username;
    public $password;
    public $confirmPassword;
    public $email;
    public static $passwordResetToken;

    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'confirmPassword', 'email'], 'required'],
            // rememberMe must be a boolean value
            ['username', 'match', 'pattern' => '@^[a-z]+$@i', 'message' => 'some message'],
            ['email', 'validateEmail'],
            ['password', 'validatePasswordAndPasswordConfirm'],
            // password is validated by validatePassword()
            // ['passwordResetToken','createPasswordResetToken']

        ];
    }

    public static function createPasswordResetToken($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $passwordResetToken = '';
        for ($i = 0; $i < $length; $i++) {
            $passwordResetToken .= $characters[rand(0, $charactersLength - 1)];
        }
        return self::$passwordResetToken;
    }

    public function validatePasswordAndPasswordConfirm($password, $params)
    {
        if ($this->password !== $this->confirmPassword) {

            $this->addError($password, 'Password does not match');
            return false;
        }
        return true;
    }

    public function validateEmail($email, $params)
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) && preg_match('@^[a-z][a-z0-9\-_\.]+\@gmail\.com$@i', $this->email)) {
            //               if()
            return true;
        } else {
            $this->addError($email, 'email does not match');
            return false;
        }
    }

    public function SignUp()
    {
        $status = $this->validate();
        $user = User::findByUsername($this->username);
        $email = User::findByEmail($this->email);
        if (!empty($user)) {
            $this->addError('username', 'User already exists');
            return false;
        }
        if (!empty($email)) {
            $this->addError('email', 'email already registered');
            return false;
        } else if ($status === true) {
            $user = new User();
            $user->setAttributes([
                'username' => $this->username,
                'password' => $this->password,
                'email' => $this->email,
                'status' => User::USER_STATUS_REGISTERED,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
                'auth_key' => 'this will be rendered if user',//todo: create
                'password_reset_token' => $this->createPasswordResetToken(),  //todo: create
            ], true);
            if ($user->save()) {
                return true;
            } else {
                return false;
            }

        }
    }
}