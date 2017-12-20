<?php
/**
 * Date: 2017/11/15 9:15
 */
class Bim
{
    public function doSomething()
    {
        echo __METHOD__."<br />";
    }
}

class Bar
{
    private $bim;

    public function __construct(Bim $bim)
    {
        $this->bim = $bim;
    }

    public function doSomething()
    {
        $this->bim->doSomething();
        echo __METHOD__."<br />";
    }
}

class Foo
{
    private $bar;

    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }

    public function doSomething()
    {
        $this->bar->doSomething();
        echo __METHOD__;
    }
}

//$foo = new Foo(new Bar(new Bim()));
//$foo->doSomething(); // Bim::doSomething|Bar::doSomething|Foo::doSomething

//echo "<pre>";
//print_r($_SERVER);
header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
echo "404";