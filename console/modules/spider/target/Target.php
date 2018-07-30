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

    public $host = 'localhost';
    public $port = 80;
    public $scheme = 'http';
    public $relativeUrl;

    /**
     * 
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

    public function getNextAbsoluteUrl(&$params = null)
    {
        return $this->getAbsoluteUrl($params);
    }

    abstract public function crawl();
}
