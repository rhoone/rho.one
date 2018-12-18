<?php
/**
 * *
 *  *  _   __ __ _____ _____ ___  ____  _____
 *  * | | / // // ___//_  _//   ||  __||_   _|
 *  * | |/ // /(__  )  / / / /| || |     | |
 *  * |___//_//____/  /_/ /_/ |_||_|     |_|
 *  * @link https://vistart.name/
 *  * @copyright Copyright (c) 2016 vistart
 *  * @license https://vistart.name/license/
 *
 */

/**
 * Created by PhpStorm.
 * User: i
 * Date: 2018/12/17
 * Time: 16:44
 */

namespace console\modules\spider\target\library\TongjiUniversity\models;

use yii\base\InvalidArgumentException;

/**
 * Class BookDescriptor
 * @package console\modules\spider\target\library\TongjiUniversity\models
 * @property Marc marc
 */
class BookDescriptor extends \console\modules\spider\target\library\models\BookDescriptor
{
    /**
     * @var Marc
     */
    private $_marc;

    public function getMarc()
    {
        if ($this->_marc instanceof Marc)
        {
            return $this->_marc;
        }

        $marc = Marc::find()->where(['marc_no' => $this->marc_no])->one();
        if (!$marc) {
            throw new InvalidArgumentException("MARC_NO: $this->marc_no NOT FOUND.");
        }
        $this->_marc = $marc;
        return $this->_marc;
    }

    public function setMarc($marc)
    {
        if ($marc instanceof Marc)
        {
            $this->_marc = $marc;
            $this->refreshAttributes($this->_marc);
            return;
        }
        if (is_string($marc))
        {
            $marc = Marc::find()->where(['marc_no' => $marc])->one();
            if (!$marc) {
                throw new InvalidArgumentException("MARC_NO: $marc NOT FOUND.");
            }
            $this->_marc = $marc;
            $this->refreshAttributes($this->_marc);
            return;
        }
        throw new InvalidArgumentException("Invalid Marc Instance or Marc No.");
    }

    public function refreshAttributes($marc)
    {
        if (!$marc || !($marc instanceof Marc))
        {
            throw new InvalidArgumentException("Invalid Marc.");
        }
        $this->title = $marc->getTitle();
        $this->authors = array_filter($marc->getAuthor());
        $this->presses = array_filter($marc->getPress());
        $this->forms = array_filter($marc->getForm());
        $this->prices = array_filter($marc->getPrice());
        $this->abstract = $marc->abstract;
        $this->ISBNs = array_filter($marc->getISBN());
        $this->subjects = array_filter($marc->getSubject());
        $this->classes = array_filter($marc->getClass());
        $this->target_readers = $marc->target_reader;
        $this->marc_no = $marc->marc_no;

        $status = $marc->status;
        if ($status)
        {
            $this->status = $status->status;
            $this->page_visit = $status->page_visit;
            $this->type = $status->type;
        }

        $this->books = [];
        $items = $marc->items;
        foreach ($items as $item)
        {
            $book = new Book();
            $book->refreshAttributes($item);
            $this->books[] = $book;
        }

        if (count($this->books) > 0)
        {
            $this->call_no = $items[0]->call_no;
        }
    }
}