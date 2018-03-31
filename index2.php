<?php

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