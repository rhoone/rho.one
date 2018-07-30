<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link https://vistart.name/
 * @copyright Copyright (c) 2016 vistart
 * @license https://vistart.name/license/
 */

namespace console\modules\spider\target\library;

use console\modules\spider\target\library\LibraryTarget;
use console\modules\spider\target\library\TongjiUniversity\models\Item;
use console\modules\spider\target\library\TongjiUniversity\models\Marc;
use Sunra\PhpSimple\HtmlDomParser;

/**
 * Description of TongjiUniversity
 *
 * @author vistart <i@vistart.name>
 */
class TongjiUniversity extends LibraryTarget
{

    public $host = 'webpac.lib.tongji.edu.cn';
    public $relativeUrl = '/opac/item.php';
    public $identityParam = 'marc_no';
    public $identityFormat = '%010s';
    public $identityStart = 2326677;
    public $identityTotal = 1;
    public $marcSelector = '#item_detail .booklist';
    public $bookSelector = 'div#tabs2 table#item tbody .whitetext';
    public $marcNo;

    public function getMarcNo($identity = null)
    {
        if ($identity !== null) {
            $this->marcNo = sprintf($this->identityFormat, (string) (((int) $identity) + 1));
        }
        return $this->marcNo;
    }

    public function getNextAbsoluteUrl(&$params = null)
    {
        if (!empty($params) && is_array($params) && array_key_exists($this->identityParam, $params)) {
            $params[$this->identityParam] = $this->getMarcNo($params[$this->identityParam]);
            return $this->getAbsoluteUrl($params);
        }
        return false;
    }

    public function extractMarc($dom)
    {
        return $dom->find($this->marcSelector);
    }

