<?php 

function round_up ( $value, $precision ) { 
    $pow = pow ( 10, $precision ); 
    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow; 
} 

if(isset($_POST['mul']) && isset($_POST['mart']) && isset($_POST['start']) && isset($_POST['steps']) && isset($_POST['tp']) &&isset($_POST['pppl']) && isset($_POST['spread'])){
	$mul = $_POST['mul'];
	$mart = $_POST['mart'];
	$start = $_POST['start'];

	$steps = $_POST['steps']/10000;
	$price = 1.0000;
	$tp =    $_POST['tp']/10000;

	$spread = $_POST['spread']/10000;

	//echo "steps=>".$steps."<br>";
	echo "1=>".$start." lots | MP=>0 | AP=>0 | TP=>-".$_POST['tp']." | DD=>0<br>";
	$last = 1;
	$avgprice = $price;

	$lastLot=$start;
	$old=$start;

	$priceNoSpread = $price;

	while($mart>0){

		$mart--;
		$last++;
		$price = $price + $steps + $spread;

		$priceNoSpread = $priceNoSpread + $steps;

		echo $last."=>";
		$start = round_up($start, 2);

		echo $start;

		$old = $start;
		
		$start = round_up(($lastLot*$mul),2);
		$lastLot = $start;

		$avgprice = round_up((($avgprice*$old) + ($priceNoSpread*$start))/($old+$start),4);


		echo " + ".$start." = ";

		$start = $start+$old;

		$dd = round_up($start*$_POST['pppl']*($price - $avgprice)/0.0001,2);
		$mp = round_up((($priceNoSpread-1)/0.0001),2);
		$ap = round_up((($avgprice-1)/0.0001),2);
		$tpx = round_up(((($avgprice-$tp)-1)/0.0001),2);

		echo $start." lots | MP=>".$mp." | AP=>".$ap." | TP=>".$tpx." | DD=>-".$dd."<br>";
	}

	die();
}
?>

<form method="post">
  Multiplier:<br>
  <input type="text" name="mul">
  <br>
  Number of Martingales:<br>
  <input type="text" name="mart">
  <br>
  Start Lot:<br>
  <input type="text" name="start">
  <br>
  Steps:<br>
  <input type="text" name="steps">
  <br>
  TP:<br>
  <input type="text" name="tp">
  <br>
  Exposure Per Pips Per Lot:<br>
  <input type="text" name="pppl"><br>
  Spread:<br>
  <input type="text" name="spread"><br><br>
  <input type="submit" value="Submit">
</form> 