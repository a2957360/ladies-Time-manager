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
  <div class="subMiddleContainer weekMonthYear">
    <table class="calenderStructure startEnd" border="0" cellspacing="0">
      <tr class="startEndFirst">
        <td>Start Date</td>
        <td>Frequency</td>
        <td>Duration</td>
        <td>Color Of Blood</td>
        <td>Texture Of Blood</td>
        <td>Type Of Blood</td>
        <td>Abnormal Of Blood</td>
      </tr>
<?php 
$errormessage = "";
      $errormessage = "";
      $dsn = "mysql:host=localhost;dbname=wutia_Assignment";
      $username = 'wutia_001';
      $password = 'Wty2957360';
      $pdo = new PDO($dsn, $username, $password);
      $userid = $_SESSION["UserId"];
      echo $password;
      echo $userid;
      $stmt = $pdo->prepare("SELECT * FROM `ladytable` JOIN `bloodtable` WHERE `ladytable`.Userid = '$userid' AND `bloodtable`.`MounthId` = `ladytable`.`Id`;");
      $stmt->execute();
      if($stmt != null){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
      <tr class="startEndFormat">
        <td><?= $row['LastTime'] ?></td>
        <td><?= $row['Frequency'] ?></td>
        <td><?= $row['Duration'] ?></td>
        <td><?= $row['Color'] ?></td>
        <td><?= $row['Texture'] ?></td>
        <td><?= $row['Type'] ?></td>
        <td><?= $row['Abnormal'] ?></td>
      </tr>
<?php 
        }
      }else{
        $errormessage = "database error";
      }
?>
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
    <!-- <button class="circleBTN">
      <div class="circleSymble">
      ?
      </div>
    </button> -->
    
   <!--  <button class="circleBTN">
      <div class="circleSymble">
      +
      </div>
    </button> -->
  </div>
 <!--  <div class="subMiddleContainer" style="margin-bottom:20px;">
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
