<!-- ARRAY FUNCTIONS -->
<!-- array_key_exists($key, $ar) - Returns TRUE if key is set in the array
isset($ar['key']) - Returns TRUE if key is set in the array
count($ar) - How many elements in an array
is_array($ar) - Returns TRUE if a variable is an array
sort($ar) - Sorts the array values (loses key)
ksort($ar) - Sorts the array by key
asort($ar) - Sorts array by vlaue, keeping key association
shuffle($ar) - Shuffles the array into random order -->



<?php
$stuff = array("Hi", "There");
echo $stuff[1], "</br>";
?>


<!-- key value -->
<?php
$stuff = array("name" => "Chuck",
                "course" => "WA4E");
echo $stuff["course"], "</br>";
?>



<!-- Dumping an array
The function print_r() shows PHP data - it is good for debugging-->
<?php
$something = array("name" => "Chuck",
                "course" => "WA4E");
echo("<pre></br>");
print_r($something);
echo("</br></pre></br>");
?>

<!-- Building Up an array
You can allocate a new item in the array and append a -
value at the same time using empty square braces [] on -
the right hand side of an assignment statement-->
<?php
$va = array();
$va[] = "Hello";
$va[] = "World";
print_r($va);
echo("</br>");

echo("</br>");
$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";
print_r($za);
echo("</br>");
?>



<!--Looping Through an Array t-->
<?php
$stuff = array ( "name" => "Chuck",
                "course" => "SI664");
    foreach($stuff as $k => $v ){
        echo "Key=",$k," Val=",$v,"</br>";
    }
?>


<!--Couted Loop Through an Array t-->
<?php
$stuff = array ( "Chuck", "SI664");
   for ( $i = 0; $i < count($stuff); $i++ ) {
    echo "I=",$i," Val=",$stuff[$i],"</br>";
   }
?>


<!--Arrays of --Arrays
the elements of an array can be may things other 
than a string or integer. You can have objects or other arrays.-->
<?php
$products = array(
    'paper' => array(
        'copier' => "Copier & Multipurpose",
        'inkjet' => "Inkjet Printer",
        'laser' => "Laser Printer",
        'photo' => "Photographic Paper"
    ),
    'pens' => array(
        'ball' => "Ball Point",
        'hilite' => "Highlithers",
        'marker' => "Markers"
    ),
    'misc' => array(
        'tape' => "Sticky Tape",
        'glue' => "Adhesives",
        'clips' => "Paperclips"
    )
    );
    echo $products["pens"]["marker"];
    echo "</br>";
?>



<!--  -->
<?php
$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";


if (array_key_exists('course', $za) ) {
    echo("Course exists </br>");
} else {
    echo("Course does not exist </br>");
}

echo isset($za['name']) ? "name is set </br>" : "name is not set </br>";
echo isset($za['addr']) ? "addr is set </br>" : "addr is not set </br>";
?>

<!-- NULL COALESCE  -->
<?php
$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";

$name = $za['name'] ?? 'not found';
$addr = $za['addrs'] ?? 'not found';

echo("Name=$name</br>");
echo("Addr=$addr</r4>");

/* PHP <br 7.0.0 equivalent */
$name = isset ($za['name']) ? $za['name'] : 'not found';
echo "</br>"
?>



<!-- COUNT -->
<?php
$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";
print "Count: " . count($za) . "</br>";
if ( is_array($za) ) {
    echo '$za is an array' . "</br>";
} else  {
    echo '$za Is not an arry' . "</br>";
}
?>


<!-- SORTING -->
<?php
$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";
$za["topic"] = "PHP";
print_r($za);
echo "</br>";
ksort($za);
print_r($za);
echo "</br>";
asort($za);
print_r($za);
echo "</br>";
?>



<!-- EXPLODING ARRAYS -->
<?php
$inp = "This is a sentence with a seven words";
$temp = explode(' ', $inp);
print_r($temp);
?>