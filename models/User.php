<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;
use app\modules\admin\Admin;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $auth_key
 * @property string $password_reset_token
 */

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const USER_STATUS_REGISTERED = 1;
    const USER_STATUS_CONFIRMED = 10;
    const USER_STATUS_MODERATOR = 11;
    const USER_STATUS_ADMIN = 100;

//    public $id;
//    public $username;
//    public $password;
//    public $authKey;
//    public $accessToken;

    public static function tableName()
    {
        return '{{%users}}';
        //return parent::tableName(); // TODO: Change the autogenerated stub
    }

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    public function rules()
    {
        return [
            [['username', 'password', 'email', 'auth_key'], 'required'],
            ['status', 'default', 'value' => 1],
            ['status', 'in', 'range' => [self::USER_STATUS_REGISTERED, self::USER_STATUS_ADMIN]],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'auth_key', 'password_reset_token'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 95],
            [['email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    public function can($permissionName, $params = [], $allowCaching = true)
    {
        /** @var \app\models\User $user */
        $user = $this->identity;
        $access = false;
        do {
            if (\Yii::$app->user->isGuest) {
                break;
            }

            if ($user->status === \app\models\User::USER_STATUS_ADMIN) {
                $access = true;
                break;
            }

            if (is_array($permissionName)) {
                $access = in_array($user->status, $permissionName);
            } else {
                $access = $permissionName === $user->status;
            }
        } while (false);

        return $access;
    }

    public static function findIdentity($id)
    {
        $user = static::findOne($id);
        if (!empty($user)) {
            return $user;
        }
        return null;

    }

    public static function  findIdentityByPasswordResetToken($token){
        $user = static::findOne(['password_reset_token' => $token]);
        if (!empty($user)) {
            return $user;
        }
        return null;
    }


    public static function findIdentityByAccessToken($tok, $type = null)
    {
        //auth_key==access token
        $user = static::findOne(['auth_key' => $tok]);
        if (!empty($user)) {
            return $user;
        }
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }

    public function validatePassword($password)
    {
        if (password_verify($password . Yii::$app->params['SALT'], $this->password)) {
            return true;
        } else return false;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
        ];
    }

    public static function isUserAdmin($username)
    {
        if (static::findOne(['username' => $username, 'status' => self::USER_STATUS_ADMIN])){

            return true;
        } else {

            return false;
        }

    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->password = password_hash($this->password . Yii::$app->params['SALT'], PASSWORD_BCRYPT);
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */

//    public static function findByUsername($username)
//    {
//        foreach (self::$users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                return new static($user);
//            }
//        }
//
//        return null;
 //   }

    /**
     * {@inheritdoc}
     */

}