    public function extractISBN($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractPrice($dom)
    {
        
    }

    public function extractISBNAndPrice($dom)
    {
        $contents = $dom->find('dd');
        $result = ['isbn' => [], 'price' => []];
        foreach ($contents as $content) {
            $componds = explode('/', $content->text());
            $result['isbn'][] = $this->unicode_decode(str_replace(';', '', (str_replace('&#x', '\u', trim($componds[0])))));
            $result['price'][] = $this->unicode_decode(str_replace(';', '', (str_replace('&#x', '\u', trim(end($componds))))));
        }
        return $result;
    }

    public function extractTitle($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractTitleExceptAuthor($dom)
    {
        $contents = $dom->find('dd');
        $result = [];
        foreach ($contents as $content) {
            $componds = explode('/', $content->text());
            $result[] = $this->unicode_decode(str_replace(';', '', (str_replace('&#x', '\u', trim($componds[0])))));
        }
        return $result;
    }

    public function extractClass($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractForm($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractAuthor($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractPress($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractGeneralRemark($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractAbstract($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractSubject($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractTarget($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractUniformTitle($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractAdditionalTitle($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    public function extractCommonInfo($dom)
    {
        $contents = $dom->find('dd');
        $result = [];
        foreach ($contents as $content) {
            $result[] = $this->unicode_decode(str_replace(';', '', (str_replace('&#x', '\u', trim($content->text())))));
        }
        return $result;
    }

    public function populateMarc($item)
    {
        $model = Marc::find()->where(['marc_no' => $this->getMarcNo()])->one();
        if (!$model) {
            $model = new Marc(['marc_no' => $this->getMarcNo()]);
        }
        foreach ($item as $i) {
            $header = $i->find('dt');
            switch ($header[0]) {
                case strpos($header[0]->text(), '题名/责任者') === 0:
                    $result = $this->extractTitleExceptAuthor($i);
                    $model->title = ($result[0]);
                    break;
                case strpos(strtolower($header[0]->text()), 'isbn及定价') === 0:
                    $result = $this->extractISBNAndPrice($i);
                    $model->appendISBN($result['isbn'][0]);
                    $model->appendPrice($result['price'][0]);
                    break;
                case strpos($header[0]->text(), '载体形态项') === 0:
                    $result = ($this->extractForm($i));
                    $model->appendForm($result[0]);
                    break;
                case strpos($header[0]->text(), '个人责任者') === 0:
                    $result = ($this->extractAuthor($i));
                    $model->appendAuthor($result[0]);
                    break;
                case strpos($header[0]->text(), '团体责任者') === 0:
                    $result = ($this->extractAuthor($i));
                    $model->appendGroupAuthor($result[0]);
                    break;
                case strpos($header[0]->text(), '中图法分类号') === 0:
                    $result = ($this->extractClass($i));
                    $model->appendClass($result[0]);
                    break;
                case strpos($header[0]->text(), '出版发行项') === 0:
                    $result = ($this->extractPress($i));
                    $model->appendPress($result[0]);
                    break;
                case strpos($header[0]->text(), '学科主题') === 0:
                    $result = ($this->extractSubject($i));
                    $model->appendSubject($result[0]);
                    break;
                case strpos($header[0]->text(), '一般附注') === 0:
                    $result = ($this->extractGeneralRemark($i));
                    $model->general_remark = $result[0];
                    break;
                case strpos($header[0]->text(), '提要文摘附注') === 0:
                    $result = ($this->extractAbstract($i));
                    $model->abstract = $result[0];
                    break;
                case strpos($header[0]->text(), '使用对象附注') === 0:
                    $result = ($this->extractTarget($i));
                    $model->target_reader = $result[0];
                    break;
                case strpos($header[0]->text(), '题名责任附注') === 0:
                    $result = ($this->extractTarget($i));
                    $model->appendAuthorRemark($result[0]);
                    break;
                case strpos($header[0]->text(), '并列正题名') === 0:
                    $result = ($this->extractUniformTitle($i));
                    $model->appendUniformTitle($result[0]);
                    break;
                case strpos($header[0]->text(), '其它题名') === 0:
                    $result = ($this->extractAdditionalTitle($i));
                    $model->appendAdditionalTitle($result[0]);
                    break;
                case strpos(strtolower($header[0]->text()), 'isbn') === 0:
                    $result = ($this->extractISBN($i));
                    $model->appendISBN($result[0]);
                    break;
            }
        }
        return $model;
    }

    public function extractBooks($dom)
    {
        return $dom->find($this->bookSelector);
    }

    public function populateBooks($books)
    {
        $items = [];
        foreach ($books as $book) {
            $item = $book->find('td');
            if (count($item) < 5) {
                continue;
            }
            $call_no = trim(str_replace('&nbsp;', ' ', htmlspecialchars_decode($item[0]->text())));
            $barcode = trim(str_replace('&nbsp;', ' ', htmlspecialchars_decode($item[1]->text())));
            $volume_period = trim(str_replace('&nbsp;', ' ', htmlspecialchars_decode($item[2]->text())));
            $position = trim(str_replace('&nbsp;', ' ', htmlspecialchars_decode($item[3]->text())));
            $status = trim(str_replace('&nbsp;', ' ', htmlspecialchars_decode($item[4]->text())));

            $item = Item::find()->where(['marc_no' => $this->getMarcNo(), 'barcode' => $barcode])->one();
            if (!$item) {
                $item = new Item(['marc_no' => $this->getMarcNo(), 'barcode' => $barcode]);
            }
            $item->call_no = $call_no;
            $item->volume_period = $volume_period;
            $item->position = $position;
            $item->status = $status;
            $items[] = $item;
        }
        return $items;
    }

    protected function changeConfig($config)
    {
        if (!is_array($config)) {
            $config = (array) $config;
        }
        if (isset($config['start'])) {
            if (!is_numeric($config['start'])) {
                $config['start'] = 1;
            }
            $this->identityStart = (int) $config['start'];
        }
        if (isset($config['count'])) {
            if (!is_numeric($config['count'])) {
                $config['config'] = 1;
            }
            $this->identityTotal = (int) $config['count'];
        }
    }

    public function crawl($config = null)
    {
        $this->changeConfig($config);
        $counter = 0;
        $emptyCounter = 0;
        $success = 0;
        $params = [$this->identityParam => $this->identityStart - 1];
        while ($counter < $this->identityTotal) {
            echo $this->getMarcNo($params[$this->identityParam]) . ":\r\n";
            $url = $this->getNextAbsoluteUrl($params);
            $dom = static::getHtml($url);
            if (empty($dom)) {
                $emptyCounter++;
                $counter++;
                continue;
            }

            // Store MARC.
            $marc = $this->extractMarc($dom);
            $marcModel = $this->populateMarc($marc);
            $trans = $marcModel->getDb()->beginTransaction();
            try {
                if (empty($marcModel->title)) {
                    $emptyCounter++;
                    throw new \yii\db\IntegrityException("Empty MARC.\r\n");
                }
                if (!$marcModel->save()) {
                    print_r($marcModel->getErrors());
                    throw new \yii\db\IntegrityException("Something error(s) occured.\r\n");
                }
                $trans->commit();
            } catch (\Exception $ex) {
                $trans->rollBack();
                echo $ex->getMessage();
                $counter++;
                continue;
            }

            // Store books associated with current MARC.
            $books = $this->extractBooks($dom);
            $bookModels = $this->populateBooks($books);
            $trans = $marcModel->getDb()->beginTransaction();
            try {
                $bookCounter = 0;
                $errorList = [];
                foreach ($bookModels as $model) {
                    if (!$model->save()) {
                        $errorList[] = $model->getErrors();
                    } else {
                        $bookCounter++;
                    }
                }
                if (!empty($errorList)) {
                    foreach ($errorList as $error) {
                        print_r($error);
                        echo "\r\n";
                    }
                }
                echo "$bookCounter crawled.\r\n";
                $trans->commit();
            } catch (\Exception $ex) {
                $trans->rollBack();
                echo $ex->getMessage();
                $counter++;
                continue;
            }
            $counter++;
            $success++;
        }
        if ($emptyCounter) {
            echo "$emptyCounter are empty.\r\n";
        }
        return $success;
    }

    /**
     * Get HTML Dom from $url.
     * @param string $url
     * @return type
     */
    protected static function getHtml($url)
    {
        $counter = 0;
        retry:
        try {
            $dom = HtmlDomParser::file_get_html($url);
            if ($counter > 0) {
                echo "Retried successfully!\r\n";
            }
        } catch (\Exception $ex) {
            echo "Error occured at " . date('Y-m-d H:i:s') . "\r\n";
            echo $ex->getMessage() . "\r\n";
            echo "Sleep 1 second:\r\n";
            sleep(1);
            if ($counter < 5) {
                $counter++;
                echo "Retry $counter:\r\n";
                goto retry;
            } else {
                $dom = null;
            }
        }
        return $dom;
    }

    private function unicode_decode($name)
    {
        $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
        preg_match_all($pattern, $name, $matches);
        if (!empty($matches)) {
            $name = '';
            for ($j = 0; $j < count($matches[0]); $j++) {
                $str = $matches[0][$j];
                if (strpos($str, '\\u') === 0) {
                    $code = base_convert(substr($str, 2, 2), 16, 10);
                    $code2 = base_convert(substr($str, 4), 16, 10);
                    $c = chr($code) . chr($code2);
                    $c = iconv('UCS-2', 'UTF-8', $c);
                    $name .= $c;
                } else {
                    $name .= $str;
                }
            }
        }
        return $name;
    }

    /**
     * 
     * @param string $identity
     * @return Marc
     */
    public function find($identity)
    {
        $marc = Marc::find()->where(['marc_no' => $identity])->one();
        /* @var $marc Marc */
        if (!$marc) {
            return false;
        }
        print_r($marc->getTitle()) . "\r\n";
        print_r($marc->getISBN()) . "\r\n";
        print_r($marc->getPrice()) . "\r\n";
        print_r($marc->getPress()) . "\r\n";
        print_r($marc->getForm()) . "\r\n";
        print_r($marc->getUniformTitle()) . "\r\n";
        $items = $marc->items;
        foreach ($items as $item) {
            echo $item->call_no . ' : ' . $item->barcode . ' : ' . (empty($item->volume_period) ? "<empty>" : $item->volume_period) . ' : ' . $item->position . ' : ' . $item->status . "\r\n";
        }
        return true;
    }
}
