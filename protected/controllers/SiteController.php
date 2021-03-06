<?php
require_once "/../vendor/DropBoxSDK/lib/Dropbox/autoload.php";
use \Dropbox as dbx;
class SiteController extends Controller {

	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
		// captcha action renders the CAPTCHA image displayed on the contact page
		'captcha' => array('class' => 'CCaptchaAction', 'backColor' => 0xFFFFFF, ),
		// page action renders "static" pages stored under 'protected/views/site/pages'
		// They can be accessed via: index.php?r=site/page&view=FileName
		'page' => array('class' => 'CViewAction', ), );
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		/*
		 Yii::import('ext.GFtp.GFtpComponent');

		 try {
		 $gftp = Yii::app()->ftp;
		 $files = $gftp->ls('/www/inventario', true, false);
		 $file = $gftp->get(FTP_BINARY,'/www/inventario/prueba.txt', './_backup/prueba.txt');

		 $file = $gftp->put(FTP_BINARY, './_backup/db_backup.sql', '/www/inventario/db_backup.sql');
		 } catch (GFtpException $e) {
		 die('Ooops');
		 }
		 */
		$this -> render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if ($error = Yii::app() -> errorHandler -> error) {
			if (Yii::app() -> request -> isAjaxRequest)
				echo $error['message'];
			else
				$this -> render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact() {
		$model = new ContactForm;
		if (isset($_POST['ContactForm'])) {
			$model -> attributes = $_POST['ContactForm'];
			if ($model -> validate()) {
				$name = '=?UTF-8?B?' . base64_encode($model -> name) . '?=';
				$subject = '=?UTF-8?B?' . base64_encode($model -> subject) . '?=';
				$headers = "From: $name <{$model->email}>\r\n" . "Reply-To: {$model->email}\r\n" . "MIME-Version: 1.0\r\n" . "Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app() -> params['adminEmail'], $subject, $model -> body, $headers);
				Yii::app() -> user -> setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this -> refresh();
			}
		}
		$this -> render('contact', array('model' => $model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$model = new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app() -> end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model -> attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model -> validate() && $model -> login())
				$this -> redirect(Yii::app() -> user -> returnUrl);
		}
		// display the login form
		$this -> render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app() -> user -> logout();
		$this -> redirect(Yii::app() -> homeUrl);
	}

	public function actionBackup() {
		$this -> render('backup');
	}

	public function actionBackupDropBox() {
		date_default_timezone_set('America/Caracas');
		$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_backup' . DIRECTORY_SEPARATOR . 'db_inventario_LOCAL.sql';
		$appInfo = dbx\AppInfo::loadFromJsonFile("app-info.json");
		$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

		$accessToken = "mh8Lv8YmEb4AAAAAAAAB0RGqEvxX93vyO-wSAR0aFA3CU3VGgE51blu3wvv9-UoU";
		//$accessToken = "mh8Lv8YmEb4AAAAAAAAB0RGqEvxdskfns-SDASdjfbsdjksadaadsadsafbh-dfb";

		try{
			$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
			if ($dbxClient) {
				$accountInfo = $dbxClient -> getAccountInfo();

				$f = fopen($file, "rb");
				$result = $dbxClient -> uploadFile("/inventario/".date("dMYhisa").".sql", dbx\WriteMode::add(), $f);
				fclose($f);

				if ($result) {
					echo json_encode(array('respuesta' => 1, 'div' => '<div class="alert alert-success" role="alert">Archivo subido correctamente</div>'));
				}
			} 	
		}catch(Exception $e) {
			echo json_encode(array('respuesta' => 2));
		}
	}

	public function actionRestoreDropBox() {
		require dirname(__FILE__) . '/../../dropbox.php';

	}

}
