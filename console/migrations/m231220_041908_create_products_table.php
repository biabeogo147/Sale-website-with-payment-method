<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m231220_041908_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'product_id' => $this->string(16)->notNull(),
            'title' => $this->string(512)->notNull(),
            'description' => $this->text(),
            'tags' => $this->string(512),
            'status' => $this->smallInteger(1),
            'product_price' => $this->integer(11),
            'created_by' => $this->string(512),
        ]);

        $this->addPrimaryKey('PK_products_product_id', '{{%product}}', 'product_id');
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
