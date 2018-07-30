<?php

namespace common\rhoone\curriculum\models;

use Yii;

/**
 * This is the model class for table "{{%curriculum_semester}}".
 *
 * @property string $guid
 * @property string $name
 * @property string $start
 * @property string $end
 *
 * @property Curriculum[] $curriculums
 */
class Semester extends \vistart\Models\models\BaseEntityModel
{
    public $idAttribute = false;
    public $enableIP = 0;
    public $createdAtAttribute = false;
    public $updatedAtAttribute = false;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%curriculum_semester}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['start', 'end'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guid' => Yii::t('app', 'Guid'),
            'name' => Yii::t('app', 'Name'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculums()
    {
        return $this->hasMany(Curriculum::className(), ['semester_guid' => 'guid']);
    }
}
