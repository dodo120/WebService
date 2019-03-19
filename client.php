<?php

$aContext = array(
  'http' => array (
    'proxy'=>'tcp://cache.iutbayonne.univ-pau.fr:3128',
    'request_fulluri' => true
  ),
  'https' => array (
    'proxy'=>'tcp://cache.iutbayonne.univ-pau.fr:3128',
    'request_fulluri' => true
  )
);

$cxContext = stream_context_create($aContext);

$url = "http://iparla.iutbayonne.univ-pau.fr/~mfringant/PHP_AJAX/S4/Webservice/Projet/serveur.php?method=getGameInformation";
$json = file_get_contents("$url", False, $cxContext);

print $json;
?>
