<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nodes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
		<?= Html::a(Yii::t('app', 'Create Node'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php Pjax::begin(); ?>    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			'id',
			'username',
			'auth_key',
			'email:email',
			'status',
			'created_at:datetime',
        ],
	]); ?>
	<?php Pjax::end(); ?></div>
