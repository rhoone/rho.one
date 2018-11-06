<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link https://vistart.name/
 * @copyright Copyright (c) 2016-2018 vistart
 * @license https://vistart.name/license/
 */

namespace console\modules\spider\target\library;

use console\modules\spider\target\library\TongjiUniversity\models\Item;
use console\modules\spider\target\library\TongjiUniversity\models\Marc;
use Sunra\PhpSimple\HtmlDomParser;

/**
 * 同济大学图书馆页面描述和抓取。
 *
 * @author vistart <i@vistart.name>
 */
class TongjiUniversity extends LibraryTarget
{

    public $host = 'webpac.lib.tongji.edu.cn';
    public $relativeUrl = '/opac/item.php';
    public $identityParam = 'marc_no';
    public $identityFormat = '%010s';
    public $identityStart = 1;
    public $identityTotal = 1;
    public $marcSelector = '#item_detail .booklist';
    public $bookSelector = 'div#tabs2 table#item tbody .whitetext';
    public $statusSelector = 'div#mainbox div#container div#content_item div.book_article p#marc';
    public $marcNo;

    /**
     * 获取机读目录编号。
     * @param null|int $identity 编号
     * 若此参数为空，则获取当前编号值；若不为空，则获取下一个编号值。
     * @return string
     */
    public function getMarcNo($identity = null)
    {
        if ($identity !== null) {
            $this->marcNo = sprintf($this->identityFormat, (string) (((int) $identity) + 1));
        }
        return $this->marcNo;
    }

    /**
     * 获取下一个绝对地址。
     * @param null|array $params 参数。此参数应当为键值对，以帮助确定下一个地址。
     * @return bool|string 若 $params 参数为空，则返回 false；否则为下一个绝对地址。
     */
    public function getNextAbsoluteUrl(&$params = null)
    {
        if (!empty($params) && is_array($params) && array_key_exists($this->identityParam, $params)) {
            $params[$this->identityParam] = $this->getMarcNo($params[$this->identityParam]);
            return $this->getAbsoluteUrl($params);
        }
        return false;
    }

    public function extractStatus($dom)
    {
        $domStatus = $dom->find($this->statusSelector);
        if (empty($domStatus)) {
            return [];
        }
        return $domStatus[0];
    }

    /**
     * 提取机读目录编号。
     * @param $dom
     * @return mixed
     */
    public function extractMarc($dom)
    {
        return $dom->find($this->marcSelector);
    }

