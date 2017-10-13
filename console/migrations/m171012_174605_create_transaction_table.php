<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 * - `block`
 */
class m171012_174605_create_transaction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('transaction', [
            'id' => $this->primaryKey()->notNull()->unsigned(),
            'sender' => $this->integer()->comment('Отправитель'),
            'recipient' => $this->integer()->notNull()->comment('Получатель'),
            'amount' => $this->decimal(13,2)->notNull()->comment('Сумма'),
            'block_id' => $this->integer()->unsigned(),
        ]);
	    $this->addCommentOnTable('transaction', 'Транзакции');

	    // creates index for column `sender`
        $this->createIndex(
            'idx-transaction-sender',
            'transaction',
            'sender'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-transaction-sender',
            'transaction',
            'sender',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `recipient`
        $this->createIndex(
            'idx-transaction-recipient',
            'transaction',
            'recipient'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-transaction-recipient',
            'transaction',
            'recipient',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `block_id`
        $this->createIndex(
            'idx-transaction-block_id',
            'transaction',
            'block_id'
        );

        // add foreign key for table `block`
        $this->addForeignKey(
            'fk-transaction-block_id',
            'transaction',
            'block_id',
            'block',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-transaction-sender',
            'transaction'
        );

        // drops index for column `sender`
        $this->dropIndex(
            'idx-transaction-sender',
            'transaction'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-transaction-recipient',
            'transaction'
        );

        // drops index for column `recipient`
        $this->dropIndex(
            'idx-transaction-recipient',
            'transaction'
        );

        // drops foreign key for table `block`
        $this->dropForeignKey(
            'fk-transaction-block_id',
            'transaction'
        );

        // drops index for column `block_id`
        $this->dropIndex(
            'idx-transaction-block_id',
            'transaction'
        );

        $this->dropTable('transaction');
    }
}
