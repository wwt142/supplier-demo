<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SupplierSerch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="supplier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'class' => 'form-inline',
    ]); ?>

    <?php
    $condHtml = $form->field($model, 'cond')
        ->dropDownList(['>' => '大于', '=' => '等于', '>=' => '大于等于', '<' => '小于', '<=' => '小于等于'])
        ->label('');
    ?>

    <?= $form->field($model, 'id', [
        'template' => "{label}{$condHtml}{input}{error}",
    ])->textInput(['type' => 'number', 'min' => 1, 'placeholder' => '请输入ID']) ?>

    <?= $form->field($model, 'name')->textInput(['placeholder'  =>  '请输入名称']) ?>

    <?= $form->field($model, 'code')->textInput(['placeholder'  =>  '请输入Code']) ?>

    <?= $form->field($model, 't_status')->dropDownList(['ok' => 'OK', 'hold' => 'Hold'], ['prompt' => '请选择状态'])->label('状态') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
