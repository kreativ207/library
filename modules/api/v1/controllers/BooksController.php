<?php
namespace app\modules\api\v1\controllers;

use app\modules\admin\models\Books;

use Yii;
use yii\rest\Controller;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\rest\OptionsAction;
use yii\filters\Cors;
use yii\web\NotFoundHttpException;



class BooksController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                'charset' => 'UTF-8',
            ],
        ];
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
        ];
        return $behaviors;
    }
    
    public function actions()
    {
        return [
            'options' => [
                'class' => OptionsAction::className(),
            ],
        ];
    }




    public function actionList()
    {
        try {
            Yii::$app->getResponse()->setStatusCode(200);
            return [
                'success' => true,
                'data' => $this->findBookList(),
            ];
        } catch (NotFoundHttpException $exc) {
            Yii::$app->response->setStatusCode(404);
            return [
                'success' => false,
                'errors' => "Record not found!",
            ];
        }
    }



    public function actionById($id)
    {
        try {
            Yii::$app->getResponse()->setStatusCode(200);
            return [
                'success' => true,
                'data' => $this->findBook($id),
            ];
        } catch (NotFoundHttpException $exc) {
            Yii::$app->response->setStatusCode(404);
            return [
                'success' => false,
                'errors' => "Record not found!",
            ];
        }
    }


    public function actionUpdate($id)
    {

        $book = $this->findBook($id);

        if ($book->load(Yii::$app->request->post(), '') && $book->save()) {
            return [
                'success' => true,
                'message' => "Book update",
            ];
        }
        return [
            'success' => false,
            'message' => $book->errors,
        ];
    }

    public function actionId($id)
    {

        $book = $this->findBook($id);
        if ($book->delete()) {
            return [
                'success' => true,
                'message' => "Book delete",
            ];
        }
        return [
            'success' => false,
            'message' => $book->errors,
        ];
    }

    protected function findBook($id)
    {

        if (($model = Books::find()->where(['id' => $id])->with('author')->one()) !== null)
        {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function findBookList()
    {

        if (($models = Books::find()->with('author')->orderBy('id DESC')->all()) !== null)
        {
            foreach ($models as $model){
                $model->author_id = $model->authorname;
            }
            return $models;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}