<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property EmployeesDepartment[] $employeesDepartments
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[EmployeesDepartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeesDepartments()
    {
        return $this->hasMany(EmployeesDepartment::className(), ['employee_id' => 'id']);
    }
}
