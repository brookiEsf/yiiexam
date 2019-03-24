<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Categories;
use app\models\Catprod;
use app\controllers\CategoriesController;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
//$this->title = Yii::t('app','Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--    <table class="table table-condensed table-bordered table-hover">-->
<!---->
<!--        --><?//
//            $arr = array();
//        ?>
<!--        --><?//
//            foreach ($products as $item):
//        ?>
<!---->
<!--        <tr class="active">-->
<!--            <td><h4>-->
<!--                    --><?//
//                    if(!in_array($item["cat"]['name'], $arr)){
//                        array_push($arr, $item ["cat"]['name']);
//                        echo $item["cat"]['name'];
//                    }
//                    ?>
<!--                </h4></td>-->
<!--            <td>-->
<!--                <h4>-->
<!--                    --><?//=$item["cat_id"]['name']?>
<!--                </h4>-->
<!--            </td>-->
<!--        </tr>-->
<!--    --><?//endforeach;?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cat_name',
            'cat_definition',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

 //   </table>
</div>
