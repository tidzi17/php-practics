<?php
class PartyAnimal {
    function __construct(){
        echo ("Constructed</br>");
    }
    function something() {
        echo("Something</br>");
    }
    function __destruct() {
        echo("Destructed</br>");
    }
}

echo ("--One</br>");
$x = new PartyAnimal();
echo ("--Two</br>");
$y = new PartyAnimal();
echo("--Three</br>");
$x->something();
echo("--The End</br>")
?>