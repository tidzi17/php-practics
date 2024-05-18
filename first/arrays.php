<?php
echo "ARRAYS<br>"
?>

<?php
$stuff = array("name" => "Chuck",
                "course" => "WA4E");
echo ("<pre><br>");
print_r($stuff);
echo("<br></pre><br>")
/* Array
(
    [name] => Chuck
    [course] => WA4E
) */
?>

<?php
$stuff = array("name" => "Chuck",
                "course" => "WA4E");
var_dump($stuff); //shows false
echo "<br>";
echo "<br>";
/*array(2) { ["name"]=> string(5) "Chuck" ["course"]=> string(4) "WA4E" }  */
?>

<!-- MAPING -->
<?php
$stuff = array("name" => "Chuck",
                "course" => "SI664");
foreach ( $stuff as $k => $v ) {
    
    echo "Key=",$k, " Val=", $v,"<br>";
    echo "<br>";
    echo "<br>";
}

?>

<!-- COUNTED LOOP THROUGH AN ARRAY -->
<?php
$something = array("Chuck","SI664");
for ( $i=0; $i < count($something); $i++ ) {
    echo "I=",$i," Val=",$something[$i],"<br>";
}
/* 
I=0 Val=Chuck
I=1 Val=SI664 */

?>


<!-- ARRAYS of ARRAYS -->
<?php
$products = array(
    'paper' => array(
        'copier' => "Copier & Multipurpose",
        'inkjet' => "Inkjet Printer",
        'laser' => "Laser Printer",
        'photo' => "Photographich Paper"
    ),
    'pens' => array(
        'ball' => "Ball Point",
        'hilite' => "Highlighters",
        'marker' => "Markers"
    ),
    'misc' => array(
        'tape' => "Sticky tape",
        'glue' => "Adhesives",
        'clips' => "Paperclips"
    ) 
    );
    echo $products["pens"]["marker"];
?>