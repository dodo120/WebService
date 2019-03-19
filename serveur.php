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

function invalidParams() {
	$params = array("status"=>0, "msg"=>'Invalid Parameters Supplied');
	print json_encode($params);
	exit;
}

if(isset($_GET['method']) && $_GET['method'] != '') {
  extract($_GET);
} else {
  invalidParams();
}

switch ($method) {

  case 'getGameInformation':
  $url = "http://opengamedb.org/api/getGame/1";
  $xml = file_get_contents("$url", False, $cxContext);
  $chaine = new SimpleXMLElement($xml);

  if(isset($chaine)) {
	  print "Titre : $chaine->title";
  }
  else {
	  print "Erreur".utf8_decode($xml->error);
  }
  break;

  default:
  $params = array("status"=>0, "msg"=>'Invalid Parameters Supplied');
  print json_encode($params);
  break;
}

?>
)
