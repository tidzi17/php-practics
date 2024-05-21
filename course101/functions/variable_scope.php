<!-- Normal scope (isolated) -->
<?php
function tryzap(){
    $val = 100;
}
$val = 10;
tryzap();
echo "TryZap = $val</br>";
?>


<!-- Global Scope (shared) -->
<?php
function dozap(){
    global $val;
    $val = 100;
}
$val = 10;
dozap();
echo "DoZap = $val</br>";
?>