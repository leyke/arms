<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m190417_180951_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'context' => $this->text(),
            'event_id' => $this->integer(11)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event}}');
    }
}
