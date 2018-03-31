<?php
/**
 *  http(s)://<REST Host>/publish
 *  appkey	是	您的app key
 *  channel	是	您的目标channel
 *  content	是	推送的消息内容
 */

$url = 'https://rest-hangzhou.goeasy.io/publish';
// $url = 'http://localhost/goeasy/index2.php';
$params = ['appkey' => 'BC-c1b8664d5824451081b0fb75b6078156',
		'channel' => 'demo_channel',
        'content' => 'API 测试'];
// $res = m_curl($url, $params);
// var_dump($res);

$res = uCurl($url, 'POST', $params);
var_dump($res);


function uCurl( $url, $method, $params=array(), $header='')
{
    $curl = curl_init();//初始化CURL句柄  
    $timeout = 15;  
    curl_setopt($curl, CURLOPT_URL, $url);//设置请求的URL  
    curl_setopt($curl, CURLOPT_HEADER, false);// 不要http header 加快效率  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出  

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts  
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  

    if($header==''){  
        $header [] = "Accept-Language: zh-CN;q=0.8";  
        curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header );  
    }else{  
        curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header );  
    }  

    curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, $timeout);//设置连接等待时间  
    switch ($method){  
        case "GET" :  
            curl_setopt($curl, CURLOPT_HTTPGET, true);break;  
        case "POST":  
            curl_setopt($curl, CURLOPT_POST, true);  
            curl_setopt($curl, CURLOPT_NOBODY, true);  
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);break;//设置提交的信息  
        case "PUT" :  
            curl_setopt ($curl, CURLOPT_CUSTOMREQUEST, "PUT"); 
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));break;  
        case "DELETE":  
            curl_setopt ($curl, CURLOPT_CUSTOMREQUEST, "DELETE");  
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);break;  
    }  

    $data = curl_exec($curl);//执行预定义的CURL  
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);//获取http返回值  
    curl_close($curl);  
    $res = $data; //var_dump($res);  
    return ['status' => $status, 'result' => $res];  
}  

function c_curl($url, $data)
{
	$curl_handle = curl_init ();
    // Set default options.
    curl_setopt ( $curl_handle, CURLOPT_URL, $url);
    curl_setopt ( $curl_handle, CURLOPT_FILETIME, true );
    curl_setopt ( $curl_handle, CURLOPT_FRESH_CONNECT, false );

    curl_setopt ( $curl_handle, CURLOPT_HEADER, true );
    curl_setopt ( $curl_handle, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $curl_handle, CURLOPT_TIMEOUT, 5184000 );
    curl_setopt ( $curl_handle, CURLOPT_CONNECTTIMEOUT, 120 );
    curl_setopt ( $curl_handle, CURLOPT_NOSIGNAL, true );
    curl_setopt ( $curl_handle, CURLOPT_CUSTOMREQUEST, 'POST' );
    curl_setopt ( $curl_handle, CURLOPT_POSTFIELDS, $data );
    $aHeader[] = 'Content-Type:text/xml;charset=UTF-8';
    $aHeader[] = 'x-bs-ad:private'; 
    curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $aHeader);
    
    // $file = 'log';
    // $file_size = filesize($file);
    // $h = fopen($file, 'r');
    // curl_setopt ( $curl_handle, CURLOPT_INFILESIZE, $file_size);
    // curl_setopt ( $curl_handle, CURLOPT_INFILE, $h);
    // curl_setopt ( $curl_handle, CURLOPT_UPLOAD, true );
    
    $ret = curl_exec ( $curl_handle );
	curl_close ( $curl_handle );
	return $ret;
}

function m_curl($url, $data)
{
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt ( $ch, CURLOPT_POST, 1 );
    curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	$result = curl_exec ( $ch );
	curl_close ( $ch );
	return $result;
}

function A_curl($url, $data, $method = "GET")
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	// https
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	$method = strtoupper($method);
	if ($method == "POST") {
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

