<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Authors;

/**
 * AuthorsSearch represents the model behind the search form about `app\modules\admin\models\Authors`.
 */
class AuthorsSearch extends Authors
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id'], 'integer'],
            [['author'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		// Решаю проблему чувствительности символов к регистру в операторе LIKE для Sqlite.
		// Fix case sensitive in like operator in Sqlite. This line does not affect other types of databases.
		\alhimik1986\yii2_crud_module\web\ModelHelper::sqliteFixCaseSensitiveInLikeOperator(static::getDb());

		$query = Authors::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			// Пейджер и число записей на страницу
			// Sets the pager and results per page
			'pagination' => array('pageSize' => (isset($params['per-page']) AND (int)$params['per-page']) ? abs((int)$params['per-page']) : 10),
		]);

		$this->load($params);

		if (!$this->validate()) {
			$query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$t = self::tableName();
		$query->andFilterWhere([
             $t.'.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', $t.'.author', $this->author]);

		// Сортировка по нескольким полям таблицы, и вывод результата в виде массива, а не в виде объектов (для экономии памяти)
		// Sorting by several fields of the table and return result as array, not as object (to prevent memory leaks).
		$query->orderBy(\alhimik1986\yii2_crud_module\web\Sort::init()->setOrderByDefault('')->getOrder($params, $this));
		$query->asArray();

		return $dataProvider;
	}
}