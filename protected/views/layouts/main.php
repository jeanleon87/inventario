<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo" style="vertical-align: middle">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/inventario.jpg" width="50" >
			<?php echo CHtml::encode(Yii::app()->name); ?>
		</div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(			
				array('label'=>'Index', 'url'=>array('/site/index')),
			
				array('label'=>'Almacen', 'url'=>array('/detalle/admin')),
				array('label'=>'Categorias', 'url'=>array('/categoria/admin')),
				array('label'=>'SubCategorias', 'url'=>array('/subcategoria/admin')),
				array('label'=>'Productos', 'url'=>array('/producto/admin')),
				array('label'=>'Operaciones', 'url'=>array('/transaccion/admin'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Reportes', 'url'=>array('/detalle/reportes')),
				array('label'=>'Respaldo', 'url'=>array('/site/backup')),
				//array('label'=>'About', 'url'=>array('/backup/default/create')),				
				//array('label'=>'About', 'url'=>array('/backup/default/index')),
				
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>	

</div><!-- page -->

</body>
</html>
