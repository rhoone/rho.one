<?php

namespace common\rhoone\curriculum\models;

use Yii;

/**
 * This is the model class for table "{{%curriculum_curriculum}}".
 *
 * @property string $guid
 * @property string $id
 * @property string $campus_guid
 * @property string $semester_guid
 * @property string $name
 * @property double $period
 * @property double $credit
 * @property integer $exam
 * @property integer $start
 * @property integer $end
 * @property string $teacher
 * @property string $title
 * @property integer $capacity
 * @property integer $actual
 * @property string $schedule
 * @property string $remark
 * @property string $description
 *
 * @property Campus $campus
 * @property Semester $semester
 */
class Curriculum extends \vistart\Models\models\BaseEntityModel
{
    public $idAttributeLength = 8;
    public $enableIP = 0;
    public $createdAtAttribute = false;
    public $updatedAtAttribute = false;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%curriculum_curriculum}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['guid', 'id', 'campus_guid', 'semester_guid', 'teacher', 'schedule'], 'required'],
            [['period', 'credit'], 'number'],
            [['exam', 'start', 'end', 'capacity', 'actual'], 'integer'],
            [['guid', 'campus_guid', 'semester_guid'], 'string', 'max' => 36],
            [['id'], 'string', 'max' => 8],
            [['name', 'teacher', 'title', 'schedule', 'remark', 'description'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['campus_guid'], 'exist', 'skipOnError' => true, 'targetClass' => Campus::className(), 'targetAttribute' => ['campus_guid' => 'guid']],
            [['semester_guid'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_guid' => 'guid']],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guid' => Yii::t('app', 'Guid'),
            'id' => Yii::t('app', 'ID'),
            'campus_guid' => Yii::t('app', 'Campus Guid'),
            'semester_guid' => Yii::t('app', 'Semester Guid'),
            'name' => Yii::t('app', 'Name'),
            'period' => Yii::t('app', 'Period'),
            'credit' => Yii::t('app', 'Credit'),
            'exam' => Yii::t('app', 'Exam'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'teacher' => Yii::t('app', 'Teacher'),
            'title' => Yii::t('app', 'Title'),
            'capacity' => Yii::t('app', 'Capacity'),
            'actual' => Yii::t('app', 'Actual'),
            'schedule' => Yii::t('app', 'Schedule'),
            'remark' => Yii::t('app', 'Remark'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampus()
    {
        return $this->hasOne(Campus::className(), ['guid' => 'campus_guid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(Semester::className(), ['guid' => 'semester_guid']);
    }
}
