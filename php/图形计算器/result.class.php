<?php
class Result{
    private $shape = null;

    function __construct(){
        $this->shape = new $_GET['action']();
    }

    function __toString(){
        $result = '<center>'.$this->shape->shapeName.'的周长'.round($this->shape->perimeter(),2).'<br>';
        $result .= $this->shape->shapeName.'的面积'.round($this->shape->area(),2).'</center>';

        return $result;
    }
}