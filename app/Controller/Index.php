<?php
/**
 *
 * User: suyin
 * Date: 2017/6/30 15:49
 *
 */
namespace Controller;

class Index extends Controller {
    public function indexAction() {
        $model = new Test();
        $result = $model->doSomething();

        $this->render(['sq'=>$result]);
    }
    public function login(){
        echo "你好,世界!";
    }
}