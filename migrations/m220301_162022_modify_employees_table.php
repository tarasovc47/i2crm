<?php

use yii\db\Migration;

/**
 * Class m220301_162022_modify_employees_table
 */
class m220301_162022_modify_employees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('employees', 'name', $this->string()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('employees', 'name', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220301_162022_modify_employees_table cannot be reverted.\n";

        return false;
    }
    */
}
