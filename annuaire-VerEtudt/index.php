<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include 'views/v_gabarit_entete.php';
include 'models/m_model.php';
include 'models/fct.inc.php';

$pdo=PdoBridge::getPdoBridge();


include 'views/v_menu.php';
    
$uc = 'gerer';

$action = 'accueil';


if (isset($_REQUEST['uc'])) {
    $uc=$_REQUEST['uc'];
}
if (isset($_REQUEST['action'])) {
    $action=$_REQUEST['action'];
}
include "controllers/c_$uc.php";


include("views/v_gabarit_pied.php");
