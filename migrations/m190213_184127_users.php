<?php

use yii\db\Migration;

/**
 * Class m190213_184127_users
 */
class m190213_184127_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        }
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32)->unique()->notNull(),
            'password' => $this->string(95)->notNull(),
            'email' => $this->string(255)->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'auth_key' => $this->string(32)->notNull(),
            'password_reset_token' => $this->string(32)->unique()
            //status: 1-зареєстр, 10-підтверджений, 11-редактор, 100-адмін

        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m190213_184127_users cannot be reverted.\n";
        $this->dropTable('{{%users}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190213_184127_users cannot be reverted.\n";

        return false;
    }
    */
}
