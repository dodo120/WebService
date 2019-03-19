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
  $url = "http://opengamedb.org/api/getGame/".rand(1,20000);
  $xml = file_get_contents("$url", False, $cxContext);
  $chaine = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA );

  if(isset($chaine)) {
	  print "Titre : ".$chaine->entry->title."<br>";
    print "<br> Description : ".$chaine->entry->overview."<br>";
    print "<br> Nombre de joueur : ".$chaine->entry->players."<br>";
  }
  else {
	  print "Erreur".utf8_decode($xml->error);
  }

  $url = "http://opengamedb.org/api/getPlatform/".$chaine->entry->platform->id;
  $xml = file_get_contents("$url", False, $cxContext);
  $chaine = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA );
  if(isset($chaine)) {
	  print "<br> Platform : ".$chaine->entry->name."<br>";
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
