<?php
/**
 *
 * User: suyin
 * Date: 2017/7/10 11:46
 *
 */
echo phpinfo();

//class Container{
//    public $bindings;
//    public function bind($abstract,$concrete){
//        $this->bindings[$abstract]=$concrete;
//    }
//    public function make($abstract,$parameters=[]){
//        return call_user_func_array($this->bindings[$abstract],$parameters);
//    }
//}
//
////服务注册（绑定）
//$container=new Container();
//$container->bind('db',function($arg1,$arg2){
//    return new DB($arg1,$arg2);
//});
//
//$container->bind('session',function($arg1,$arg2){
//    return new Session($arg1,$arg2);
//});
//
//$container->bind('fs',function($arg1,$arg2){
//    return new FileSystem($arg1,$arg2);
//});
////容器依赖
//
//class Writer{
//    protected $_db;
//    protected $_filesystem;
//    protected $_session;
//    protected $container;
//    public function Writer(Container $container){
//        $this->_db=$container->make('db',[1,2]);
//        $this->_filesystem=$container->make('session',[3,4]);
//        $this->_session=$container->make('fs',[5,6]);
//    }
//}
//
//$writer=new Writer($container);