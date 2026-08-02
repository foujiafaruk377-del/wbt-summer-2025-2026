<?php
$principal = 10000;
$rate = 5;
$time = 2;

$simpleInterest = ($principal * $rate * $time) / 100;

echo "1. Simple Interest Calculation<br>";
echo "Principal = $principal<br>";
echo "Rate = $rate%<br>";
echo "Time = $time Years<br>";
echo "Simple Interest = $simpleInterest<br><br>";
?>
<!-- 2 -->
<?php
$number = 17;
$count = 0;

for($i = 1; $i <= $number; $i++){
    if($number % $i == 0){
        $count++;
    }
}

if($count == 2){
    echo "$number is Prime";
}
else{
    echo "$number is Not Prime";
}

?>

<!-- 3 -->
 <?php
 $n = 5;
$factorial = 1;

for ($i = 1; $i <= $n; $i++) {
    $factorial *= $i;
}

echo "3. Factorial Calculation<br>";
echo "Number = $n<br>";
echo "Factorial = $factorial<br><br>";
?>

<!-- 4 -->
 <?php 
 $numbers = [10, 20, 30, 40, 50];
$sum = 0;

for ($i = 0; $i < count($numbers); $i++) {
    $sum += $numbers[$i];
}

$average = $sum / count($numbers);

echo "4. Sum and Average of Array<br>";
echo "Array: " . implode(", ", $numbers) . "<br>";
echo "Sum = $sum<br>";
echo "Average = $average<br><br>";
 ?>

<!-- 5 -->
 <?php
 echo "5. Pattern<br>";

for ($i = 1; $i <= 4; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "$i ";
    }
    echo "<br>";
}
?>