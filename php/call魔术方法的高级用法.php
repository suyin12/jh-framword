<?php
class DB{
    private $sql = array(
        'field' => '',
        'where' => '',
        'order' => '',
        'limit' => '',
        'group' => '',
        'having'=> ''
    );

    function __call($functionName,$args){
        $functionName = strtolower($functionName);

        if(array_key_exists($functionName,$this->sql)){
            $this->sql[$functionName] = $args[0];
        }else{
            echo '调用类'.get_class($this).'方法'.$functionName.'()不存在';
        }

        return $this;
    }

    function select(){
        echo "select {$this->sql['field']} from user {$this->sql['where']} {$this->sql['order']}
          {$this->sql['limit']}{$this->sql['group']}{$this->sql['having']} ";
    }
}

$db = new DB;

$db->field('sex,count(sex)')
    ->where('where sex in("男","女")')
    ->group('group by sex')
    ->having(' having avg(age)>25')
    ->select();

$db->query('select * from user');