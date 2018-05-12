<?php 
ob_start();
session_start(); 
$dsn = "mysql:host=localhost;dbname=wutia_Assignment";
$username = 'wutia_001';
$password = 'Wty2957360';
$pdo = new PDO($dsn, $username, $password);
$Mail = $_SESSION["Username"];
$UserId = '';
$Frequency = '';
$Duration = '';
$LastTime = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $checkmounth = $_POST['mounth'];
}else{
  $checkmounth = 0;
}

$stmt = $pdo->prepare("SELECT `Id` FROM `usertable` WHERE `Email` = '$Mail';");
$stmt->execute();
if($stmt != null){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $UserId = $row['Id'];
    }
}

$stmt = $pdo->prepare("SELECT * FROM `ladytable` WHERE `UserId` = '$UserId' ORDER BY `Id` DESC LIMIT 1;");
$stmt->execute();
if($stmt != null){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $Frequency = $row['Frequency'];
      $Duration = $row['Duration'];
      $LastTime = $row['LastTime'];
    }
}
$time = explode('-', $LastTime);

if($checkmounth != 0){
  $mdaytemp = $time[0] + (($Frequency + 2) * $checkmounth);
  $montemp = $time[1];
  $yeartemp = $time[2];
  $mday = getdate(mktime(0,0,0,$montemp,$mdaytemp,$yeartemp))["mday"];
  $mon = getdate(mktime(0,0,0,$montemp,$mdaytemp,$yeartemp))["mon"];
  $year = getdate(mktime(0,0,0,$montemp,$mdaytemp,$yeartemp))["year"];
}else{
  $mday = $time[0];
  $mon = $time[1];
  $year = $time[2];
}


if($mon == 4 || $mon == 6 || $mon == 9 || $mon == 11){
  $day = 30;
}else if($mon == 2){
  if(($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0){
    $day = 29;
  }else{
    $day = 28;
  }
}else{
  $day = 31;
}

$weekday = getdate(mktime(0,0,0,$mon,1,$year))["wday"];
$date = function($day,$w){
echo "<table border='1'>";
echo "<tr><th>Sunday</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th></tr>";
$arr = array();
for($i=1;$i<=$day;$i++){
  array_push($arr,$i); 
}
if($w>=1&&$w<=6){
  for($m=1;$m<=$w;$m++){
    array_unshift($arr,"");
  }
}
$n=0;
for($j=1;$j<=count($arr);$j++){
  $n++;
  if($n==1) echo "<tr>";
  global $mday;
  if($mday <= $arr[$j-1] && $arr[$j-1] <= ($mday + $Duration + 2)){
    echo "<td width='80px' style='background-color: greenyellow;'>".$arr[$j-1]."</td>";
  }else{
    echo "<td width='80px'>".$arr[$j-1]."</td>";
  }

  if($n==7){
  echo "</tr>";
  $n=0;
  }
}
if($n!=7)echo "</tr>";

echo "</table>";
};

?>



<!doctype html>
<html class="gradient">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link href="../css/main.css" rel="stylesheet" type="text/css"> -->
<title>Welcome to LadyTime</title>
</head>
<body>
  <?= $year ?>-<?= $mon ?>
  <?php
    $date($day,$weekday);
  ?>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
    <input type="hidden" name="mounth" value="<?= $checkmounth - 1 ?>">
    <input type="submit" name="back" value="Back">
  </form> 
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
    <input type="hidden" name="mounth" value="<?= $checkmounth + 1 ?>">
    <input type="submit" name="back" value="Next">
  </form> 

</div>
</body>
</html>