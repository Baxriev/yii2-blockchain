#!/bin/bash

[ -d vendor/bower ] || ln -s bower-asset vendor/bower
php init --env=Development --overwrite=n
mysqladmin -u $1 -fp$2 create blockchain
php yii migrate --interactive=0

#php yii migrate/create create_block_table -f="id:primaryKey:notNull:unsigned,timestamp:timestamp:notNull:comment('Время'),proof:integer:notNull:unsigned:comment('Доказательство'),previous_hash:string(255):notNull:comment('Хеш предыдущего блока')" --interactive=0
#php yii migrate/create create_transaction_table -f="id:primaryKey:notNull:unsigned,sender:integer:notNull:foreignKey(user):comment('Отправитель'),recipient:integer:notNull:foreignKey(user):comment('Получатель'),amount:decimal(13,2):notNull:comment('Сумма'),block_id:integer:unsigned:notNull:foreignKey(block)" --interactive=0
#php yii migrate --interactive=0
#php yii gii/model --tableName=* --ns="backend\models" --generateLabelsFromComments=1 --overwrite=1  --interactive=0
#php yii gii/crud --modelClass="backend\models\User" --interactive=0 --enablePjax --enableI18N --controllerClass="backend\controllers\UserController" --overwrite=1 --viewPath=@backend/views/user
#php yii gii/crud --modelClass="backend\models\Block" --interactive=0 --enablePjax --enableI18N --controllerClass="backend\controllers\BlockController" --overwrite=1 --viewPath=@backend/views/block
#php yii gii/crud --modelClass="backend\models\Transaction" --interactive=0 --enablePjax --enableI18N --controllerClass="backend\controllers\TransactionController" --overwrite=1 --viewPath=@backend/views/transaction
