<?php
echo "this is a simple string</br>";

echo "You can also have embedded newlines in strings
this was as it it
okay to do</br>";

//Outputs: This will expand:
//            a newline
echo "This will expand: </br>a newline</br>";

//Outputs: Variables do 12;
$expand = 12;
echo "Variables do $expand</br>";
?>

<!-- echo is a language cinstruct - can 
be treated like a function with one parameter.
Without parantheses, it accepts, multiple
parameters. -->

<!-- print is a function - only one
parameter, but parentheses are 
optional so it can look like a 
language construct -->

<?php
$x = "15" + 27;
echo $x;
echo ("</br>");
echo $x, "</br>";

print $x;
print "</br>";
print ($x);
print ("</br>");
?>