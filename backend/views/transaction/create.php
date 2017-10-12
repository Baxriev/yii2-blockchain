<?php

use backend\models\Block;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */

$this->title = Yii::t('app', 'Новая транзакция для блока ') . (Block::find()->max('id') + 1);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
