<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_date
 * @property string $modified_date
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_date', 'modified_date'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_date' => 'Created date',
            'modified_date' => 'Modified date',
        ];
    }
	
	public function getWriters() {
		return $this->hasMany(Writers::className(), ['id' => 'writer_fk'])->viaTable('books_writers', ['book_fk' => 'id']);
	}
	
	public function getUsers() {
		return $this->hasMany(Users::className(), ['id' => 'user_fk'])->viaTable('users_books', ['book_fk' => 'id']);
	}
	
}
