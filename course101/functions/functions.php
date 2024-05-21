<!-- BUILT-IN FUNCTIONS -->
<?php
echo strrev(" .dlrow olleH "); /* Hello world. */
echo str_repeat(" Hip ", 2); /* Hip Hip */
echo strtoupper(" hooray! "); /* HOORAY! */
echo "</br>";
?>


<!-- Defining function -->
<!-- We use the function keyword to define a function,
we name the function and tako optional argument variables.
The body of the function is in a block of code{} -->
<?php
function greet(){
    print "Hello</br>";
}
greet();
greet();
?>

<!-- Return values -->
<!-- Often a function will tako its arguments, do some --
computation, and return a value to be used as the value of the --
function call in the calling expression.
The 'return' keyword is used for this. -->
<?php
function greeting() {
    return "Hello";
}
print greeting() . " Glenn</br> ";
print greeting() . " Sally</br> ";
?>




<!-- ARGUMENTS -->
<!-- Functions can choose to accept optional arguments. Within the function
definition the variable names are effectively "aliases" to the valies passed in
when the function is called -->
<?php
function howdy($lang) {
    if ( $lang == 'es' ) return "Hola";
    if ( $lang == 'fr' ) return "Bonjour";
    return "Hello"; 
}
print howdy('es') . " Glenn</br> ";
print howdy('fr') . "Sally</br>"
?>


<!-- Optional Arguments -->
<?php
function heyy($lang='es') {
    if ( $lang == 'es' ) return "Hola";
    if ( $lang == 'fr' ) return "Bonjour";
    return "Hello"; 
}
print heyy('es') . " Glenn</br> ";
print heyy('fr') . "Sally</br>"
?>



<!-- CALL BY VALUE -->
<!-- The argument variable within the function is an 'alias'
to the actual variable. But even further, the alias is to a *copy*
of the actual variable in the function call -->
<?php
function double($alias) {
    $alias = $alias * 2;
    return $alias;
}
$val = 10;
$dval = double($val);
echo "Value = $val Doubled = $dval</br>";
?>



<!-- CALL BY REFERENCE -->
<!-- Sometimes we want a function to change on of its arguments,
so we indicate that an argument is 'by reference' using ( & ) -->
<?php
function triple(&$realthing) {
    $realthing = $realthing * 3;
}
$val = 10;
triple($val);
echo "Triple = $val</br>";
?>