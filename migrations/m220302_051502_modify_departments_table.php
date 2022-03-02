<?php

use yii\db\Migration;

/**
 * Class m220302_051502_modify_departments_table
 */
class m220302_051502_modify_departments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('departments', 'title', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220302_051502_modify_departments_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220302_051502_modify_departments_table cannot be reverted.\n";

        return false;
    }
    */
}
