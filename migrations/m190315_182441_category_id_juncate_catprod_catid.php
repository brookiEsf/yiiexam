<?php

use yii\db\Migration;

/**
 * Class m190315_182441_category_id_juncate_catprod_catid
 */
class m190315_182441_category_id_juncate_catprod_catid extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-categories_id-catprod_catid',
            '{{%catprod}}',
            'cat_id'
        );
        $this->addForeignKey(
            'fk-categories_id-catprod_catid',
            '{{%catprod}}',
            'cat_id',
            '{{%categories}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-categories_id-catprod_catid', '{{%catprod}}');
        $this->dropIndex('idx-categories_id-catprod_catid', '{{%catprod}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190315_182441_category_id_juncate_catprod_catid cannot be reverted.\n";

        return false;
    }
    */
}
