<?php
/**
 * Created by PhpStorm.
 * User: qishou
 * Date: 15-8-2
 * Time: 上午12:00
 */
//准备数组，代替从数据库中检索出的数据(共有三个必须字段id,name,pid)
header("content-type:text/html;charset=utf-8");
$categories = array(
    array('id'=>1,'name'=>'电脑','pid'=>0),
    array('id'=>2,'name'=>'手机','pid'=>0),
    array('id'=>3,'name'=>'笔记本','pid'=>1),
    array('id'=>4,'name'=>'台式机','pid'=>1),
    array('id'=>5,'name'=>'智能机','pid'=>2),
    array('id'=>6,'name'=>'功能机','pid'=>2),
    array('id'=>7,'name'=>'超级本','pid'=>3),
    array('id'=>8,'name'=>'游戏本','pid'=>3),
);













/*======================非递归实现========================*/
$tree = array();
//第一步，将分类id作为数组key,并创建children单元
foreach($categories as $category){
    $tree[$category['id']] = $category;
    $tree[$category['id']]['children'] = array();
}

//第二步，利用引用，将每个分类添加到父类children数组中，这样一次遍历即可形成树形结构。
foreach($tree as $key=>$item){
    if($item['pid'] != 0){
        $tree[$item['pid']]['children'][] = &$tree[$key];//注意：此处必须传引用否则结果不对
        if($tree[$key]['children'] == null){
            unset($tree[$key]['children']); //如果children为空，则删除该children元素（可选）
        }
    }
}
echo '<pre>';
var_dump($tree);
//第三步，删除无用的非根节点数据
foreach($tree as $key=>$category){
    if($category['pid'] != 0){
        unset($tree[$key]);
    }
}
//echo '<pre>';
//print_r($tree);