<?php
session_start();
function setData(){
	if(is_array($_POST) && count($_POST) > 0){
		foreach ($_POST as $key => $value){
			$_SESSION[$key] = $value;
		}
	}
}

// 入力画面テンプレート
define('TMPL_INDEX', 'input.php');
// 確認画面テンプレート
define('TMPL_CONFIRM', 'confirm.php');
// 完了画面パス（URLも可）
define('PAGE_THANKS', 'thanks.php');
// HOME
define('PAGE_HOME', 'http://www.fce.co.jp/');

// CSVパス
define('PATH_CSV', './data/csv/out.csv');

//メール関連デフォルト
define('FROM', 'info.test@mail.com');
define('FROMTEXT', 'フォーム');

//管理者宛メール関連
//define('MNG_TO', 'info@southafricantourism.or.jp');
//define('MNG_BODY', './mail_temp/mng_body.txt');
//define('MNG_SBJ', 'ご入力内容確認');

//送信者宛メール関連
define('RES_BODY', './mail_temp/res_body.txt');
define('RES_SBJ', 'お問い合わせ受付完了しました。');
