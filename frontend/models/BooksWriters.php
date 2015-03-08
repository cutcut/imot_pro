<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books_writers".
 *
 * @property integer $id
 * @property integer $book_fk
 * @property integer $writer_fk
 */
class BooksWriters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books_writers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_fk', 'writer_fk'], 'required'],
            [['book_fk', 'writer_fk'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_fk' => 'Book Fk',
            'writer_fk' => 'Writer Fk',
        ];
    }
	
}