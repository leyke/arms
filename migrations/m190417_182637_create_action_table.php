<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%action}}`.
 */
class m190417_182637_create_action_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%action}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'text' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%action}}');
    }
}
