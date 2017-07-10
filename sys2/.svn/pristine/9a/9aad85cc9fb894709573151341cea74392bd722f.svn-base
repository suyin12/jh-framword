<?php
/*
*       2012-8-16
*       <<<  连接各种设置类  >>>
*       create by Great sToNe
*       have fun,.....
*/
class classLink
{
    public $pdo;
    public $unitArr; //array  单位相关的基础信息
    public $a; //object  返回市场相关的对象
    public $b; //object  返回岗位相关的对象
    public $c; //object  返回员工编码转文字相关的对象
    public $d; //object  返回系统用户相关对象
    public $e; // object  返回招聘信息设置的对象
    public $f; //object  返回通知回访等状态相关信息的对象
    public $g; //object  返回员工信息相关的对象
    public $h; //object  返回网上办公员工信息相关的对象
    public $i; //object 返回网上办公员工信息配置相关的对象

    #class market 的链接属性函数
    public function marketClass($marketBasic = array('selStr' => '', 'conStr' => ''), $order = array('conStr' => ''))
    {
        $a = new market ();
        $a->pdo = $this->pdo;
        $a->marketBasic($marketBasic ['selStr'], $marketBasic ['conStr']);
        $a->marketOrder($order ['conStr']);
        return $this->a = $a;
    }

    #class position 的链接属性函数
    public function positionClass($positionBasic = array('selStr' => '', 'conStr' => ''))
    {
        $b = new position ();
        $b->pdo = $this->pdo;
        $b->positionBasic($positionBasic ['selStr'], $positionBasic ['conStr']);
        return $this->b = $b;
    }

    #class wInfo 的连接属性
    public function wInfoClass($wInfoBasic = array('selStr' => '', 'conStr' => ''))
    {
        $g = new wInfo ();
        $g->pdo = $this->pdo;
        $g->wInfoBasic($wInfoBasic ['selStr'], $wInfoBasic ['conStr']);
        return $this->g = $g;
    }

    #class wInfoSet 的链接属性函数
    public function wInfoSetClass()
    {
        $c = new wInfoSet ();
        $c->p = $this->pdo;
        $c->wInfoSetArr();
        return $this->c = $c;
    }

    #class unit 的链接属性函数 -- unit函数是早期写的,没有写成相应的类,只写了操作方法,对付着用先
    public function unitClass($unitBasic = array('selStr' => '', 'conStr' => ''))
    {
        $pdo = $this->pdo;
        $unitArr = unitAll($pdo, $unitBasic ['selStr'], $unitBasic ['conStr']);
        return $this->unitArr = $unitArr;
    }

    #class user 的链接属性函数
    public function userClass($userBasic = array('selStr' => '', 'conStr' => ''))
    {
        $d = new user ();
        $d->pdo = $this->pdo;
        $d->userBasic($userBasic ['selStr'], $userBasic ['conStr']);
        return $this->d = $d;
    }

    #class recruitInfoSet 的连接属性函数
    public function recruitInfoSetClass()
    {
        $e = new recruitInfoSet ();
        $e->pdo = $this->pdo;
        $e->recruitInfoSetBasic();
        return $this->e = $e;
    }

    #class tInfoStatus 的连接属性函数
    public function tInfoStatusClass()
    {
        $f = new tInfoStatus ();
        $f->pdo = $this->pdo;
        return $this->f = $f;
    }

    #class web_worker 的链接属性
    public function web_workerClass($web_workerBasic = array('selStr' => '', 'conStr' => ''))
    {
        $h = new web_worker();
        $h->pdo = $this->pdo;
        $h->web_workerBasic($web_workerBasic ['selStr'], $web_workerBasic ['conStr']);
        return $this->h = $h;
    }

    #class web_wInfoSet 的链接属性
    public function  web_wInfoSetClass()
    {
        $i = new web_wInfoSet();
        $i->web_wInfoSetBasic();
        return $this->i=$i;
    }
}

?>