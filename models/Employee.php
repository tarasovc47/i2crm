<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['name'], 'unique', 'targetClass' => 'app\models\Employee', 'targetAttribute' => 'name']
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

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::class, ['id' => 'department_id'])
            ->viaTable('employees_departments', ['employee_id' => 'id']);
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     * функция, выбирающая текущие отделы у данного сотрудника
     */
    public function getSelectedDepartments()
    {
        $selectedDepartments = $this->getDepartments()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedDepartments, 'id');
    }

    /**
     * @param $departments
     * функция приписывающая отделы сотруднику
     */
    public function saveDepartments($departments)
    {
        if (is_array($departments))
        {
            $this->clearCurrentDepartments();
            foreach ($departments as $department_id) {
                $department = Department::findOne($department_id);
                $this->link('departments', $department);
            }
        }
    }

    /**
     * функция, удаляющая текущие отделы сотрудника
     */
    private function clearCurrentDepartments()
    {
        EmployeeDepartment::deleteAll(['employee_id' => $this->id]);
    }
}
