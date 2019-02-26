<?php

//define('ROOT',dirname(__DIR__));
//require_once(__DIR__ . 'goeasy/Goeasy.php');

use goeasy\Goeasy;

$url = 'https://rest-hangzhou.goeasy.io/publish';
// $url = 'http://localhost/goeasy/index2.php';
$params = ['appkey' => 'BC-c1b8664d5824451081b0fb75b6078156',
    'channel' => 'demo_channel',
    'content' => 'API 测试'];
// $res = m_curl($url, $params);
// var_dump($res);

$goeasy = new Goeasy();
$res = $goeasy->uCurl($url, 'POST', $params);
var_dump($res);


$data = $_POST;
file_put_contents('./log', json_encode($data));
echo json_encode(['code' => 200, 'content' => 'OK', 'data' => $data]);
/*
$raw_post_data = file_get_contents('php://input', 'r');
$method = $_SERVER['REQUEST_METHOD'];
if ('POST' == $method) {
    $headers = apache_request_headers();
    file_put_contents('socket.txt', $raw_post_data . print_r($headers, true) . print_r($raw_post_data['channel'], true));

} elseif ('DELETE'==$method) {
    unlink($_GET['file']);

}

echo '<?xml version=”1.0″ encoding=”UTF-8″?><RET>OK</RET>';
 */