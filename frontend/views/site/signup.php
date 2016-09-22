<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                <?=$form->field($model, 'step')->hiddenInput()->label(false);?>
<?= var_export($model->step,true);?>
            <?php
            if (!$model->step || $model->step==1){
            echo  $form->field($model, 'phone')->textInput();
                echo $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), [
                // configure additional widget properties here
            ]);
            }elseif ($model->step==2){

            echo $form->field($model, 'smsCode')->textInput();

            }
            ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
