<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "writers".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_date
 * @property string $modified_date
 */
class Writers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'writers';
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
	
	public function getBooks() {
		return $this->hasMany(Books::className(), ['id' => 'book_fk'])->viaTable('books_writers', ['writer_fk' => 'id']);
	}
	
}
