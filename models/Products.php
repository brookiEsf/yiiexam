<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $prod_name
 * @property string $prod_definition
 * @property int $price
 * @property string $created_at
 * @property string $updated_at
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prod_name', 'prod_definition'], 'required'],
            [['price'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['prod_name'], 'string', 'max' => 95],
            [['prod_definition'], 'string', 'max' => 325],
            [['prod_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prod_name' => 'Prod Name',
            'prod_definition' => 'Prod Definition',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
