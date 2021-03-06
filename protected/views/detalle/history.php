<?php
/* @var $this DetalleController */
/* @var $model Detalle */

$this->breadcrumbs=array(
	'Detalles'=>array('admin'),
	$model->producto->producto,
);

$this->menu=array(	
	array('label'=>'Ingreso', 'url'=>array('increase','id'=>$model->id)),
	array('label'=>'Egreso', 'url'=>array('decrease','id'=>$model->id)),
	//array('label'=>'Asiento', 'url'=>array('update', 'id'=>$model->id)),	
);

?>

<h1>Historico Detallado <?php echo $model->producto->producto; ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detalle-grid',
	'dataProvider'=>$dataProvider,
	'summaryText'=>'',	
	'rowCssClassExpression'=>'$data->getColor(2)',
	'columns'=>array(
		'id',
		array('name'=>'fecha','type'=>'date'),
		'precio',		
		array(
              'name'=>'cantidad',
              'value'=>'$data->cantidad',
              'footer'=>$total
           ),
		'comentario',		
		'transaccion.transaccion',
		array(
			'header'=>'Opciones',
			'class'=>'CButtonColumn',
			'template'=>'{first}{delete}',    	
			'htmlOptions'=>array('width'=>'170px'),
			//'deleteConfirmation'=>"js:'Advertencia: La eliminacion del registro '+$(this).parent().parent().children(':first-child').text()+' es irreversible. Esta seguro que desea continuar?'",	
    		'buttons'=>array(
    			'delete'=> array(
    				'label'=>'Eliminar',      
            		'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',   
            		 				
				),
    			'first'=> array(
    				'label'=>'Editar',      
            		'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
            		'url'=>'Yii::app()->createUrl("detalle/first", array("id"=>$data->id))',    				
				),    			
    		),
		),
	),
)); ?>