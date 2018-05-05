<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event`.
 */
class m171018_142635_create_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'namespace' => $this->string()->notNull(),
            'object_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'data' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 ENGINE=InnoDb');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('event');
    }
}
