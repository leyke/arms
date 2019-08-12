<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rule}}`.
 */
class m190417_174033_create_rule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rule}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'event_id' => $this->integer(11),
            'condition_id' => $this->integer(11),
            'action_id' => $this->integer(11)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rule}}');
    }
}
