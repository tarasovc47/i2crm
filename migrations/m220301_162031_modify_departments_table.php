<?php

use yii\db\Migration;

/**
 * Class m220301_162031_modify_departments_table
 */
class m220301_162031_modify_departments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('departments', 'title', $this->string()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('departments', 'title', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220301_162031_modify_departments_table cannot be reverted.\n";

        return false;
    }
    */
}