    /**
     * 提取 ISBN。
     * @param $dom
     * @return array|void
     */
    public function extractISBN($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    /**
     * 提取价格。
     * @param $dom
     */
    public function extractPrice($dom)
    {
        
    }

    /**
     * 提取 ISBN 和价格。
     * @param $dom
     * @return array
     */
    public function extractISBNAndPrice($dom)
    {
        $contents = $dom->find('dd');
        $result = ['isbn' => [], 'price' => []];
        foreach ($contents as $content) {
            $componds = explode('/', $content->text());
            $result['isbn'][] = $this->gbk_decode(trim($componds[0]));
            $result['price'][] = $this->gbk_decode(trim(end($componds)));
        }
        return $result;
    }

    /**
     * 提取标题。
     * @param $dom
     * @return array|void
     */
    public function extractTitle($dom)
    {
        return $this->extractCommonInfo($dom);
    }

    /**
     * 提取标题，不含作者。
     * @param $dom
     * @return array
     */
    public function extractTitleExceptAuthor($dom)
    {
        $contents = $dom->find('dd');
        $result = [];
        foreach ($contents as $content) {
            print_r($this->gbk_decode($content->text()) . "\n");
            $componds = explode('/', $content->text());
            $result[] = $this->gbk_decode($componds[0]);
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

    /**
     * 提取通用信息。
     * @param $dom
     * @return array|void
     */
    public function extractCommonInfo($dom)
    {
        $contents = $dom->find('dd');
        $result = [];
        foreach ($contents as $content) {
            $result[] = $this->gbk_decode(trim($content->text()));
        }
        return $result;
    }

    /**
     * 组合机读信息。
     * @param $item
     * @return array|Marc|null|\yii\db\ActiveRecord
     */
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

    /**
     * 提取馆藏数目信息。
     * @param $dom
     * @return mixed
     */
    public function extractBooks($dom)
    {
        return $dom->find($this->bookSelector);
    }

    /**
     * 组合馆藏数目信息。
     * @param $books
     * @return array
     */
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

    /**
     * 修改配置。
     * @param $config
     */
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

    /**
     * 抓取
     * @param null $config
     * @return int|mixed
     * @throws \yii\db\Exception
     */
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
            self::writeFile($dom,  "spider/Library/TongjiUniversity/" . $this->getMarcNo() . ".html");
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

            $status = new TongjiUniversity\models\Status();
            $status->marc_no = $marcModel->marc_no;
            $status->marcStatus = $this->extractStatus($dom)->innertext();
            $trans = $marcModel->getDb()->beginTransaction();
            try {
                if (!$status->save()) {
                    print_r($status->getErrors());
                    throw new \yii\db\IntegrityException("Something error(s) with status occured.\r\n");
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
        $sleep = 1;
        try {
            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            if ($counter > 0) {
                echo "Retried successfully!\r\n";
            }
        } catch (\Exception $ex) {
            echo "Error occured at " . date('Y-m-d H:i:s') . "\r\n";
            echo $ex->getMessage() . "\r\n";
            $sleep *= $counter;
            echo "Sleep $sleep second:\r\n";
            sleep($sleep);
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

    /**
     * 写入文件。
     * @param $string
     * @param $filename
     * @param $mode
     */
    protected static function writeFile($string, $filename, $mode = "w")
    {
        $file = fopen($filename, $mode);
        fwrite($file, $string);
        fclose($file);
    }

    /**
     * 解码 GBK。将 GBK 码转换为对应的文字。
     * @param $str
     * @param string $prefix
     * @param string $postfix
     * @param bool $ignore_non_gbk
     * @return string
     */
    private function gbk_decode($str, $prefix = '\&#x', $postfix = ';', $ignore_non_gbk = false)
    {
        /**
         * GBK 模式。
         * 例如 &#xffe5; 代表 ￥
         * 目前只能识别十六进制编码。
         * TODO: 识别十进制编码。
         */
        $gbk_pattern = "/" . $prefix . "[0-9a-zA-Z]{4}$postfix/";

        /**
         * 待搜索字符串偏移量。
         */
        $offset = 0;

        /**
         * 解码结果。
         */
        $result = "";
        while ($offset < strlen($str)) {
            $matches = null;
            $seperate = "";

            /**
             * 只匹配第一个匹配的字符串，同时得出偏移量。
             * 由于 $matches 中给出的偏移量并非以字节为准，故不采用其作为偏移量依据。而是每匹配一次，就排除已匹配结果。
             */
            preg_match($gbk_pattern, substr($str, $offset),$matches, PREG_OFFSET_CAPTURE);
            if (empty($matches) || empty($matches)) {
                continue;
            }
            if ($matches[0][1] > 0) { // 若条件成立，则代表第一个匹配值前有非gbk编码字符。
                $seperate .= substr($str, $offset, $matches[0][1]);
                $offset += strlen($seperate);
                if (!$ignore_non_gbk) { // 若不忽略非 GBK 字符，则附加在结果中。
                    $result .= $seperate;
                }
                continue;
            }

            /**
             * 附加单次匹配结果。
             */
            $seperate .= $matches[0][0];

            /**
             * 修改偏移量。
             * 注意，此处不使用 $matches 中提供的偏移量，因为那个值并非按字节衡量。
             */
            $offset += strlen($seperate);
            $result .= mb_chr((int)base_convert(substr($matches[0][0], 3, 4), 16, 10));
        }
        return $result;
    }
    /**
     * 查找标识符。
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
