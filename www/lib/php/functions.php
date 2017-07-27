<?php
require_once DOCUMENT_ROOT . 'php/Mobile_Detect.php';

$detect = new Mobile_Detect;
$device = array();
/* Include & exclude Classes 
 * ---------------
 * Choix des classes à ajouter à la balise html en fonction du device utilisé
 *   Pour un affichage sur ordinateur de bureau, ajoute la classe desktop
 *   Pour un affichage sur Tablet, ajoute la classe tablet
 *   Pour un affichage sur Mobile (phone), ajoute la classe mobile
 *
 *   Pour un affichage sur ordinateur de bureau, ajoute les classes not-mobile et not-tablet
 *   Pour un affichage sur Tablet, ajoute les classes not-mobile et not-desktop
 *   Pour un affichage sur Mobile (phone), ajoute les classes not-mobile et not-desktop
 */
// Any Desktop device.

if (!$detect->isMobile()) {
  $device[0] = 'desktop_';
  $device[1] = '_1';
}

// Any tablet device.
if ($detect->isTablet()) {
  $device[0] = 'tablet_';
  $device[1] = '_2';

}

// Any mobile device.
if ($detect->isMobile() && !$detect->isTablet()) {	
  $device[0] = 'mobile_';
  $device[1] = '_3';

}

// Ajout de class en fonction de l'os en place sur le device :
/*
if ($detect->isiOS()) {
  $device[0] = 'ios_';
  $device[1] = '_2';
}

if ($detect->isAndroidOS()) {
  $device[0] = 'android_';
  $device[1] = '_5';
}
var_dump($device);
*/



require_once DOCUMENT_ROOT . 'php/javascript.php';
require_once DOCUMENT_ROOT . 'php/smarty.php';