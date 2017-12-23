<?php
class Circle extends Shape{
    private $radius;

    function __construct(){
        $this->shapeName = '圆形';
        if($this->validate($_POST['radius'])){
            $this->radius = $_POST['radius'];
        }
    }

    function area()
    {
        // TODO: Implement area() method.
        return pi()*$this->radius*$this->radius;
    }

    function perimeter()
    {
        // TODO: Implement perimeter() method.
        return 2*pi()*$this->radius;
    }
}