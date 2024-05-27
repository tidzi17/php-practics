<?php
date_default_timezone_set('America/New_York');

$nextWeek = time() + (7 * 24 * 60 * 60);
echo 'Now:      '. date('Y-m-d')  . "</br>"; 
echo 'Next Week:      '. date('Y-m-d', $nextWeek)  . "</br>"; 

echo ("======</br>");


$now = new DateTime();
$nextWeek = new DateTime('today +1 week');
echo 'Now:             ' . $now->format('Y-m-d') . "</br>";
echo 'Next Week:             ' . $nextWeek->format('Y-m-d') . "</br>";
?>

<?php
$z = new DateTime('2012-01-31');
echo $z->format('Y-m-d') . "</br>";
?>