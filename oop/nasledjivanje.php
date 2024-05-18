<?php
class Hello {
    protected $lang; //Only accessible in the class
    function __construct($lang) {
        $this->lang = $lang;
    }
    function greet() {
        if ( $this->lang == "fr" ) return 'Bonjour!';
        if ( $this->lang == "es" ) return 'Hola!';
        return 'Hello';
    }
}

class Social extends Hello {
    function buy(){
        if ( $this->lang == "fr" ) return 'Av u revior!';
        if ( $this->lang == "es" ) return 'adios!';
    }
}


$hi = new Social('es');
echo $hi->greet() . "</br>";
echo $hi->buy() . "</br>";
?>