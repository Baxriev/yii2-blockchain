<?php

namespace backend\controllers;

use backend\models\Transaction;
use phpDocumentor\Reflection\Types\Null_;
use Yii;
use backend\models\Block;
use yii\base\Security;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * BlockController implements the CRUD actions for Block model.
 */
class BlockController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Block models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Block::find()->orderBy(['id' => SORT_DESC]),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Creates a new Block model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionMine()
	{
		# We run the proof of work algorithm to get the next proof...
		$lastBlock = Block::find()->orderBy(['id'=> SORT_DESC])->one(); //todo toArray
		//$lastBlock->transactions = Transaction::findAll(['block_id' => $lastBlock->id]);
		$lastProof = $lastBlock->proof;

		$proof = $this->proofOfWork($lastProof);

		# We must receive a reward for finding the proof.
		# The sender is "0" to signify that this node has mined a new coin.
		($profit = new Transaction([
			'sender' => 0,
			'recipient' => Yii::$app->user->id,
			'amount' => 1
		]))->save();

		# Forge the new Block by adding it to the chain
		($newBlock = new Block([
			'proof' => $proof,
			'previous_hash' => $this->hashBlock($lastBlock),
		]))->save();

		Transaction::updateAll(['block_id' => $newBlock->id], ['block_id' => null]);

		$response = [
			'message' => "New Block Forged",
			'block' => $newBlock,
		];

		$resp = Yii::$app->response;
		$resp->format = Response::FORMAT_JSON;
		$resp->headers->set('Access-Control-Allow-Origin', '*');

		return $response;
	}

	protected function hashBlock(Block $block) :string
	{
		$block = ArrayHelper::toArray($block);
		ksort($block);
		$blockString = json_encode($block);
		return md5($blockString);
	}

	protected function proofOfWork(int $lastProof) :int
	{
		$proof = 0;
		while (!$this->validProof($lastProof, $proof)){
			$proof++;
		}
		print_r([$lastProof, $proof, substr(md5($lastProof . $proof), 2, 5), md5($lastProof . $proof)]);
		return $proof;
	}

	private function validProof(int $lastProof, int $proof) :bool
	{
		$guessHash = md5($lastProof . $proof);
		return substr($guessHash, 2, 5) === "00000";
	}
}
