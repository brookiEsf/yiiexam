<?php

use yii\db\Migration;

/**
 * Class m190315_173254_catprod
 */
class m190315_173254_catprod extends Migration
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
        $this->createTable('{{%catprod}}', [
            'id' => $this->primaryKey(),
            'cat_id' => $this->integer(95)->notNull(),
            'prod_id' => $this->integer(95)->notNull(),
            'created_at' => $this->timestamp(),

        ], $tableOptions);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m190213_184127_users cannot be reverted.\n";
        $this->dropTable('{{%catprod}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190315_173254_catprod cannot be reverted.\n";

        return false;
    }
    */
}
