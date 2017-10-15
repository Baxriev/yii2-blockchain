<?php

use yii\db\Migration;

/**
 * Handles the creation of table `block`.
 */
class m171012_174605_create_block_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('block', [
            'id' => $this->primaryKey()->notNull()->unsigned(),
            'previous_hash' => $this->string(255)->notNull()->comment('Хеш предыдущего блока'),
            'proof' => $this->integer()->notNull()->unsigned()->comment('Доказательство'),
            'timestamp' => $this->timestamp()->notNull()->comment('Время'),//->defaultExpression('CURRENT'),
        ]);

	    $this->addCommentOnTable('block', 'Blocks chain');

	    $this->insert('block', ['previous_hash' => 1, 'proof' => 100]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('block');
    }
}
