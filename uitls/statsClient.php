<?php
/**
 *
 * User: suyin
 * Date: 2017/7/19 14:53
 *
 */
$data = file_get_contents("php://input");

//$param = json_decode($data,true);
//var_dump($param);exit;
/**
 * ************************************************************
 *
 * 使用特定function对数组中所有元素做处理
 *
 * @param
 *        	string &$array 要处理的字符串
 * @param string $function
 *        	要执行的函数
 * @return boolean $apply_to_keys_also 是否也应用到key上
 * @access public
 *
 *         ***********************************************************
 */
function arrayRecursive(&$array, $function, $apply_to_keys_also = false) {
    static $recursive_counter = 0;
    if (++ $recursive_counter > 1000) {
        die ( 'possible deep recursion attack' );
    }
    foreach ( $array as $key => $value ) {
        if (is_array ( $value )) {
            arrayRecursive ( $array [$key], $function, $apply_to_keys_also );
        } else {
            $array [$key] = $function ( $value );
        }

        if ($apply_to_keys_also && is_string ( $key )) {
            $new_key = $function ( $key );
            if ($new_key != $key) {
                $array [$new_key] = $array [$key];
                unset ( $array [$key] );
            }
        }
    }
    $recursive_counter --;
}

/**
 * ************************************************************
 *
 * 将数组转换为JSON字符串（兼容中文）
 *
 * @param array $array
 *        	要转换的数组
 * @return string 转换得到的json字符串
 * @access public
 *
 *         ***********************************************************
 */
function JSON($array) {
    arrayRecursive ( $array, 'urlencode', true );
    $json = json_encode ( $array );
    return urldecode ( $json );
}

/**
 * 系统加密方法
 *
 * @param string $data
 *        	要加密的字符串
 * @param string $key
 *        	加密密钥
 * @param int $expire
 *        	过期时间 单位 秒
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_encrypt($data, $key = '', $expire = 0) {
    $key = md5 ( empty ( $key ) ? C ( 'DATA_AUTH_KEY' ) : $key );

    $data = base64_encode ( $data );
    $x = 0;
    $len = strlen ( $data );
    $l = strlen ( $key );
    $char = '';

    for($i = 0; $i < $len; $i ++) {
        if ($x == $l)
            $x = 0;
        $char .= substr ( $key, $x, 1 );
        $x ++;
    }

    $str = sprintf ( '%010d', $expire ? $expire + time () : 0 );

    for($i = 0; $i < $len; $i ++) {
        $str .= chr ( ord ( substr ( $data, $i, 1 ) ) + (ord ( substr ( $char, $i, 1 ) )) % 256 );
    }
    return str_replace ( array (
        '+',
        '/',
        '='
    ), array (
        '-',
        '_',
        ''
    ), base64_encode ( $str ) );
}

/**
 * 系统解密方法
 *
 * @param string $data
 *        	要解密的字符串 （必须是think_encrypt方法加密的字符串）
 * @param string $key
 *        	加密密钥
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_decrypt($data, $key = '') {
    $key = md5 ( empty ( $key ) ? C ( 'DATA_AUTH_KEY' ) : $key );
    $data = str_replace ( array (
        '-',
        '_'
    ), array (
        '+',
        '/'
    ), $data );
    $mod4 = strlen ( $data ) % 4;
    if ($mod4) {
        $data .= substr ( '====', $mod4 );
    }
    $data = base64_decode ( $data );
    $expire = substr ( $data, 0, 10 );
    $data = substr ( $data, 10 );

    if ($expire > 0 && $expire < time ()) {
        return '';
    }
    $x = 0;
    $len = strlen ( $data );
    $l = strlen ( $key );
    $char = $str = '';

    for($i = 0; $i < $len; $i ++) {
        if ($x == $l)
            $x = 0;
        $char .= substr ( $key, $x, 1 );
        $x ++;
    }

    for($i = 0; $i < $len; $i ++) {
        if (ord ( substr ( $data, $i, 1 ) ) < ord ( substr ( $char, $i, 1 ) )) {
            $str .= chr ( (ord ( substr ( $data, $i, 1 ) ) + 256) - ord ( substr ( $char, $i, 1 ) ) );
        } else {
            $str .= chr ( ord ( substr ( $data, $i, 1 ) ) - ord ( substr ( $char, $i, 1 ) ) );
        }
    }
    return base64_decode ( $str );
}

/**
 * 发送数据包给远程服务器。
 *
 * @param array $data
 * @return bool 请求是否成功
 */
function _do_request($data) {
    $key = 'wx00f249ca19e47f51';
    $url = "http://stats-collect.sjh.develop.csmall.com/receiveData";
//    $params = array();
//    foreach ($data as $key => $value) {
//        $params[] = $key . '=' . urlencode($value);
//    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 100);//尝试连接等待的时间，以毫秒为单位。如果设置为0，则无限等待。
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 100000);//设置cURL允许执行的最长毫秒数。
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,  $data);
    curl_setopt($ch, CURLOPT_USERAGENT, "js SDK");
    $ret = curl_exec($ch);

    if (false === $ret) {
        curl_close($ch);
        return false;
    } else {
        curl_close($ch);
        return true;
    }

}
//echo "<pre>";
//var_dump($data);exit;
_do_request($data);