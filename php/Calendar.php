<?php 
ob_start();
session_start(); 
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../css/main.css" rel="stylesheet" type="text/css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="../js/nav.js"></script>-->
<title>Welcome to LadyTime</title>
</head>
<?php 
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

  $Today = strtotime(date("Y-m-d"));
  $periodday = strtotime($year."-".$mon."-".$mday);
  $safedays = round(($periodday-$Today)/3600/24);


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
echo "<table class='calenderStructure calenderStructure2'>";
echo "<tr class='dayFormat'><td>Sunday</td><td>Monday</td><td>Tuesday</td><td>Wednesday</td><td>Thursday</td><td>Friday</td><td>Saturday</td></tr>";
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
    echo "<td class='gradient'>".$arr[$j-1]."</td>";
  }else{
    echo "<td>".$arr[$j-1]."</td>";
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
<body>
<div class="">
<div class="xs-menu-cont gradient" style="padding-bottom:2.5em;">
 <div id="menutoggle" class="microMenu">
  <i href="#">≡</i>
      <div class="logoMicro">
        <a href="#">
          
        </a>
      </div>
      <div class="logInMicro">
        <a href="#">
          Signin
        </a>
      </div>
  </div>
  <nav id="nav" class="xs-menu displaynone">
    <ul id="submenutoggle" class="navigation">
      <div class="logo">
        <a href="#">
          
        </a>
      </div>
      <a href="Calendar.php">Calender</a>&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="confirmationList.php">Record</a>
      <div class="logIn">
        <a href="login.php">
          Logout
        </a>
      </div>
    </ul>
  </nav>
</div>
<div class="middleContainer">
<!--     <div>
    <?= $mon ?>
    </div>
    <div>
    <?= $year ?>
    </div> -->
  <div class="subMiddleContainer weekMonthYear">
  <table>
      <tr>
        <td>
          <table class="calenderStructure" border="0" cellspacing="0">
            <tr class="dayFormat">
              <td>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                <input type="hidden" name="mounth" value="<?= $checkmounth - 1 ?>">
                <input type="submit" value="<<">
              </form> 
              </td>
              <td style="font-weight: bold; font-size: 1em;"><?= $mon ?> - <?= $year ?></td>
              <td>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
              <input type="hidden" name="mounth" value="<?= $checkmounth + 1 ?>">
              <input type="submit" value=">>">
              </form>
              </td>
            </tr>
          </table>
          </td>
      </tr>
      <tr>
        <td>
        <?php
          $date($day,$weekday);
        ?>
        </td>
      </tr>
    </table>
  </div>
  <!--<div class="subMiddleContainer dateLine">
      <div>
      1
      </div>
      <div>
      2
      </div>
      <div>
      3
      </div>
      <div class="gradient">
      Today
      </div>
      <div>
      5
      </div>
      <div>
      6
      </div>
      <div>
      7
      </div>
  </div>-->
  <div class="subMiddleContainer infoCircleContainer">
    <button class="circleBTN">
      <div class="circleSymble">
      ?
      </div>
    </button>
    <div class="circleInfo">
      <div class="whiteCircle">
      <div class="smallTitle"><?= $mday ?>, <?= $mon ?>, <?= $year ?></div>
      <div class="bigTitle"><?= $safedays ?></div>
      <div class="middleTitle">days left</div>
      <div class="smallTitle">fertility rate: low</div>
      </div>
    </div>
    <a href = "moreInfo.php" class="circleBTN">
      <div class="circleSymble">
      +
      </div>
    </a>
  </div>
<!--   <div class="subMiddleContainer" style="margin-bottom:20px;">
    <div class="singleTip">
      <div class="singleTipImg"></div>
      <p class="singleTipTitle">You aren't limited to just two colors either. In fact...</p>
      <p class="singleTipPassage">You aren't limited to just two colors either. In fact...</p>
      <p class="singleTipMore">Read More ></p>
    </div>
    <div class="singleTip">
      <div class="singleTipImg"></div>
      <p class="singleTipTitle">You aren't limited to just two colors either. In fact...</p>
      <p class="singleTipPassage">You aren't limited to just two colors either. In fact...</p>
      <p class="singleTipMore">Read More ></p>
    </div>
    <div class="singleTip">
      <div class="singleTipImg"></div>
      <p class="singleTipTitle">You aren't limited to just two colors either. In fact...</p>
      <p class="singleTipPassage">You aren't limited to just two colors either. In fact...</p>
      <p class="singleTipMore">Read More ></p>
    </div>
  </div> -->
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/nav.js"></script>

</body>
</html>
