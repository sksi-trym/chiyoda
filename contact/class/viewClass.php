<?php
class view{
	public $fpref;

	public function __construct() {
		$this->fpref = array(
				"" => '－－－',
				1 => '北海道',
				2 => '青森県',
				3 => '岩手県',
				4 => '秋田県',
				5 => '宮城県',
				6 => '山形県',
				7 => '福島県',
				8 => '茨城県',
				9 => '栃木県',
				10 => '群馬県',
				11 => '埼玉県',
				12 => '千葉県',
				13 => '東京都',
				14 => '神奈川県',
				15 => '新潟県',
				16 => '富山県',
				17 => '石川県',
				18 => '福井県',
				19 => '山梨県',
				20 => '長野県',
				21 => '岐阜県',
				22 => '静岡県',
				23 => '愛知県',
				24 => '三重県',
				25 => '滋賀県',
				26 => '京都府',
				27 => '大阪府',
				28 => '兵庫県',
				29 => '奈良県',
				30 => '和歌山県',
				31 => '鳥取県',
				32 => '島根県',
				33 => '岡山県',
				34 => '広島県',
				35 => '山口県',
				36 => '徳島県',
				37 => '香川県',
				38 => '愛媛県',
				39 => '高知県',
				40 => '福岡県',
				41 => '佐賀県',
				42 => '長崎県',
				43 => '熊本県',
				44 => '大分県',
				45 => '宮崎県',
				46 => '鹿児島県',
				47 => '沖縄県'
		);
	}

	public function escape($str){
		if(strlen($str)){
			return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
		}
	}

	public function int($num){
		if(is_numeric($num)){
			return intval($num);
		}else{
			return;
		}
	}

	public function viewStyle($array){
		if(is_array($array)){
			return $this->escape(implode(",", $array));
		}
	}
	public function setPref($prefcode = NULL){
		$form = "<select name=\"pref01\" class=\"validate[required] text-input\" data-prompt-position=\"topLeft\">\n";
		foreach ($this->fpref as $key => $value){
			if(!is_null($prefcode) && $prefcode == $key){
				$selected = ' selected ';
			}else{
				$selected = '';
			}
			$form .= '<option value="'. $key . '"' . $selected . '>' . $value . "</option>\n";
		}
		$form .= "</select>\n";
		return $form;
	}

	public function getPref($key = NULL){
		if(is_null($key)){
			return $this->fpref;
		}else {
			return $this->fpref[$key];
		}
	}

	public function matchData($key, $input){
		if(isset($_SESSION[$key])){
			foreach ($_SESSION[$key] as $idx => $value){
				if($input == $value){
					return ' checked ';
				}
			}
		}
	}

	public function backTop(){
		if(!isset($_SESSION)){
			header('location:http://south-africa.jp/wow/');
			exit();
		}
	}

}
