<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property EmployeesDepartment[] $employeesDepartments
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique', 'targetClass' => 'app\models\Department', 'targetAttribute' => 'title'],
            [['title'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::class, ['id' => 'employee_id'])
            ->viaTable('employees_departments', ['department_id' => 'id']);
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     * функция, выбирающая сотрудников данного отдела
     */
    public function getSelectedEmployees()
    {
        $selectedEmployees = $this->getEmployees()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedEmployees, 'id');
    }

    /**
     * @param $departments
     * функция приписывающая сотрудников в отделы
     */
    public function saveEmployees($employyes)
    {
        if (is_array($employyes))
        {
            $this->clearCurrentEmployees();
            foreach ($employyes as $employees_id) {
                $employee = Employee::findOne($employees_id);
                $this->link('employees', $employee);
            }
        }
    }

    /**
     * функция, удаляющая текущих сотрудников в отделе
     */
    private function clearCurrentEmployees()
    {
        EmployeeDepartment::deleteAll(['department_id' => $this->id]);
    }
}
