<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Цепь');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-index">
    <p>
        <?= Html::a(Yii::t('app', 'Mine Block'), ['mine'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'proof',
            'previous_hash',
	        'timestamp',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
