<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

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
class Transaction extends ActiveRecord
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
            [['recipient', 'amount'], 'required'],
            [['sender', 'recipient'], 'integer'],
            [['amount'], 'number'],
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
            'sender0.username' => Yii::t('app', 'Sender'),
            'recipient0.username' => Yii::t('app', 'Recipient'),
            'amount' => Yii::t('app', 'Amount'),
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
