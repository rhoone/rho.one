<?php

namespace console\modules\spider\target\library\TongjiUniversity\models;

use vistart\Models\models\BaseEntityModel;
use Yii;

/**
 * This is the model class for table "{{%crawl_library_tongjiuniversity_item}}".
 *
 * @property string $guid
 * @property string $marc_no
 * @property string $call_no
 * @property string $barcode
 * @property string $volume_period
 * @property string $position
 * @property string $status
 * @property string $create_time
 * @property string $update_time
 *
 * @property Marc $marc
 */
class Item extends BaseEntityModel
{

    public $idAttribute = false;
    public $enableIP = 0;

    public function init()
    {
        $this->queryClass = ItemQuery::className();
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%crawl_library_tongjiuniversity_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['marc_no', 'call_no', 'barcode'], 'required'],
            [['marc_no', 'barcode'], 'string', 'max' => 20],
            [['call_no'], 'string', 'max' => 64],
            [['volume_period', 'position', 'status'], 'string', 'max' => 255],
            [['marc_no'], 'exist', 'skipOnError' => true, 'targetClass' => Marc::className(), 'targetAttribute' => ['marc_no' => 'marc_no']],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guid' => Yii::t('app', 'Guid'),
            'marc_no' => Yii::t('app', 'Marc No'),
            'call_no' => Yii::t('app', 'Call No'),
            'barcode' => Yii::t('app', 'Barcode'),
            'volume_period' => Yii::t('app', 'Volume Period'),
            'position' => Yii::t('app', 'Position'),
            'status' => Yii::t('app', 'Status'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return MarcQuery
     */
    public function getMarc()
    {
        return $this->hasOne(Marc::className(), ['marc_no' => 'marc_no']);
    }
}
