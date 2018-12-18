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
 * Time: 19:13
 */

namespace console\modules\spider\target\library\TongjiUniversity\models\search;

use console\modules\spider\target\library\TongjiUniversity\models\BookDescriptor;
/**
 * Class BookSearch
 * @package console\modules\spider\target\library\TongjiUniversity\models
 * @property string $marc_no
 * @property string $title
 * @property string[] $authors
 * @property string[] $presses
 * @property string[] $ISBNs
 * @property string[] $subjects
 * @property string[] $classes
 * @property string $call_no
 * @property string $abstract
 * @property string[] $target_readers
 * @property string $status
 * @property string[][] $books
 *
 */
class Book extends \yii\elasticsearch\ActiveRecord
{
    public function attributes()
    {
        return [
            'marc_no',
            'title',
            'authors',
            'presses',
            'ISBNs',
            'subjects',
            'classes',
            'call_no',
            'abstract',
            'target_readers',
            'status',
            'books',
        ];
    }

    public function arrayAttributes()
    {
        return [
            'authors',
            'presses',
            'ISBNs',
            'subjects',
            'classes',
            'target_readers',
            'books',
        ];
    }

    public function refreshAttributes(BookDescriptor $book)
    {
        $this->primaryKey = intval($book->marc_no);
        $this->marc_no = $book->marc_no;
        $this->title = $book->title;
        $this->authors = $book->authors;
        $this->presses = $book->presses;
        $this->ISBNs = $book->ISBNs;
        $this->subjects = $book->subjects;
        $this->classes = $book->classes;
        $this->call_no = $book->call_no;
        $this->abstract = $book->abstract;
        $this->target_readers = $book->target_readers;
        $this->status = $book->status;

        $this->books = $book->books;
    }

    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'marc_no' => [
                        'type' => 'text',
                    ],
                    'title' => [
                        'type' => 'text',
                        'analyzer' => 'ik_max_word',
                        'search_analyzer' => 'ik_max_word',
                    ],
                    'authors' => [
                        'properties' => [
                            1 => [
                                'type' => 'text',
                                'analyzer' => 'ik_smart',
                                'search_analyzer' => 'ik_smart',
                            ],
                        ],
                    ],
                    'presses' => [
                        'properties' => [
                            1 => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word',
                                'search_analyzer' => 'ik_max_word',
                            ],
                        ],
                    ],
                    'ISBNs' => [
                        'properties' => [
                            1 => [
                                'type' => 'text',
                            ],
                        ],
                    ],
                    'subjects' => [
                        'properties' => [
                            1 => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word',
                                'search_analyzer' => 'ik_max_word',
                            ],
                        ],
                    ],
                    'classes' => [
                        'properties' => [
                            1 => [
                                'type' => 'text',
                                'analyzer' => 'ik_max_word',
                                'search_analyzer' => 'ik_max_word',
                            ],
                        ],
                    ],
                    'call_no' => [
                        'type' => 'text',
                    ],
                    'abstract' => [
                        'type' => 'text',
                        'analyzer' => 'ik_max_word',
                        'search_analyzer' => 'ik_max_word',
                    ],
                    'books' => [
                        'properties' => [
                            'barcode' => [
                                'type' => 'text',
                            ],
                            'position' =>[
                                'type' => 'text',
                            ],
                            'status' => [
                                'type' => 'text',
                            ],
                            'volume_period' => [
                                'type' => 'text',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Set (update) mappings for this model
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    /**
     * Create this model's index
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            // 'settings' => [ /* ... */ ],
            'mappings' => static::mapping(),
            //'warmers' => [ /* ... */ ],
            //'aliases' => [ /* ... */ ],
            //'creation_date' => '...'
        ]);
    }

    /**
     * Delete this model's index
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index(), static::type());
    }
}