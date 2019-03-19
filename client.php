<?php

$aContext = array(
  'http' => array(
    'proxy' => 'tcp://cache.iutbayonne.univ-pau.fr:31280',
    'request_fulluri' => true
  ),
  'http' => array(
    'proxy' => 'tcp://cache.iutbayonne.univ-pau.fr:31280',
    'request_fulluri' => true
  )
);

$cxContext = stream_context_create($aContext);

$url = "./serveur.php?method=getGameInformation";
$json = file_get_contents("$url", False, $cxContext);

print $json;
?>
