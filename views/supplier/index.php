<?php

use app\models\Supplier;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/** @var yii\web\View $this */
/** @var app\models\SupplierSerch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = '供应商列表';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="supplier-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('创建供应商', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::button('导出选中', ['class' => 'btn btn-success', 'id' => 'export']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'id' => 'grid',
            'columns' => [
                [
                    'class' => \yii\grid\CheckboxColumn::className(),
                    'name' => 'id',
                    'headerOptions' => ['width' => '30'],
                ],
                'id',
                'name',
                'code',
                't_status',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Supplier $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'header' => '操作',
                ],
            ],
        ]); ?>


    </div>

<?php
$exportUrl = Url::toRoute(['supplier/export', 'ids' => ''], true);
$js = <<<JS
    $(function(){
        $("#export").click(function () {
            let ids = $("#grid").yiiGridView("getSelectedRows")
            if (ids.length === 0){
                alert('请选择数据');
            }else{
                window.open('$exportUrl' + ids.join(','))
            }
        })
    });
JS;
$this->registerJs($js);
?>