<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

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
class Block extends ActiveRecord
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
            'timestamp' => Yii::t('app', 'Time'),
            'proof' => Yii::t('app', 'Proof'),
            'previous_hash' => Yii::t('app', 'Previous hash'),
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
