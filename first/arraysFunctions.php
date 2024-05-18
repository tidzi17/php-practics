<?php
echo "ARRAYS FUNCTIONS<br>"
?>

<?php
$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";
echo (isset($za["name"]) ? "name is set<br>" : "name is not set<br>");
echo (isset($za["addr"]) ? "addr is set<br>" : "addr is not set<br>");
?>

<?php
$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";
$name = $za['name'] ?? 'not found';
$addr = $za['addr'] ?? 'not found';

echo("Name = $name <br>");
echo("Addr = $addr <br>");
echo("<br>")
/* 
Name = Chuck
Addr = not found  */
?>

<?php
$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";
print "Count: " . count($za) . "<br>";
if ( is_array($za) ) {
    echo '$za Is an array' . "<br>";
} else {
    echo '$za Is not an array' . "<br>";
}
echo("<br>");
echo("<br>");
/* 
Count: 2
$za Is an array */
?>

<!-- SORT -->
<?php
$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";
$za["topic"] = "PHP";
print_r($za);
echo "<br>";

ksort($za);
print_r($za);

echo "<br>";
asort($za);

print_r($za);

echo "<br>";
echo "<br>";
/* Array ( [name] => Chuck [course] => WA4E [topic] => PHP )
Array ( [course] => WA4E [name] => Chuck [topic] => PHP )
Array ( [name] => Chuck [topic] => PHP [course] => WA4E )  */
?>

<!-- EXPLODE -->
<?php
$inp = "This is a sentence with seven words";
$temp = explode(' ', $inp);
print_r($temp);

/*Array ( [0] => This [1] => is [2] => a [3] => sentence [4] => with [5] => seven [6] => words ) */
?>
