<?php

namespace app\models;

use app\models\Supplier;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * SupplierSerch represents the model behind the search form of `app\models\Supplier`.
 * @property string $cond
 */
class SupplierSerch extends Supplier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'code', 't_status'], 'safe'],
            [['t_status'], 'in', 'range' => ['ok', 'hold']],
            [['cond'], 'in', 'range' => ['>', '>=', '=', '<', '<=']],
        ];
    }

    public function attributes()
    {
        return ArrayHelper::merge(parent::attributes(), ['cond']);
    }

    /**
     * {@inheritdoc}
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
        $query = Supplier::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        if (!empty($this->cond)) {
            $query->andFilterWhere([$this->cond, 'id', $this->id]);
        }
        $query->andFilterWhere([
            't_status' => $this->t_status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
