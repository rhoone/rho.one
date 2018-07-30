<?php

namespace common\rhoone\curriculum\models;

use Yii;

/**
 * This is the model class for table "{{%curriculum_college}}".
 *
 * @property string $guid
 * @property string $name
 * @property string $alias
 * @property string $idprefix
 */
class College extends \vistart\Models\models\BaseEntityModel
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
        return '{{%curriculum_college}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['guid', 'name'], 'required'],
            [['guid'], 'string', 'max' => 36],
            [['name', 'alias', 'idprefix'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
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
            'idprefix' => Yii::t('app', 'ID Prefix'),
        ];
    }
}
