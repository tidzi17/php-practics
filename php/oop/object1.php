<?php
class Person {
    public $fullname = false;
    public $givenname = false;
    public $familyname = false;
    public $room = false;
    function get_name(){
        if ( $this->fullname !== false) return $this->fullname;
        if ( $this->familyname !== false && $this->givenname !== false) {
            return $this->givenname . ' ' . $this->familyname;
        }
        return false;
    }
}

$chuck = new Person();
$chuck->fullname = "Chuck Severance";
$chuck->room = "4429NQ";

$colleen = new Person();
$colleen->familyname = "van Lent";
$colleen->givenname = "Colleen";
$colleen->room = '3439NQ';

print $chuck->get_name() . "</br>";
print $colleen->get_name() . "</br>";
?>

<?php
$z = new DateTime('2012-01-31');
echo $z->format('Y-m-d') . "</br>";

?>

<?php
class PartyAnimal{
    function __construct(){
        echo("Constructed </br>");
    }
    function something(){
        echo("Something </br>");
    }
    function __destruct(){
        echo("Desstructed");
    }
}

echo ("--One </br>");
$x = new PartyAnimal();

echo("--Two</br>");
$y = new PartyAnimal();

echo("--Three</br>");
$x->something();

echo("--The End?");
?>

</br>
</br>
