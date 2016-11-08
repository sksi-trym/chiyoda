<?php
session_start();
require('./class/conf.php');

if (empty($_POST['mode'])){
	header('location:' . TMPL_INDEX);
	exit();
}
