<?php
/**
 * Auth: sjh
 * Date: 2018/2/24 14:38
 */

/**
 * session的数据库驱动 将会话信息自定义到数据库中
 */
class MEMSession{
    const NS = 'session_';                 //声明一个memcached键前缀,防止冲突
    protected static $mem = null;        //声明一个处理器,使用memcached出来session信息
    protected static $lifetime = null;   //声明Session的生命周期

    public static function start(Memcache $mem){
        self::$mem = $mem;
        self::$lifetime = ini_get('session.gc_maxlifetime');

        /*在php.ini中设置session.save_handler的值为'user'时被系统调用,开始调用每个生命周期过程*/
        /*因为是回调类中的静态方法作为参数,所以每个参数需要使用数组指定静态方法所在的类*/
        session_set_save_handler(
            array(__CLASS__,'open'),
            array(__CLASS__,'close'),
            array(__CLASS__,'read'),
            array(__CLASS__,'write'),
            array(__CLASS__,'destroy'),
            array(__CLASS__,'gc')
        );
        session_start();

    }
    private static function open($path,$name){
        return true;
    }
    public static function close(){
        return true;
    }
    private static function read($sid){
        /*通过key从memcache中获取当前用户的Session数据*/
        $out = self::$mem->get(self::session_key($sid));
        if($out === false || $out === ''){
            return '';
        }

        return $out;
    }
    public static function write($sid,$data){
        /*将数据写入到memcache服务器中*/
        $method = $data ? 'set':'replace';
        return self::$mem->$method(self::session_key($sid),$data,MEMCACHE_COMPRESSED,self::$lifetime);
    }
    public static function destroy($sid){
        /*销毁在memcache中指定的用户会话数据*/
        return self::$mem->delete(self::session_key($sid));
    }
    public static function gc($lifetime){
        return true;
    }

    public static function session_key($sid){
        $session_key = '';
        if(defined('PROJECT_NS')){
            $session_key .= PROJECT_NS;
        }
        $session_key .= self::NS.$sid;

        return $session_key;
    }

}