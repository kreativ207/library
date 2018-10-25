<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Authors as Model;
use app\modules\admin\models\AuthorsSearch as SearchModel;
use yii\filters\AccessControl;
use yii\helpers\StringHelper;
use alhimik1986\yii2_crud_module\web\JsonController as Controller;

/**
 * The controller implements the CRUD actions for model.
 */
class AuthorsController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => \yii\filters\VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions'=>['login','error'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
		];
	}

	/**
	 * Main action, with list of records.
	 */
	public function actionIndex()
	{
		$searchModel = new SearchModel();
		$model = new Model;
		
		return $this->render('index', [
			'searchModel' => $searchModel,
			'model' => $model,
			'searchModelName' => StringHelper::basename($searchModel::className()),
			'modelName' => StringHelper::basename($model::className()),
			'tableName' => Model::tableName(),
			'loading_img' =>($loading_img = Yii::$app->assetManager->publish(Yii::getAlias('@vendor').'/alhimik1986/yii2_js_view_module/assets/img/ajax-loader.gif')) ? $loading_img[1] : '',
			//'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
		]);
	}

	/**
	 * Displays detailed information about the record.
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);

		return $this->renderJson('_view', [
			'model' => $model,
			'modelName' => StringHelper::basename($model::className()),
			'formTitle' => 'View',
		]);
	}

	/**
	 * Creates a new record.
	 */
	public function actionCreate()
	{
		$model = new Model();

		if (Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post()) AND $model->save();
			return $this->checkErrorsAndDisplayResult($model);
		} else {
			return $this->renderJson('_form', [
				'model' => $model,
				'modelName' => StringHelper::basename($model::className()),
				'formTitle' => 'New record',
			]);
		}
	}

	/**
	 * Updates an existing record.
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if (Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post()) AND $model->save();
			return $this->checkErrorsAndDisplayResult($model);
		} else {
			return $this->renderJson('_form', [
				'model' => $model,
				'modelName' => StringHelper::basename($model::className()),
				'formTitle' => 'Edit record',
			]);
		}
	}

	/**
	 * Deletes an existing record.
	 */
	public function actionDelete()
	{
		$modelName = StringHelper::basename(Model::className());
		$param = Yii::$app->request->post($modelName);
		$id = isset($param['id']) ? $param['id'] : null;
		$model = $this->findModel($id);
		$model->delete();
		return $this->checkErrorsAndDisplayResult($model);
	}

	/**
	 * Deletes selected records.
	 */
	public function actionDeleteSelected()
	{
		$modelName = StringHelper::basename(Model::className());
		$param = Yii::$app->request->post($modelName);
		$ids = (isset($param['ids']) AND is_array($param['ids'])) ? $param['ids'] : array();
		$resultModel = false;
		foreach($ids as $id) {
			$model = $this->findModel($id);
			$model->delete();
			if ( ! $resultModel AND $model->hasErrors())
				$resultModel = clone $model;
		}
		$resultModel = $resultModel ? $resultModel : new Model;
		return $this->checkErrorsAndDisplayResult($resultModel);
	}

	/**
	 * Search records.
	 */
	public function actionSearch()
	{
		$searchModel = new SearchModel();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		if ( ! $searchModel->hasErrors()) {
			return $this->renderJson('_table', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		} else {
			return $this->checkErrorsAndDisplayResult($searchModel);
		}
	}

	/**
	 * Finds records based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 */
	protected function findModel($id)
	{
		if (($model = Model::findOne($id)) !== null) {
			return $model;
		} else {
			throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
		}
	}
}