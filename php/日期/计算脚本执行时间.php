<?php
//class Timer{
//    private $sTime;
//    private $eTime;
//
//    function start(){
//        $this->sTime = microtime(true);
//    }
//    function end(){
//        $this->eTime = microtime(true);
//    }
//    function spent(){
//        return round($this->eTime-$this->sTime,4);
//    }
//}
//
//$time = new Timer;
//$time->start();
//usleep(1000);
//$time->end();
//
//echo $time->spent();
echo microtime(true);echo '<br>';
echo microtime();
