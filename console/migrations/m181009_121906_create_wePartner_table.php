<?php

use yii\db\Migration;

/**
 * Handles the creation of table `wePartner`.
 */
class m181009_121906_create_wePartner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('wePartner', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('wePartner');
    }
}
