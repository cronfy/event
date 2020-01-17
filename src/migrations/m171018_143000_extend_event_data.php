<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event`.
 */
class m171018_143000_extend_event_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->alterColumn('event', 'data', $this->string(1024));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        return true;
    }
}
