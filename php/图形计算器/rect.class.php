<?php
class Rect extends Shape{
    private $width = 0;
    private $height = 0;

    function __construct(){
        $this->shapeName = '矩形';
        if($this->validate($_POST['width'],'宽度')&$this->validate($_POST['height'],'高度')){
            $this->width = $_POST['width'];
            $this->height = $_POST['height'];
        }
    }

    function area(){
        return $this->width*$this->height;
    }

    function perimeter()
    {
        // TODO: Implement perimeter() method.
        return ($this->width+$this->height)*2;
    }

}