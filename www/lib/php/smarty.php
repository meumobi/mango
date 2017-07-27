<?php

// On charge le moteur de template Smarty
//require_once DOCUMENT_ROOT . '/lib/php/smarty-3-1-18/libs/Smarty.class.php';

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty-3-1-18/libs/Smarty.class.php');


// Configuration de smarty
$smarty = new Smarty();
$smarty->template_dir = $_SERVER['DOCUMENT_ROOT'].'/lib/template/';
$smarty->compile_dir = $_SERVER['DOCUMENT_ROOT'].'/lib/template/include_c/';
$smarty->config_dir = $_SERVER['DOCUMENT_ROOT'].'/lib/template/configs/';
$smarty->cache_dir = $_SERVER['DOCUMENT_ROOT'].'/lib/template/cache/';






