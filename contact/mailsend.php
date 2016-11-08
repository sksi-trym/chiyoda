<?php
session_start();
require_once './class/conf.php';
require_once './class/viewClass.php';
$view = new view();
//$view->backTop();
if (isset($_SESSION['ticket'], $_POST['ticket']) && $_SESSION['ticket'] === $_POST['ticket']){
	unset($_SESSION['ticket']);

	$num = intval(file_get_contents('num.txt'), 10) + 1;
  file_put_contents('num.txt', $num);
  $num = sprintf('%04d', $num);

	$datetime = date('Y/m/d H:i:sO');
  //$ipaddr = $_SERVER['REMOTE_ADDR'];

	exit();

	// 返信メール差し替え
	$pattern = array(
		'%name%',
		'%furigana%'

	);
	$replacements = array(
		$_SESSION['name'],
		$_SESSION['furigana']
	);

	$csv_replacements = array(
		$num,
		$_SESSION['name'],
		$_SESSION['furigana'],
		$_SESSION['email'],
		$_SESSION['tel'],
		$_SESSION['cmt'],
		$datetime
	);

	$res_mail_string = file_get_contents(RES_BODY);

  //パターンを整形
	foreach($pattern as $value){
			$patterns[] = '/' . $value . '/';
	}

	if(!empty($res_mail_string)){
		//置換する
		$res_body = preg_replace($patterns, $replacements, $res_mail_string);
	}

	require_once './phpmailer/jphpmailer.php';  //ライブラリ読み込み
	mb_language("japanese");           //言語(日本語)
	mb_internal_encoding("UTF-8");     //内部エンコーディング(UTF-8)
	$from = FROM;      //差出人
	$fromname = FROMTEXT;      //差し出し人名

	//登録完了メール
	$res_to = $_SESSION['email'];
	$res_subject = RES_SBJ;
	$res_mail = new JPHPMailer();          //JPHPMailerのインスタンス生成
	$res_mail->addTo($res_to);                 //宛先(To)をセット
	$res_mail->setFrom($from,$fromname);   //差出人(From/From名)をセット
	$res_mail->setSubject($res_subject);       //件名(Subject)をセット
	$res_mail->setBody($res_body);             //本文(Body)をセット
	//$mail->addAttachment($attachfile); //添付ファイル追加

	if (!$res_mail->send()){
		echo("Failed to send mail. Error:".$mail->getErrorMessage());
	}else{
		unset($_SESSION['err_msg']);

		//CSV書き出し
		$fileName =  PATH_CSV;
		$fileName =  mb_convert_encoding($fileName, 'SJIS-WIN');

		$file = fopen($fileName, "a+");
		mb_convert_variables("SJIS-win","UTF-8", $replacements);
		if($file){
			fputcsv($file, $replacements);
		}
		fclose($file);

		// セッション変数を全て解除する
		$_SESSION = array();
		// セッションを切断するにはセッションクッキーも削除する。
		// Note: セッション情報だけでなくセッションを破壊する。
		if (isset($_COOKIE[session_name()])) {
    		setcookie(session_name(), '', time()-42000, '/');
		}
		// 最終的に、セッションを破壊する
		session_destroy();

		header('location:' . PAGE_THANKS);
		exit();
	}
}else{
	header('location:' . PAGE_HOME);
}
