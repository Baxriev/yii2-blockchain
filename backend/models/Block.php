<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "block".
 *
 * @property integer $id
 * @property string $timestamp
 * @property integer $proof
 * @property string $previous_hash
 *
 * @property Transaction[] $transactions
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timestamp'], 'safe'],
            [['proof', 'previous_hash'], 'required'],
            [['proof'], 'integer'],
            [['previous_hash'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp' => 'Время',
            'proof' => 'Доказательство',
            'previous_hash' => 'Хеш предыдущего блока',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['block_id' => 'id']);
    }
}
