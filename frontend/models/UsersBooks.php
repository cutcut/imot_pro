<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_books".
 *
 * @property integer $id
 * @property integer $user_fk
 * @property integer $book_fk
 */
class UsersBooks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_fk', 'book_fk'], 'required'],
            [['user_fk', 'book_fk'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_fk' => 'User Fk',
            'book_fk' => 'Book Fk',
        ];
    }
}
