<?php

namespace cronfy\event\models\crud;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $namespace
 * @property integer $object_id
 * @property string $type
 * @property string $data
 * @property integer $created_at
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'namespace/required' => ['namespace', 'required'],
            'object_id/required' => ['object_id', 'required'],
            'type/required' => ['type', 'required'],
            'data/required' => ['data', 'required'],
            'created_at/required' => ['created_at', 'required'],
            'object_id/integer' => ['object_id', 'integer'],
            'created_at/integer' => ['created_at', 'integer'],
            'namespace/length' => ['namespace', 'string', 'max' => 255],
            'type/length' => ['type', 'string', 'max' => 255],
            'data/length' => ['data', 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namespace' => 'Namespace',
            'object_id' => 'Object ID',
            'type' => 'Type',
            'data' => 'Data',
            'created_at' => 'Created At',
        ];
    }
}
