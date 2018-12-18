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

use console\modules\spider\target\Target;

/**
 * Description of LibraryTarget
 *
 * @author vistart <i@vistart.name>
 */
abstract class LibraryTarget extends Target
{

    abstract public function extractISBN($dom);

    abstract public function extractTitle($dom);

    public function extractUniformTitle($dom)
    {
        
    }

    public function extractPress($dom)
    {
        
    }

    public function extractPrice($dom)
    {
        
    }

    public function extractAuthor($dom)
    {
        
    }

    abstract public function extractClass($dom);

    public function extractAbstract($dom)
    {
        
    }

    public function extractCommonInfo($dom)
    {
        
    }

    public function extractGeneralRemark($dom)
    {
        
    }

    public function extractTarget($dom)
    {
        
    }
    
    public function find($identity)
    {
        
    }

    public static function getBookDescriptor($marc_no)
    {

    }

    public static function getBookDescriptors($start, $limit)
    {

    }

    public static function getBook($marc_no, $barcode)
    {

    }

    public static function getAllBooks($marc_no)
    {

    }
}
