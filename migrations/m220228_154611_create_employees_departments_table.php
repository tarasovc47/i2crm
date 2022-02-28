<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employees_departments}}`.
 */
class m220228_154611_create_employees_departments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employees_departments}}', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer(),
            'department_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-employee',
            'employees_departments',
            'employee_id',
            'employees',
            'id'
        );

        $this->addForeignKey(
            'fk-department',
            'employees_departments',
            'department_id',
            'departments',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employees_departments}}');
    }
}
