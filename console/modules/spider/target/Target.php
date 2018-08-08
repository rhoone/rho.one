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

namespace console\modules\spider\target;

/**
 * Description of Config
 *
 * @author vistart <i@vistart.name>
 */
abstract class Target
{
    /**
     * @var string 主机。即待抓取页面所在主机。
     */
    public $host = 'localhost';

    /**
     * @var int 端口。即待抓取页面所在主机开放的端口。
     */
    public $port = 80;

    /**
     * @var string 协议。即访问待抓取页面使用的协议。
     * 修改此参数不会影响 $port 属性。如果此属性修改为'https'，而 $port 属性不会自动改为 443 或其他值，而是依然维持
     * 原有值。
     */
    public $scheme = 'http';

    /**
     * @var string 相对地址。即去掉协议和主机之后的 URL 部分。
     */
    public $relativeUrl;

    /**
     * 获取绝对地址。
     * @param array $params
     * @return string
     */
    public function getAbsoluteUrl($params = null)
    {
        $url = $this->scheme . '://' . $this->host . ((string) $this->port == '80' ? '' : ":$this->port") . $this->relativeUrl;
        if (!empty($params) && is_array($params)) {
            $url .= '?';
            foreach ($params as $key => $param) {
                if (!is_string($key)) {
                    continue;
                }
                $url .= $key . '=' . $param;
                if (end($params) !== $param) {
                    $url .= '&';
                }
            }
        }
        return $url;
    }

    /**
     * 获取下一个绝对地址。
     * 此功能默认与 getAbsoluteUrl() 方法相同。如有需要，请自行实现。
     * @param array $params
     * @return string
     */
    public function getNextAbsoluteUrl(&$params = null)
    {
        return $this->getAbsoluteUrl($params);
    }

    /**
     * 抓取。
     * @return mixed
     */
    abstract public function crawl();
}
