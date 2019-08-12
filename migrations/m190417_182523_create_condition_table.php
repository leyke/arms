<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%condition}}`.
 */
class m190417_182523_create_condition_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%condition}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'context' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%condition}}');
    }
}
