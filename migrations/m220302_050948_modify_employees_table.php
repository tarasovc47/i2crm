<?php

use yii\db\Migration;

/**
 * Class m220302_050948_modify_employees_table
 */
class m220302_050948_modify_employees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('employees', 'department_id', $this->integer()->notNull());
        $this->alterColumn('employees', 'name', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('employees', 'department_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220302_050948_modify_employees_table cannot be reverted.\n";

        return false;
    }
    */
}
