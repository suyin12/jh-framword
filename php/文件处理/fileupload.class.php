<?php
class FileUpload{
    /**
     * @type string 上传目录
     */
    private $path = "./Uploads";
    /**
     * @type array 上传类型
     */
    private $allowType = array('jpg','png','gif');
    /**
     * @type integer 允许上传最大字节
     */
    private $maxsize = 1000000;
    /**
     * @type boolean 是否随机命名
     */
    private $isRandName = true;
    //源文件名
    private $originName;
    //临时文件名
    private $tmpFileName;
    //文件类型,扩展名
    private $fileType;
    //新文件名
    private $newFileName;
    //错误号
    private $errorNum = 0;
    //错误信息
    private $errorMess = '';

    /**
     * 用于设置成员属性($path,$maxsize,$allowType,$isRandName)
     * 可以通过连贯操作一次性设置多个属性值
     * @param string $key 成员属性值(不区分大小写)
     * @param mixed $val 为成员属性设置的值
     *
     * @return object 返回自己的对象,可用于连贯操作
     */
    public function set($key,$val){
        $key = strtolower($key);
        if(array_key_exists($key,get_class_vars(get_class($this)))){
            $this->setOption($key,$val);
        }

        return $this;
    }
    /**
     * 调用该方法上传文件
     *
     * @param string $fileFiled 上传文件的表单名称
     *
     * @return bool 上传成功返回true
     *
     */
    public function upload($fileFiled){
        $return = true;
        /* 检查文件路径是否合法 */
        if(!$this->checkFilePath()){
            $this->errorMess = $this->getError();
            return false;
        }

        /* 将文件上传的信息取出赋给变量 */
        $name = $_FILES[$fileFiled]['name'];
        $tmpName = $_FILES[$fileFiled]['tmp_name'];
        $size = $_FILES[$fileFiled]['size'];
        $error = $_FILES[$fileFiled]['error'];

        /* 如果多个文件上传$file['name']是一个数组 */
        if(is_array($name)){
            $errors = array();
            /* 多个文件上传则循环处理,这个循环只有检查上传文件的作用,并没有真正上传 */
            for($i = 0; $i < count($name); $i++){
                /* 设置文件信息 */
                if($this->setFiles($name[$i],$tmpName[$i],$size[$i],$error[$i])){
                    if(!$this->checkFileSize() || !$this->checkFileType()){
                        $errors[] = $this->getError();
                        $return = false;
                    }
                }else{
                    $errors[] = $this->getError();
                    $return = false;
                }

                /* 如果有问题,则重新初始化属性 */
                if(!$return)
                    $this->setFiles();

            }

            if($return){
                /* 存放所有上传后文件名的变量数组 */
                $fileNames = array();
                /* 如果上传的文件都是合法的,则通过循环向服务器上传文件 */
                for($i = 0; $i < count($name); $i++){
                    if($this->setFiles($name[$i],$tmpName[$i],$size[$i],$error[$i])){
                        $this->setNewFileName();
                        if(!$this->copyFile()){
                            $errors[] = $this->getError();
                            $return = false;
                        }
                        $fileNames[] = $this->newFileName;
                    }

                }
                $this->newFileName = $fileNames;
            }
            $this->errorMess = $errors;
            return $return;
        /* 上传单个文件的处理方法 */
        }else{
            /* 设置文件信息 */
            if($this->setFiles($name,$tmpName,$size,$error)){
                /* 上传前检查一下文件类型和文件大小 */
                if($this->checkFileSize() && $this->checkFileType()){
                    /* 为上传文件设置新文件名 */
                    $this->setNewFileName();
                    /* 上传文件,返回0为成功,小于0都为错误 */
                    if($this->copyFile()){
                        return true;
                    }else{
                        $return = false;
                    }
                }else{
                    $return = false;
                }
            }else{
                $return = false;
            }
            /* 如果$return为false,则出错,将错误信息保存在属性errorMess中 */
            if(!$return)
                $this->errorMess = $this->getError();

            return $return;

        }

    }
    /**
     * 获取上传后的文件名称
     *
     * @param void 无参数
     *
     * @return string 上传后,新的文件名,如果是多文件上传则返回数组
     */
    public function getFileName(){
        return $this->newFileName;
    }
    /**
     * 上传失败后,调用该方法返回,上传错误信息
     *
     * @param void 无参数
     *
     * @return string 返回上传文件出错的信息报告,如果是多文件返回数组
     */
    public function getErrorMsg(){
        return $this->errorMess;
    }
    /***
     *
     * 设置上传出错信息
     *
     */
    private function getError(){
        $str = "上传文件<font color='red'>{$this->originName}</font>时出错";
        switch($this->errorNum){
            case 4: $str .= "没有文件被上传";break;
            case 3: $str .= "文件只有部分被上传";break;
            case 2: $str .= "上传的文件大小超过了HTML表单MAX_FILE_SIZE选项指定的值";break;
            case 1: $str .= "上传的文件大小超过了php.ini中upload_max_filesize选项限定的值";break;
            case -1:$str .= "未允许类型";break;
            case -2:$str .= "上传文件过大,上传的文件不能超过{$this->maxsize}个字节";break;
            case -3:$str .= "上传失败";break;
            case -4:$str .= "建立存放上传文件目录失败,请重新指定上传目录";break;
            case -5:$str .= "必须指定上传文件的路径";break;
            default:$str .= "未知错误";break;
        }

        return $str . '<br>';
    }
    /***
     * 设置和$_FILE有关的内容
     */
    private function setFiles($name='',$tmpName='',$size = 0,$error = 0){
        $this->setOption('errorNum',$error);
        if($error)
            return false;
        $this->setOption('originName',$name);
        $this->setOption('tmpFileName',$tmpName);
        $artStr = explode('.',$name);
        $this->setOption('fileType',strtolower(end($artStr)));
        $this->setOption('fileSize',$size);

        return true;
    }
    /***
     * 为单个成员属性设置值
     */
    private function setOption($key,$val){
        $this->$key = $val;
    }
    /***
     * 设置上传后的文件名称
     */
    private function setNewFileName(){
        if($this->isRandName){
            $this->setOption('newFileName',$this->proRandName());
        }else{
            $this->setOption('newFileName',$this->originName);
        }
    }
    /***
     * 检查上传文件是否是合法类型
     */
    private function checkFileType(){
        if(in_array(strtolower($this->fileType),$this->allowType)){
            return true;
        }else{
            $this->setOption('errorNum',-1);
            return false;
        }
    }
    /***
     * 检查上传文件是否允许大小
     */
    private function checkFileSize(){
        if($this->fileSize > $this->maxsize){
            $this->setOption('errorNum',-2);
            return false;
        }else{
            return true;
        }
    }
    /***
     * 检查是否有存放上传文件目录
     */
    private function checkFilePath(){
        if(empty($this->path)){
            $this->setOption('errorNum',-5);
            return false;
        }
        if(!file_exists($this->path) || !is_writeable($this->path)){
            if(!@mkdir($this->path,0755)){
                $this->setOption('errorNum',-4);
                return false;
            }
        }
        return true;
    }
    /***
     * 设置随机新的文件名
     */
    private function proRandName(){
        $fileName = date('YmdHis').'_'.rand(100,999);
        return $fileName.'.'.$this->fileType;
    }
    /***
     * 复制上传文件到指定的位置
     */
    private function copyFile(){
        if(!$this->errorNum){
            $path = trim($this->path,'/').'/';
            $path .= $this->newFileName;
            if(@move_uploaded_file($this->tmpFileName,$path)){
                return true;
            }else{
                $this->setOption('errorNum',-3);
                return false;
            }
        }else{
            return false;
        }
    }

}