<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Personal */

$this->title = 'Создание сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
