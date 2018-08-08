<?php

namespace console\modules\spider\target\library\TongjiUniversity\models;

use rhosocial\base\Models\models\BaseEntityModel;
use Yii;

/**
 * This is the model class for table "{{%crawl_library_tongjiuniversity_marc}}".
 *
 * @property string $guid
 * @property string $marc_no
 * @property string $ISBN
 * @property string $title
 * @property string $price
 * @property string $press
 * @property string $form
 * @property string $uniform_title
 * @property string $additional_title
 * @property string $disc
 * @property string $author
 * @property string $group_author
 * @property string $subject
 * @property string $class
 * @property string $general_remark
 * @property string $version_remark
 * @property string $publish_remark
 * @property string $author_remark
 * @property string $abstract
 * @property string $target_reader
 * @property string $create_time
 * @property string $update_time
 *
 * @property Item[] $items
 */
class Marc extends BaseEntityModel
{

    public $idAttribute = false;
    public $enableIP = 0;

    public function init()
    {
        $this->queryClass = MarcQuery::class;
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%crawl_library_tongjiuniversity_marc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['marc_no'], 'required'],
            [['title', 'ISBN', 'price', 'uniform_title', 'additional_title', 'author', 'group_author', 'subject', 'general_remark', 'version_remark', 'publish_remark', 'author_remark', 'abstract', 'target_reader'], 'default', 'value' => ''],
            [['title', 'ISBN', 'price', 'uniform_title', 'additional_title', 'author', 'group_author', 'subject', 'general_remark', 'version_remark', 'publish_remark', 'author_remark', 'abstract', 'target_reader'], 'string'],
            [['marc_no'], 'string', 'max' => 20],
            [['press', 'form', 'disc', 'class'], 'string', 'max' => 255],
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
            'ISBN' => Yii::t('app', 'Isbn'),
            'title' => Yii::t('app', 'Title'),
            'price' => Yii::t('app', 'Price'),
            'press' => Yii::t('app', 'Press'),
            'form' => Yii::t('app', 'Form'),
            'uniform_title' => Yii::t('app', 'Uniform Title'),
            'additional_title' => Yii::t('app', 'Additional Title'),
            'disc' => Yii::t('app', 'Disc'),
            'author' => Yii::t('app', 'Author'),
            'group_author' => Yii::t('app', 'Group Author'),
            'subject' => Yii::t('app', 'Subject'),
            'class' => Yii::t('app', 'Class'),
            'general_remark' => Yii::t('app', 'General Remark'),
            'version_remark' => Yii::t('app', 'Version Remark'),
            'publish_remark' => Yii::t('app', 'Publish Remark'),
            'author_remark' => Yii::t('app', 'Author Remark'),
            'abstract' => Yii::t('app', 'Abstract'),
            'target_reader' => Yii::t('app', 'Target Reader'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    public function getTitle()
    {
        return ($this->title);
    }

    public function setTitle($title)
    {
        return $this->title = ($title);
    }

    public function getISBN()
    {
        return json_decode($this->ISBN);
    }

    public function setISBN($ISBN)
    {
        return $this->ISBN = json_encode($ISBN);
    }

    public function appendISBN($ISBN)
    {
        return $this->appendAttribute('ISBN', $ISBN);
    }

    public function getPrice()
    {
        return json_decode($this->price);
    }

    public function setPrice($price)
    {
        return $this->price = json_encode($price);
    }

    public function appendPrice($price)
    {
        return $this->appendAttribute('price', $price);
    }

    public function getPress()
    {
        return json_decode($this->press);
    }

    public function setPress($press)
    {
        return $this->press = json_encode($press);
    }

    public function appendPress($press)
    {
        return $this->appendAttribute('press', $press);
    }

    public function getForm()
    {
        return json_decode($this->form);
    }

    public function setForm($form)
    {
        return $this->form = json_encode($form);
    }

    public function appendForm($form)
    {
        return $this->appendAttribute('form', $form);
    }

    public function getUniformTitle()
    {
        return json_decode($this->uniform_title);
    }

    public function setUniformTitle($uniform_title)
    {
        return $this->uniform_title = json_encode($uniform_title);
    }

    public function appendUniformTitle($uniform_title)
    {
        return $this->appendAttribute('uniform_title', $uniform_title);
    }

    public function getAdditionalTitle()
    {
        return json_decode($this->additional_title);
    }

    public function setAdditionalTitle($additional_title)
    {
        return $this->additional_title = json_encode($additional_title);
    }

    public function appendAdditionalTitle($additional_title)
    {
        return $this->appendAttribute('additional_title', $additional_title);
    }

    public function getAuthor()
    {
        return json_decode($this->author);
    }

    public function setAuthor($author)
    {
        return $this->author = json_encode($author);
    }

    public function appendAuthor($author)
    {
        return $this->appendAttribute('author', $author);
    }

    public function getGroupAuthor()
    {
        return json_decode($this->group_author);
    }

    public function setGroupAuthor($group_author)
    {
        return $this->group_author = json_encode($group_author);
    }

    public function appendGroupAuthor($group_author)
    {
        return $this->appendAttribute('group_author', $group_author);
    }
    
    public function getAuthorRemark()
    {
        return json_decode($this->author_remark);
    }
    
    public function setAuthorRemark($remark)
    {
        return $this->author_remark = json_encode($remark);
    }
    
    public function appendAuthorRemark($remark)
    {
        return $this->appendAttribute('author_remark', $remark);
    }

    public function getSubject()
    {
        return json_decode($this->subject);
    }

    public function setSubject($subject)
    {
        return $this->subject = json_encode($subject);
    }

    public function appendSubject($subject)
    {
        return $this->appendAttribute('subject', $subject);
    }

    public function getClass()
    {
        return json_decode($this->class);
    }

    public function setClass($class)
    {
        return $this->class = json_encode($class);
    }

    public function appendClass($class)
    {
        return $this->appendAttribute('class', $class);
    }

    public function appendAttribute($name, $value, $skipExist = true)
    {
        $values = json_decode($this->getAttribute($name));
        if (empty($values)) {
            $values = [];
        }
        if (!($skipExist && in_array($value, $values))) {
            $values[] = $value;
        }
        return $this->setAttribute($name, json_encode($values));
    }

    /**
     * @return ItemQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['marc_no' => 'marc_no']);
    }
}
