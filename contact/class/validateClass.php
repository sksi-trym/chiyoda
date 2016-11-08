<?php
class validate{
	public $err_array;
	public $err;

	public function __construct($str){
		$this->err_array = $str;
	}

	public function setStr(){
		foreach($this->err_array as $key => $value){
			$temp = '';
			if ($key == 'upfile'){
				$tempfile = $_FILES[$key]['tmp_name'];
				$sizefile = $_FILES[$key]['size'];
				$errorfile = $_FILES[$key]['error'];
				if (!isset($errorfile) || !is_int($errorfile)) {
					$this->err[] = $value . 'のパラメータが不正です。';
					if (!is_uploaded_file($tempfile)) {
	          $this->err[] = $value . 'をアップロードできません。';
	        } else {
						if($sizefile > 10485760){
							$this->err[] = $value . 'のファイル形式をご確認下さい。';
						}
					}
				}

				/*$ext = mime_content_type($tempfile);
				if($ext != "video/quicktime" || $ext != "video/mp4" || $ext != "video/x-msvideo" || $ext != "video/x-ms-wmv" || $ext != "video/x-flv" || $ext != "video/3gpp" || $ext != "video/webm"){
					$this->err[] = $value . 'のファイル形式をご確認下さい。';
				}*/
				/*$ext = substr($_FILES['upfile']['name'], strrpos($_FILES['upfile']['name'], '.') + 1);
				if($ext != "MOV" || $ext != "MPEG4" || $ext != "AVI" || $ext != "WMV" || $ext != "MPEGPS" || $ext != "FLV" || $ext != "3GPP" || $ext != "WebM"){
					$this->err[] = $value . 'のファイル形式をご確認下さい。';
				}
				if(!preg_match('/\.MOV$|\.MPEG4$|\.AVI$|\.WMV$|\.MPEGPS$|\.FLV$|\.WMV$|\.3GPP$|\.WebM$/i', $_FILES[$key]['name'])){
					$temp = '動画のファイル形式をご確認下さい。';
				}*/
      }elseif ($key == 'email'){
				if(!is_null($this->cjl($_SESSION[$key], $value))){
					$temp = $this->cjl($_SESSION[$key], $value);
				}else {
					if(!is_null($this->isMail($key))){
						$temp = $this->isMail($key);
					}
				}
			}else {
				$temp = $this->cjl($_SESSION[$key], $value);
			}
			if($this->isEmpty($temp)){
				$this->err[] = $temp;
			}
		}
		return $this->err;
	}

	public function isEmpty($val){
		if ($val){
			return true;
		}
	}
	public function cjl($str, $val){
		if(!strlen($str)){
			$msg = $val . 'が入力されていません';
			return $msg;
		}else {
			return null;
		}
	}
	//アドレスチェック
	public function isMail($key){
		if(isset($_SESSION[$key]) && !empty($_SESSION[$key])){
			if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_SESSION[$key])){
				return 'メールアドレスの形式を確認してください';
			}else{
				return null;
			}
		}
	}
}
