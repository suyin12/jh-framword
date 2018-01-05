<?php
class Vcode{
    private $width;
    private $height;
    private $codeNum;
    private $disturbColorNum;
    private $checkCode;
    private $image;

    public function __construct($width = 80, $height = 20, $codeNum = 4){
        $this->width = $width;
        $this->height = $height;
        $this->codeNum = $codeNum;
        $number = floor($height*$width/15);
        if($number>240-$codeNum)
            $this->disturbColorNum = 240-$codeNum;
        else
            $this->disturbColorNum = $number;
        $this->checkCode = $this->createCheckCode();

    }

    function __toString(){
        $_SESSION['code'] = strtoupper($this->checkCode);
        $this->outImg();
        return '';
    }

    private function outImg(){
        $this->getCreateImage();
        $this->setDisturbColor();
        $this->outputText();
        $this->outputImage();
    }
    private function getCreateImage(){
        $this->image = imagecreatetruecolor($this->width,$this->height);

        $backColor = imagecolorallocate($this->image,rand(225,255),rand(225,255),rand(225,255));

        @imagefill($this->image,0,0,$backColor);

        $border = imagecolorallocate($this->image,0,0,0);

        imagerectangle($this->image,0,0,$this->width-1,$this->height-1,$border);

    }
    private function createCheckCode(){
        $ascii = '';
        $code = '3456789abcdefhjkmnpqrABCDEFHJKMNPQR';
        for($i=0;$i<$this->codeNum;$i++){
            $char = $code{rand(0,strlen($code)-1)};

            $ascii .= $char;
        }

        return $ascii;
    }
    private function setDisturbColor(){
        for($i=0;$i<$this->disturbColorNum;$i++){
            $color = imagecolorallocate($this->image,rand(0,255),rand(0,255),rand(0,255));
            imagesetpixel($this->image,rand(1,$this->width-2),rand(1,$this->height-2),$color);
        }
        for($j=0;$j<10;$j++){
            $color = imagecolorallocate($this->image,rand(0,255),rand(0,255),rand(0,255));
            imagearc($this->image,rand(1,$this->width-2),rand(1,$this->height-2),rand(30,300),rand(20,200),55,44,$color);
        }
    }
    private function outputText(){
        for($i=0;$i<$this->codeNum;$i++){
            $fontColor = imagecolorallocate($this->image,rand(0,128),rand(0,128),rand(0,128));
            $fontSize = 5;
            $x = floor($this->width/$this->codeNum)*$i+3;
            $y = rand(0,$this->height-imagefontheight($fontSize));

            imagechar($this->image,$fontSize,$x,$y,$this->checkCode{$i},$fontColor);
        }
    }
    private function outputImage(){
        if(imagetypes() & IMG_GIF){
            header('Content-type:image/gif');
            imagegif($this->image);
        }elseif(imagetypes() & IMG_JPEG){
            header('Content-type:image/jpeg');
            imagejpeg($this->image);
        }elseif(imagetypes() & IMG_PNG){
            header('Content-type:image/png');
            imagepng($this->image);
        }elseif(imagetypes() & IMG_WBMP){
            header('Content-type:image/wbmp');
            imagewbmp($this->image);
        }else{
            die('不支持的图像类型!');
        }

    }
    public function __destruct(){
        imagedestroy($this->image);
    }
}