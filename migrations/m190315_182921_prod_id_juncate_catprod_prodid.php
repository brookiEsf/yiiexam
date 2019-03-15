<?php

use yii\db\Migration;

/**
 * Class m190315_182921_prod_id_juncate_catprod_prodid
 */
class m190315_182921_prod_id_juncate_catprod_prodid extends Migration
{
    public function safeUp()
    {
        $this->createIndex(
            'idx-prod_id-catprod_prodid',
            '{{%catprod}}',
            'prod_id'
        );
        $this->addForeignKey(
            'fk-prod_id-catprod_prodid',
            '{{%catprod}}',
            'prod_id',
            '{{%products}}',
            'id'
        );

        $this->batchInsert('{{%catprod}}', ['prod_id', 'cat_id','created_at'],
            [
                [1, 1, date('y-m-d h:i:s')],
                [1, 2, date('y-m-d h:i:s')],
                [2, 2, date('y-m-d h:i:s')],
                [2, 1, date('y-m-d h:i:s')],
                [3, 3, date('y-m-d h:i:s')],
                [3, 1, date('y-m-d h:i:s')],
                [4, 4, date('y-m-d h:i:s')],
                [6, 6, date('y-m-d h:i:s')],
                [5, 4, date('y-m-d h:i:s')],
                [7, 6, date('y-m-d h:i:s')],
                [8, 6, date('y-m-d h:i:s')],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-prod_id-catprod_prodid', '{{%catprod}}');
        $this->dropIndex('idx-prod_id-catprod_prodid', '{{%catprod}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190315_182921_prod_id_juncate_catprod_prodid cannot be reverted.\n";

        return false;
    }
    */
}
