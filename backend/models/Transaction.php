<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $sender
 * @property integer $recipient
 * @property string $amount
 * @property integer $block_id
 *
 * @property Block $block
 * @property User $recipient0
 * @property User $sender0
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender', 'recipient', 'amount', 'block_id'], 'required'],
            [['sender', 'recipient', 'block_id'], 'integer'],
            [['amount'], 'number'],
            [['block_id'], 'exist', 'skipOnError' => true, 'targetClass' => Block::className(), 'targetAttribute' => ['block_id' => 'id']],
            [['recipient'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recipient' => 'id']],
            [['sender'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender' => 'Отправитель',
            'recipient' => 'Получатель',
            'amount' => 'Сумма',
            'block_id' => 'Block ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(Block::className(), ['id' => 'block_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipient0()
    {
        return $this->hasOne(User::className(), ['id' => 'recipient']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender0()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }
}
