<?php
/*
此文件定义一些全局函数，方便调用
*/

/*打印*/
function p($arr)
{
	echo "<pre>";
	print_r($arr);
	// var_dump($arr);
	echo "</pre>";
	die;
}

/*ajax 返回值(用户后台)*/
function showRes($code = 200, $mes = '', $url = '', $data = '')
{
	$res = array(
        "status" => $code,
        "mes" => $mes,
        "url" => $url,
        "data" => $data,
    );
    return json_encode($res, JSON_UNESCAPED_UNICODE);
}

/*产生6位随机字符串*/
function generateStr($length=6) { 
    // 密码字符集，可任意添加你需要的字符 
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
    $randStr = ''; 
        for($i=0; $i<$length; $i++) { 
            // 这里提供两种字符获取方式 
            // 第一种是使用 substr 截取$chars中的任意一位字符； 
            // $randStr .= substr($chars, mt_rand(0, strlen($chars) – 1), 1); 
            // 第二种是取字符数组 $chars 的任意元素 
            $randStr .= $chars[mt_rand(0, strlen($chars)-1)];
        };
    return $randStr; 
}

?>