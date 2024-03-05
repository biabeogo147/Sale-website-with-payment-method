<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction_info}}`.
 */
class m231226_040654_create_transaction_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaction_info}}', [
            'id' => $this->primaryKey(),
            'is_success' => $this->integer(1)->notNull(),
            'transaction_code' => $this->string(16)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transaction_info}}');
    }
}
