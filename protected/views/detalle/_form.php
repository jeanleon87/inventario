<?php
/* @var $this DetalleController */
/* @var $model Detalle */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalle-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('autocomplete'=>'off'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="row">
			<?php echo $form->labelEx($model,'producto_id'); ?>
			<?php
				echo $form->dropDownList($model,'producto_id', CHtml::listData(Producto::model()->findAll(),'id','producto'),array('empty' => '(seleccione un producto)','disabled'=>'disabled'));
			?>		
			<?php echo $form->error($model,'producto_id'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'transaccion_id'); ?>
			<?php
				echo $form->dropDownList($model,'transaccion_id', CHtml::listData(Transaccion::model()->findAll(),'id','transaccion'),array('empty' =>'(seleccione un estado)','disabled'=>'disabled'));
			?>		
			<?php echo $form->error($model,'transaccion_id'); ?>
		</div>
		
		
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php //echo $form->textField($model,'fecha'); ?>			
		
		<?php
        // widget
        
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'language'=>'es',
            'model'=>$model,
            'attribute'=>'fechaString',
            'flat'=>false,
            'options'=>array(
            	'showAnim'=>'slideDown',
                'firstDay'=>1,
                'showOn'=>"both",                
                'buttonImageOnly'=> false,                
                'constrainInput'=>true,                
                'dateFormat'=>'dd/mm/yy',                
				'showOtherMonths' => true,      // show dates in other months
        		'selectOtherMonths' => true,    // can seelect dates in other months
        		'changeYear' => true,           // can change year
        		'changeMonth' => true,          // can change month        
        		'showButtonPanel' => false,
        		'numberOfMonths'=>2,
            ),
            'htmlOptions'=>array(
            ),
        ));
    	?>
    	<?php echo $form->error($model,'fecha'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'precio'); ?>
		<?php echo $form->textField($model,'precio'); ?>
		<?php echo $form->error($model,'precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textField($model,'comentario',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->