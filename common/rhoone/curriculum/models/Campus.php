<?php

namespace common\rhoone\curriculum\models;

use Yii;

/**
 * This is the model class for table "{{%curriculum_campus}}".
 *
 * @property string $guid
 * @property string $name
 * @property string $alias
 *
 * @property Curriculum[] $curriculums
 */
class Campus extends \vistart\Models\models\BaseEntityModel
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
        return '{{%curriculum_campus}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['name', 'alias'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'alias' => Yii::t('app', 'Alias'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculums()
    {
        return $this->hasMany(Curriculum::className(), ['campus' => 'guid']);
    }
}
