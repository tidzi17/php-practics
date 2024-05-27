<?php
class MyClass {
    public $pub = 'Public';
    protected $pro = 'Protected';
    private $priv = 'Private';

    function printHello(){
        echo $this->pub."</br>";
        echo $this->pro."</br>";
        echo $this->priv."</br>";
    }
}
$obj = new MyClass();
echo $obj->pub."</br>";//Works
echo $obj->pro."</br>";//Fatal Error
echo $obj->priv."</br>";//Fatal Error
$obj->printHello();//Shows Public, Protected and Private


class MyClass2 extends MyClass {
    function printHello(){
        echo $this->pub."</br>";
        echo $this->pro."</br>";
        echo $this->priv."</br>"; //Undefined
    }
}

echo ("---MyClass2---</br>");
$obj2 = new MyClass2();
echo $obj2->pub."</br>";//Works
$obj2->printHello();//Shows Public, Protected, Undefined

?>