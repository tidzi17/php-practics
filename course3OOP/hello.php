<?php
class Hello {
    protected $lang; //Only accessible in the class
    function __construct($lang) {
        $this->lang = $lang;
    }
    function greet() {
        if ($this->lang == 'fr') return 'Bonjour';
        if ($this->lang == 'es') return 'Hola';
        return 'Hello';
    }
}

$hi = new Hello('es');
echo $hi->greet(). "</br>";
?>