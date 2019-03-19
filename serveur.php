<?php

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

  case 'getUserData':
  $data = array(
    "Status"=>'2',
    "Msg"=>'Methode getUserData'
  );
  header('Content-type: application/json');
  print json_encode(array('data'=>$data));
  break;

  case 'Login':
  $data = array(
    "Code"=>'1',
    "Status"=>'200',
    "Data"=>'Hello World'
  );
  header('Content-type: application/json');
  print json_encode(array('data'=>$data));
  break;

  default:
  $params = array("status"=>0, "msg"=>'Invalid Parameters Supplied');
  print json_encode($params);
  break;
}

?>
)